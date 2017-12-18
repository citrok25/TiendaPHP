<?php



class ArticuloComestible extends Articulo {

	// Declaramos las propiedades de la clase
	private $temperatura;
	private $caducidad;

	// Implementamos los métodos de la clase
	
	// Métodos que inicializan las propiedades
	public function setTemperatura($temperatura) {
		$this->temperatura = $temperatura;
	}

	public function setCaducidad($caducidad) {
		$this->caducidad = $caducidad;
	}

		
	// Métodos que devuelven los valores de las propiedades
	public function getTemperatura() {
		return $this->temperatura;
	}

	public function getCaducidad() {
		return $this->caducidad;
	}


	
}
