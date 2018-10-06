<?php
namespace lambda;

class Error{
	private $e;

	public function __construct($e){
		$this->$e = get_object_vars($e);
		var_dump($this->$e);
	}

	public function getError(){
		var_dump($this->$e);
	}
}