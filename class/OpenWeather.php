<?php

Class OpenWeather 
{
	private $appId;

	/*
	const FOLLOWING_DAYS = [
		1 => 2,
		2 => 3,
		3 => 4,
		4 => 5,
		5 => 6,
		6 => 7,
		7 => 1
		];
	*/

	const DAYS_OF_WEEK = [
		1 => 'lundi',
		2 => 'mardi',
		3 => 'mercredi',
		4 => 'jeudi',
		5 => 'vendredi',
		6 => 'samedi',
		7 => 'dimanche'
		];

	public function __construct(string $appId) {
		$this->appId = $appId;
	}

	/**
	* Get weather forecast for a $city for $days
	*@param str $city
	*@param str $days
	*@return array $results
	*
	**/
	public function getForecast(string $city, string $days): ?array 
	{	

		$data = $this->callAPI('forecast/daily?q=' . $city . '&cnt=' . $days);

		if(is_null($data)) {
			return null;
		}

	    $results = [];

	    
	    $results['city'] = $data['city']['name'];
	    $results['forecast'] = $days;

	    $element = [];
	    foreach ($data['list'] as $day) {

	    	$element[] = [
	    		'temp' 		  => $day['temp']['day'],
	    		'pressure' 	  => $day['pressure'],
	    		'humidity'	  => $day['humidity'], 
	    		'description' => $day['weather'][0]['description'],
	    		'date'        => new DateTime('@' . $day['dt']),
	    		'dayOfWeek'	  => $this->getDayOfWeek($day['dt']),
	    		'icon'        => '<img src="https://openweathermap.org/img/wn/'.$day['weather'][0]['icon'].'.png"' . 'title ="' . $day['weather'][0]['description']. '" ' . 'alt="'.$day['weather'][0]['icon'].'" />'
	    	];
	    }

	    $results['list'] = $element;
	    
	    return $results;

	}

	/**
	* Get endpoint Weather API
	* @param str $endpoint
	* @return array $data
	*/
	protected function callAPI(string $endpoint) : ?array
	{
		$curl = curl_init('http://api.openweathermap.org/data/2.5/'.$endpoint.'&lang=fr&units=metric&APPID='.$this->appId);

		curl_setopt_array($curl, [
		 CURLOPT_CAINFO => __DIR__ . DIRECTORY_SEPARATOR . 'certificat.cer', // on check le certificat
		 CURLOPT_RETURNTRANSFER => true, // on cache les data
		 CURLOPT_TIMEOUT_MS => 1000 // 1 seconde max pour interroger le serveur
		]);

		$data = curl_exec($curl);

		if($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
    		return null;
		} 
		
	    return json_decode($data, true); // true tableau associatif
	}

	/**
	*  Retourne le jour de la semaine en fonction
	* @param int timestamp du jour depuis 1970
	* @return str jour de la semaine
	**/
	protected function getDayOfWeek ($timestamp)
	{
		$idDay =  (int) date('N', $timestamp); // id jour de la semaine 1 à 7

		return self::DAYS_OF_WEEK[$idDay];
	}

	/**
	* DEPRECATED : Get day for weather
	*@param int $day
	*@return str $myday format d/m/Y
	**/
	/*
	protected function getDay(int $day) 
	{

		$dateTime = new DateTime();
		if($day > 0) {
			$day = (string) $day;
			$dateTime->modify('+'.$day.' day');
		}

		$myDay = $dateTime->format('d/m/Y');

		return $myDay;
	}
	*/
}