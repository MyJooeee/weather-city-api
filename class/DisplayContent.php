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
			'h1page' => $data['h1page'],
			'updateData' => $data['updateData']
		];
	}

	/**
	* Get displayOpenWeather data
	* @return array
	**/
	protected function displayOpenWeatherData() 
	{

		$data = $this->inputData['openWeather'];
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
							    <tbody>';
        
        $i = 0;
		foreach ($forecast['list'] as $day) {

	        $element = ($i === 0) ? '<tr id=\'today\'>' : '<tr>';

	        $element .= ($i === 0) ? '<td> Aujourd\'hui <br/>' . $day['dayOfWeek'] . ' ' .$day['date']->format('d/m/Y') . '</td>'
	        : '<td>' . $day['dayOfWeek'] . ' ' .$day['date']->format('d/m/Y') . '</td>';

	        $element .= '<td>' . $day['icon'] . '<br/>' . $day['description'] . '</td>';
	        $element .= '<td>' . $day['temp'] . ' °C</td>';
            $element .= '<td>' . $day['humidity'] . ' %</td>';
            $element .= '<td>' . $day['pressure'] . ' hPa</td>';
	        $element .= '</tr>';

			$outputDataWeather .= $element;
			$i++;
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