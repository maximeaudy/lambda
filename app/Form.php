<?php
namespace lambda;

/**
 * Class Form : Gère les formulaires
 */

class Form{

    /**
     * @var string $name Nom du formulaire
     */
    private $name;

    /**
     * @var string $type Type du formulaire
     */
    private $type;

    /**
     * @var array $data Données du formulaire
     */
    private $data = array();

    /**
     * @var array $data Données de la classe utilisée par le formulaire
     */
    private $class = array(
        'name' => '',
        'method' => ''
    );

    /**
     * @var string $spacing Saut de ligne HTML
     */
    private $spacing = "\n \t \t";

    /**
     * @param array $data : Informations du formulaire
     */
    public function form($data = array()){
        $return = '<form method="'.((isset($data['method'])) ? $data['method'] : 'POST').'" action="'.((isset($data['action'])) ? $data['action'] : '').'" '.(($this->type == TRUE) ? ' id="'.$this->class['method'].'"' : '').'>'.$this->spacing;
        printf($return);
    }

    /**
     * @param string $return Ce que retourne ajax
     */
    public function endform($returnValue = 'none'){
        $return = '</form>'.$this->spacing;

        if($this->type == true){
            $return .= '<script type="text/javascript">'.$this->spacing;
            $return .= "$('form#".$this->class['method']."').on('submit', function (e) {".$this->spacing;
            $return .= 'e.preventDefault();'.$this->spacing;
            $return .= '$.ajax({'.$this->spacing;
            $return .= "type: 'post',".$this->spacing;

            //Ici, on découpe le nom de notre classe pour doubler le "\" dans la chaine
            //Sinon le champ url d'ajax enlève "\", donc il faut en mettre deux
            $class_name = explode("\\", $this->class['name']);
            $class_name = $class_name[0]."\\\\".$class_name[1];

            $return .= "url: 'test.php?class=".$class_name."&method=".$this->class['method']."',".$this->spacing;
            $return .= "data: $('form#".$this->class['method']."').serialize(),".$this->spacing;
            if($returnValue == "messageAlert")
                $return .= 'success: function (e) { e = $.parseJSON(e); new Message(e[0], e[1], e[2]); if(e[0] != "error") $("form")[0].reset(); }'.$this->spacing;
            else
                $return .= 'success: function (e) { $("#'.$returnValue.'").html(e); }'.$this->spacing;
            $return .= '});'.$this->spacing;
            $return .= '});'.$this->spacing;
            $return .= '</script>'.$this->spacing;
        }
        printf($return);
    }

    /**
     * @param array $data : Informations du textarea
     */
    public function textarea($data = array()){
        $return = '';

        if($data['type'] != "submit" AND !empty($data['label'])){
            $return .= '<label for="'.$data['name'].'">'.$data['label'].'</label>'.$this->spacing;
        }

        $return .= '<textarea type="'.$data['type'].'" name="'.$data['name'].'"'.((isset($data['class'])) ? ' class="'.$data['class'].'"' : '') . ((isset($data['placeholder'])) ? ' placeholder="'.$data['placeholder'].'"' : '') . ((isset($data['style'])) ? ' style="'.$data['style'].'"' : '') . ((isset($data['id'])) ? ' id="'.$data['id'].'"' : '') . ((isset($data['required'])) ? ' required' : '').'>'. ((isset($data['value'])) ? ' value="'.$data['value'].'"' : '') .'</textarea>'.$this->spacing;

        printf($return);
    }

    /**
     * @param array $data : Informations de l'input
     */
    public function input($data = array()){
        $return = '';

        if($data['type'] != "submit" AND !empty($data['label'])){
            $return .= '<label for="'.$data['name'].'" class="form-label">'.$data['label'].'</label>'.$this->spacing;
        }

        $return .= '<input type="'.$data['type'].'" '.(($data['type'] == "submit") ? 'name="'.$this->class['method'].'"' : 'name="'.$data['name'].'"') . ((isset($data['class'])) ? ' class="'.$data['class'].'"' : '') . ((isset($data['placeholder'])) ? ' placeholder="'.$data['placeholder'].'"' : '') . ((isset($data['style'])) ? ' style="'.$data['style'].'"' : '') . ((isset($data['id'])) ? ' id="'.$data['id'].'"' : '') . ((isset($data['value'])) ? ' value="'.$data['value'].'"' : '') . ((isset($data['required'])) ? ' required' : '').'>'.$this->spacing;

        printf($return);
    }

    /**
     * @param array $data : Informations du select
     * @param array $options : Options du select
     */
    public function select($data = array(), $options = array()){
        $return = '';

        if(isset($data['label']) AND !empty($data['label'])){
            $return .= '<label for="'.$data['name'].'">'.$data['label'].'</label>'.$this->spacing;
        }

        $return .= '<select name="'.$data['name'].'"'.((isset($data['class'])) ? ' class="'.$data['class'].'"' : '') . ((isset($data['required'])) ? ' required' : '').'>'.$this->spacing;
        
        for($i = 0;$i < count($options);$i++){
            $return .= '<option value="'.$options[$i]['value'].'">'.ucfirst($options[$i]['name']).'</option>'.$this->spacing;
        }

        $return .= '</select>'.$this->spacing;

        printf($return);
    }

    private function send_data(){
        $init = new $this->class['name'](0);

        //Obligé de nommer $method car sinon il y a une erreur ligne en dessous
        $method = $this->class['method'];
        $init->$method($this->data);
    }

    /**
     * @param string $class_name Nom de la classe à utiliser
     * @param string $class_method Nom de la méthode à utiliser
     * @param array $data Données $_POST et $_FILES du formulaire
     * @param bool $type Via ajax ou post
     */
    function __construct($class_name, $class_method, $data = array(), $type = false){
        $this->class['name'] = $class_name;
        $this->class['method'] = $class_method;
        $this->type = $type;

        //Si c'est un formulaire SANS AJAX on utilise $this⁻>data pour les données du formulaire
        if($type == false){
            //Vérification s'il y a une sécurisation d'éditeur de texte
            if(isset($data['editor'])){
                $validation = true;
            }else{
                $validation = false;
            }

            $this->data = Secure_array($data, $validation);
        }else{
            //AJAX
            //On stock dans $this->data les champs du formulaire à sécuriser différement
            $this->data = $data['editor'];
        }

        //On vérifie qu'un formulaire a bien été envoyé
        if($_SERVER['REQUEST_METHOD'] == "POST"){
            $this->send_data();
        }
    }

}
