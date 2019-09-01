<?php

class CityMapper {

	private $appId;

	public function __construct(string $appId) 
	{
		$this->appId = $appId;
	}

	public function getTimeBetweenTwoPoints(string $startCity, string $stardCoord, string $endCity, string $endCoord) 
	{
		$data = $this->callAPI('traveltime/?startcoord='.$stardCoord.'&endcoord='.$endCoord);

		if(is_null($data)) {
			return null;
		}

		$results =  [
			'startCity' => $startCity,
			'endCity'   => $endCity,
			'travel_time_minutes' => $data['travel_time_minutes']
		];

		return $results;

	}


	protected function callAPI($endpoint) 
	{

		$curl = curl_init('https://developer.citymapper.com/api/1/'.$endpoint.'&time_type=arrival&key='.$this->appId);

		curl_setopt_array($curl, [
		 CURLOPT_RETURNTRANSFER => true, // on cache les data
		 CURLOPT_TIMEOUT_MS => 1000 // 1 seconde max pour interroger le serveur
		]);

		$data = curl_exec($curl);

		if($data === false || curl_getinfo($curl, CURLINFO_HTTP_CODE) !== 200) {
    		return null;
		}

	    return json_decode($data, true); // true tableau associatif
	}
	
}