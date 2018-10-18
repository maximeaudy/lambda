<?php
namespace lambda;

/**
 * Class Message
 * @package lambda
 */
class Message
{
    /**
     * @var string $type État du message (success, error...)
     */
    private $type;

    /**
     * @var string Contenu du message
     */
    private $message;

    /**
     * Méthode a utiliser pour différents affichage
     * @var int ID de la méthode
     */
    private $method;

    /**
     * Initialisation d'un message
     * @param $type string Type du message
     * @param $message string Contenu du message
     * @param $method int ID de la méthode
     */
    public function __construct($type, $message, $class_method)
    {
        $this->type = $type;
        $this->message = $message;
        $this->method = $_SESSION['form#'.$class_method]['method'];
        $this->getMessage();
    }

    /**
     * Renvoie le message
     */
    private function getMessage()
    {
        if($this->method == FALSE)
            echo '<div class="alert '.$this->type.'">'.$this->message.'</div>';
        elseif($this->method < 20){
            echo json_encode(array($this->type, $this->message, $this->method));
        }
        else
            echo '<div class="alert '.$this->type.'">'.$this->message.'</div>';
    }
}