<?php


class DisplayContent
{


	/** array **/
	protected $inputData = [];


	/** array **/
	protected $outputData = [];

	public function __construct($inputData)
	{
		$this->inputData = $inputData;

	}


	/**
	* Get all data
	*@return array
	*
	**/
	public function getData()
	{
		$this->displayPageInfo();
		$this->displayOpenWeatherData();
		$this->displayCityMapperData();

		return $this->outputData;
	}


	/**
	* Get pageInfo data
	*@return array
	*
	**/
	protected function displayPageInfo()
	{
		$data = $this->inputData['pageInfo'];

		$this->outputData['pageInfo'] = [
			'title' => $data['title'],
			'h1page' => $data['h1page']
		];
	}

	/**
	* Get displayOpenWeather data
	* @return array
	**/
	protected function displayOpenWeatherData() 
	{

		$data = $this->inputData['openWeather'];
		$today = $data['today'];
		$forecast = $data['forecast'];


		$h2Weather = 'Prévision à '. $forecast['city']. ' pour les '. $forecast['forecast'].' prochains jours : ';


		$outputDataWeather = '<table>
							    <thead>
							        <tr>
							            <th> Jour </th>
							            <th> Météo </th>
							            <th> Température </th>
							            <th> Humidité </th>
							            <th> Pression </th>
							        </tr>
							    </thead>
							    <tbody>' .
							        '<tr>' . 
							            '<td id=\'today\'> Aujourd\'hui <br/>' . $today['dayOfWeek'] . ' ' .$today['date']->format('d/m/Y') . '</td>'.
							            '<td>' . $today['icon'] . '<br/>' . $today['description'] . '</td>'.
							            '<td>' . $today['temp'] . ' °C</td>'.
							            '<td>' . $today['humidity'] . ' %</td>'.
							            '<td>' . $today['pressure'] . ' hPa</td>'.

							        '</tr>';
        
		foreach ($forecast['list'] as $day) {

	        $element = '<tr>';
	        $element .= '<td>' . $day['dayOfWeek'] . ' ' .$day['date']->format('d/m/Y') . '</td>';
	        $element .= '<td>' . $day['icon'] . '<br/>' . $day['description'] . '</td>';
	        $element .= '<td>' . $day['temp'] . ' °C</td>';
	        $element .= '<td> N.C.*</td>';
	        $element .= '<td> N.C.*</td>';
	        $element .= '</tr>';

			$outputDataWeather .= $element;
		}

		$outputDataWeather .= '
		    </tbody>
		</table>';


		$this->outputData['openWeather'] = [
				'h2Weather' => $h2Weather,
				'outputDataWeather' => $outputDataWeather
		];

	}


	/**
	* Get displayCityMapperData
	*@return array
	*
	**/
	protected function displayCityMapperData()
	{
		$data = $this->inputData['cityMapper'];
		$travel = $data['travel'];


		$h2CityMapper = 'Temps estimé entre ' . $travel['startCity'] . ' et '. $travel['endCity'] . ' : ';
		$outputDataCityMapper = !is_null($travel['travel_time_minutes']) ?  $travel['travel_time_minutes'] . ' minutes.' : 'Données temporairement indisponibles.';


		$this->outputData['cityMapper'] = [
				'h2CityMapper' => $h2CityMapper,
				'outputDataCityMapper' => $outputDataCityMapper
		];
	}


}