<?php
namespace lambda;

class Site{
	private $siteName;
	private $siteLink;

	protected static $sqlHost;
	protected static $sqlName;
	protected static $sqlUser;
	protected static $sqlPassword;

	public function __construct($data){
		//Paramètres du site
		$this->$siteName = $data['siteName'];
		$this->$siteLink = $data['siteLink'];

		//Base de donnée
		self::$sqlHost = $data['sqlHost'];
		self::$sqlName = $data['sqlName'];
		self::$sqlUser = $data['sqlUser'];
		self::$sqlPassword = $data['sqlPassword'];
	}

	public function getCurrentPage(){
		$currentPage = array_reverse(explode("/", $_SERVER['REQUEST_URI']));
		return $currentPage[0];
	}
}
