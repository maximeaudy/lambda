<?php 
namespace lambda;

class Users{

	private $id;

	function __construct($id){
		$this->id = $id;
	}

	public function login($post)
	{
		$sql = Database::query('SELECT * FROM users WHERE name = ?', TRUE, array($post['username']), TRUE);
		if(!empty($sql)){
			echo $sql['id'];
		}else return new Message('error', 'koala perché',2);
	}

	public function test()
	{
		echo 'eeee';
	}
}