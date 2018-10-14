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
     * @var int Méthode a utiliser (div, js...)
     */
    private $method;

    public function __construct($type, $message, $method)
    {
        $this->type = $type;
        $this->message = $message;
        $this->method = $method;

        $this->getMessage();
    }

    private function getMessage()
    {
        if($this->method < 20)
            echo json_encode(array($this->type, $this->message, $this->method));
        else
            echo $this->message;
    }
}