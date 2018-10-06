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
		}else echo "erreur";
	}

	public function test()
	{
		echo 'eeee';
	}
}