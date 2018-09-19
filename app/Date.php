<?php
/**
 * Class Date
 */
class Date{
	/**
     * @var array $months : Les mois de l'année en lettres
     */
	private static $months = array('01' => 'janvier', '02' => 'février', '03' => 'mars', '04' => 'avril', '05' => 'mai', '06' => 'juin', '07' => 'juillet','01' => 'août', '09' => 'septembre', '10' => 'octobre', '11' => 'novembre', '12' => 'décembre');

	/**
     * @var array $days : Les jours de la semaine en lettres
     */
	private static $days = array('mon' => 'lundi', 'thu' => 'mardi', 'wed' => 'mercredi', 'thu' => 'jeudi', 'fri' => 'vendredi', 'sat' => 'samedi', 'sun' => 'dimanche');

	/**
     * @param int $timestamp : La date a convertir
     * @return int $timestamp : La date a convertir
     */
	public static function full($timestamp){
		$day = date('D', $timestamp);
		$month = date('m', $timestamp);
		$date = Date::$days[strtolower($day)].' '.date('d', $timestamp).' '.Date::$months[$month].' '.date('Y', $timestamp);
		echo $date;
	}

	/**
     * @param int $timestamp : La date a convertir
     */
	public static function min($timestamp){
		$month = date('m', $timestamp);
		$date = date('d', $timestamp).' '.Date::$months[$month].' '.date('Y', $timestamp);
		echo $date;
	}

	/**
     * @param int $timestamp : La date a convertir
     * @param string $spacing : Le caractère d'espacement pour la date (ex: / ou -)
     */
	public static function number($timestamp, $spacing){
		echo date('d'.$spacing.'m'.$spacing.'Y', $timestamp);
	}

	/**
     * @param int $timestamp : La date a convertir
     */
	public static function before($timestamp){
		$date = time() - $timestamp;
		if($date <= 15){
			$return = 'à l\'instant';
		}elseif($date <= 59){
			$return =  'il y a '.$date.' secondes';
		}elseif($date <= 3540){
			$return = $date / 60;
			$return = ($return > 1) ? 'il y a '.round($return).' minutes' : round($return).' minute';
		}elseif($date < 86400){
			$return = $date / 3600;
			$return = ($return > 1) ? 'il y a '.round($return).' heures' : round($return).' heure';
		}elseif($date <= 604800){
			$return = $date / 86400;
			$return = ($return > 1) ? 'il y a '.round($return).' jours' : round($return).' jour';
		}else{
			$return = Date::min($timestamp);
		}

		echo $return;
	}
}
