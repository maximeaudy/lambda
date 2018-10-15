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
		    return new Message('success', 'Utilisateur trouvé avec l\'ID : '.$sql['id'],20);
		}else return new Message('error', 'Utilisateur introuvable',20);
	}

	public function test($post)
	{
        $sql = Database::query('SELECT * FROM users WHERE name = ?', TRUE, array($post['username']), FALSE);
        if(!empty($sql))
        {
            return new Message('success', 'Utilisateur trouvé',20);
        }
        else return new Message('error', 'Utilisateur introuvable2',20);
	}
}