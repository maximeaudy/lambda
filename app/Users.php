<?php 
namespace lambda;

class Users{

	private $id;

	function __construct($id){
		$this->id = $id;
	}

	public function login($post)
	{
		$sql = Database::query('SELECT * FROM users WHERE name = ? AND pass = ?', TRUE, array($post['username'], $post['pass']), TRUE);
		if(!empty($sql)){
		    return new Message('success', 'Connexion réussie', __FUNCTION__);
            header('location:documentation.txt');
		}else return new Message('error', 'Vos identifiants sont éronnés.', __FUNCTION__);
	}

	public function test($post)
	{
        $sql = Database::query('SELECT * FROM users WHERE name = ?', TRUE, array($post['username']), FALSE);
        if(!empty($sql))
        {
            return new Message('success', 'Utilisateur trouvé', __FUNCTION__);
        }
        else return new Message('error', 'Utilisateur introuvable2', __FUNCTION__);
	}
}