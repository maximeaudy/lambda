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
     * @var $type string Type du formulaire
     */
    private $type;

    /**
     * Données du formulaire
     * @var array $data Données du formulaire
     */
    private $data = array();

    /**
     * Name des champs requis
     * @var array $data_required Données du formulaire requises
     */
    private $data_required = array();

    /**
     * Données de la classe à utiliser
     * @var array $data Données de la classe utilisée par le formulaire
     */
    private $class = array(
        'name' => '',
        'method' => ''
    );

    /**
     * Saut de ligne HTML
     * @var string $spacing Saut de ligne HTML
     */
    private $spacing = "\n";

    /**
     * Met à jour les champs requis dans la $_SESSION pour les form de type AJAX
     * @param $data_name Nom du champ HTML
     * @param $data_required Valeur de "required" du champ HTML
     */
    private function maj_required($data_name, $data_required){
        $this->data_required[$data_name] = $data_required;

        if(!empty($_SESSION['form#'.$this->class['method']]['required'])){
            //On compare les deux tableaux pour savoir si on met à jour $_SESSION['form#method']['required']
            if (!identical_values($this->data_required, $_SESSION['form#'.$this->class['method']]['required'])) $_SESSION['form#'.$this->class['method']]['required'] += $this->data_required;
        }else{
            $_SESSION['form#'.$this->class['method']] += array('required' => $this->data_required);
        }
    }

    /**
     * @param array $data Données du label et de l'input
     */
    private function label($data = array()){
        if($data['type'] != "submit") {
            //On met à jour les champs requis
            $this->maj_required($data['name'], $data['required']);
        }

        if($data['type'] != "submit" AND !empty($data['label'])){
            $return = '<label for="'.$data['name'].'" class="form-label">'.$data['label'] . ((isset($data['required'])) ? '*' : '').'</label>'.$this->spacing;

            printf($return);
        }
    }

    /**
     * Créer un textarea HTML
     * @param array $data : Informations du textarea
     */
    public function textarea($data = array()){
        //Création du label
        $this->label($data);

        $return = '<textarea type="'.$data['type'].'" name="'.$data['name'].'"'.((isset($data['class'])) ? ' class="'.$data['class'].'"' : '') . ((isset($data['placeholder'])) ? ' placeholder="'.$data['placeholder'].'"' : '') . ((isset($data['style'])) ? ' style="'.$data['style'].'"' : '') . ((isset($data['id'])) ? ' id="'.$data['id'].'"' : '') . ((isset($data['required'])) ? ' required' : '').'>'. ((isset($data['value'])) ? ' value="'.$data['value'].'"' : '') .'</textarea>'.$this->spacing;

        printf($return);
    }

    /**
     * Créer un input HTML
     * @param array $data : Informations de l'input
     */
    public function input($data = array()){
        //Création du label
        $this->label($data);

        $return = '<input type="'.$data['type'].'" '.(($data['type'] == "submit") ? 'name="'.$this->class['method'].'"' : 'name="'.$data['name'].'"') . ((isset($data['class'])) ? ' class="'.$data['class'].'"' : '') . ((isset($data['placeholder'])) ? ' placeholder="'.$data['placeholder'].'"' : '') . ((isset($data['style'])) ? ' style="'.$data['style'].'"' : '') . ((isset($data['id'])) ? ' id="'.$data['id'].'"' : '') . ((isset($data['value'])) ? ' value="'.$data['value'].'"' : '') . ((isset($data['required'])) ? ' required' : '').'>'.$this->spacing;

        printf($return);
    }

    /**
     * Créer un select HTML
     * @param array $data : Informations du select
     * @param array $options : Options du select
     */
    public function select($data = array(), $options = array()){
        $this->maj_required($data['name'], $data['required']);
        $return = '';

        //Création du label
        $this->label($data);

        $return .= '<select name="'.$data['name'].'"'.((isset($data['class'])) ? ' class="'.$data['class'].'"' : '') . ((isset($data['required'])) ? ' required' : '').'>'.$this->spacing;
        
        for($i = 0;$i < count($options);$i++){
            $return .= '<option value="'.$options[$i]['value'].'">'.ucfirst($options[$i]['name']).'</option>'.$this->spacing;
        }

        $return .= '</select>'.$this->spacing;

        printf($return);
    }

    /**
     * Créer l'entête du formulaire HTML et paramètre ses configurations de la classe
     * @param array $data : Informations du formulaire
     */
    public function form($data = array()){
        $return = '<form method="'.((isset($data['method'])) ? $data['method'] : 'POST').'" action="'.((isset($data['action'])) ? $data['action'] : '').'" '.(($this->type == TRUE) ? ' id="'.$this->class['method'].'"' : '').'>'.$this->spacing;
        printf($return);
    }

    /**
     * Ferme le formulaire en rajoutant s'il faut ajax
     * @param $div string La div dans laquelle on insère le message
     */
    public function endform($div = false){
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

            $return .= "url: 'test.php?method=".encrypt_decrypt(1, $this->class['method'])."',".$this->spacing;
            $return .= "data: $('form#".$this->class['method']."').serialize(),".$this->spacing;
            if($this->type < 20)
                $return .= 'success: function (e) { e = $.parseJSON(e); new Message(e[0], e[1], e[2]); if(e[0] != "error") $("form#'.$this->class['method'].'")[0].reset(); }'.$this->spacing;
            else
                $return .= 'success: function (e) { $("#'.$div.'").html(e); $("form#'.$this->class['method'].'")[0].reset(); }'.$this->spacing;
            $return .= '});'.$this->spacing;
            $return .= '});'.$this->spacing;
            $return .= '</script>'.$this->spacing;
        }

        printf($return);
    }

    /**
     * Permet d'envoyer les données à la classe du formulaire
     */
    private function send_data(){
        $init = new $this->class['name'](0);

        //Obligé de nommer $method car sinon il y a une erreur ligne en dessous
        $method = $this->class['method'];
        $init->$method($this->data);
    }

    /**
     * Initialise un formulaire HTML
     * @param string $class_name Nom de la classe à utiliser
     * @param string $class_method Nom de la méthode à utiliser
     * @param array $data Données $_POST et $_FILES du formulaire
     * @param bool $type Via ajax ou post
     */
    function __construct($class_name, $class_method, $data = array(), $type = false){
        $this->class['name'] = $class_name;
        $this->class['method'] = $class_method;
        $this->data = $data;
        $this->type = $type;

        //On créer une session avec la méthode d'affichage du formulaire en question
        $_SESSION['form#'.$class_method] = array('method' => $type);

        //Si c'est AVEC ajax
        if($type == TRUE){
            //On définit les paramètres de la classe
            $_SESSION['form#'.$class_method] += array('class' => array('name' => $class_name, 'method' => $class_method));

            //On définit les champs à sécuriser différement
            if(!empty($data)) $_SESSION['form#'.$class_method] += array('editor' => $data);
        }else{
            //Vérification s'il y a une sécurisation d'éditeur de texte
            if(isset($this->data['editor'])){
                $validation = true;
            }else{
                $validation = false;
            }

            $this->data = Secure_array($this->data, $validation);

            //On vérifie qu'un formulaire a bien été envoyé
            if($_SERVER['REQUEST_METHOD'] == "POST"){
                $data_required = array_intersect(array($_SESSION['form#'.$class_method]['required']), $data);
                if(array_not_empty($data_required))
                    $this->send_data();
                else
                    return new Message('error', 'Un ou plusieurs champs est vide.', 20);
            }
        }
    }

}
