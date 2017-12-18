<?php


class Cliente {

	// Declaramos las propiedades de la clase
	private $dni;
	private $nombre;
	private $direccion;
	private $email;
	private $telefono;
	private $cp;
	private $localidad;
	private $provincia;
	private $pais;

	// Implementamos los métodos de la clase
	
	// Métodos que inicializan las propiedades
	public function setIdCliente($idCliente) {
		$this->idCliente = $idCliente;
	}

	public function setDni($dni) {
		$this->dni = $dni;
	}

	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function setDireccion($direccion) {
		$this->direccion = $direccion;
	}

	public function setEmail($email) {
		$this->email = $email;
	}

	public function setTelefono($telefono) {
		$this->telefono = $telefono;
	}

	public function setCp($cp) {
		$this->cp = $cp;
	}

	public function setLocalidad($localidad) {
		$this->localidad = $localidad;
	}

	public function setProvincia($provincia) {
		$this->provincia = $provincia;
	}

	public function setPais($pais) {
		$this->pais = $pais;
	}

		
	// Métodos que devuelven los valores de las propiedades
	public function getIdCliente() {
		return $this->idCliente;
	}

	public function getDni() {
		return $this->dni;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function getDireccion() {
		return $this->direccion;
	}

	public function getEmail() {
		return $this->email;
	}

	public function getTelefono() {
		return $this->telefono;
	}

	public function getCp() {
		return $this->cp;
	}

	public function getLocalidad() {
		return $this->localidad;
	}

	public function getProvincia() {
		return $this->provincia;
	}

	public function getPais() {
		return $this->pais;
	}
}
