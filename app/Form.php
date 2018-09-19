<?php
/**
 * Class Form : Gère les formulaires
 */

class Form{

    /**
     * @var string $name Nom du formulaire
     */
    private $name;

    /**
     * @var array $data Données du formulaire
     */
    private $data = array();

    /**
     * @var string $spacing Saut de ligne HTML
     */
    private $spacing = "\n";

    /**
     * @param string $type : Type du textarea
     * @param string $name : Nom du textarea
     */
    public function textarea($data = array()){
        $return = '';

        if($data['type'] != "submit" AND !empty($data['label'])){
            $return .= '<label for="'.$data['name'].'" class="form-label">'.$data['label'].'</label>'.$this->spacing;
        }

        $return .= '<textarea type="'.$data['type'].'" name="'.$data['name'].'"'.((isset($data['class'])) ? ' class="'.$data['class'].'"' : '') . ((isset($data['placeholder'])) ? ' placeholder="'.$data['placeholder'].'"' : '') . ((isset($data['style'])) ? ' style="'.$data['style'].'"' : '') . ((isset($data['id'])) ? ' id="'.$data['id'].'"' : '') . ((isset($data['required'])) ? ' required' : '').'>'. ((isset($data['value'])) ? ' value="'.$data['value'].'"' : '') .'</textarea>'.$this->spacing;

        echo $return;
    }

    /**
     * @param string $type : Type de l'input
     * @param string $name : Nom de l'input
     */
    public function input($data = array()){
        $return = '';

        if($data['type'] != "submit" AND !empty($data['label'])){
            $return .= '<label for="'.$data['name'].'" class="form-label">'.$data['label'].'</label>'.$this->spacing;
        }

        $return .= '<input type="'.$data['type'].'" name="'.$data['name'].'"'.((isset($data['class'])) ? ' class="'.$data['class'].'"' : '') . ((isset($data['placeholder'])) ? ' placeholder="'.$data['placeholder'].'"' : '') . ((isset($data['style'])) ? ' style="'.$data['style'].'"' : '') . ((isset($data['value'])) ? ' value="'.$data['value'].'"' : '') . ((isset($data['required'])) ? ' required' : '').'>'.$this->spacing;

        echo $return;
    }

    /**
     * @param string $type : Type de l'input
     * @param string $name : Nom de l'input
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

        echo $return;
    }

    /**
     * @param string $class_name : Nom de la classe à utiliser
     * @param string $form_name : Nom du formulaire
     * @param array $name : Données du formulaire
     */
    private function send_data($class_name, $form_name, $data = array()){
        $test = new $class_name(0);
        $test->$form_name($data);
    }

    /**
     * @param string $form_name Nom du formulaire
     * @param string $class_name Nom de la classe à utiliser
     * @param array $data Données $_POST et $_FILES du formulaire
     */
    function __construct($class_name, $form_name, $data = array()){
        $this->name = $form_name;

        //Regarder pour editor / pas editor
        if(isset($data['admin']) AND $data['admin'] == 'BG'){
            $validation = true;
        }else{
            $validation = false;
        }
        $this->data = Secure_array($data, $validation);
        
        $this->send_data($class_name, $form_name, $this->data);
    }

}
