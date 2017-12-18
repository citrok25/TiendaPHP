<?php


class Pedido {

	// Declaramos las propiedades de la clase
	private $localizador;
	private $fecha;
	private $hora;
	private $cliente;
	private $articulos;
	private $cantidad;
	private $precioVenta;
	private $baseImponible;
	private $totalPedido;

	// Implementamos los métodos de la clase
	// Métodos que inicializan las propiedades
	public function setLocalizador($localizador) {
		$this->localizador = $localizador;
	}

	public function setFecha($fecha) {
		$this->fecha = $fecha;
	}

	public function setHora($hora) {
		$this->hora = $hora;
	}

	public function setCliente($cliente) {
		$this->cliente = $cliente;
	}

	public function setArticulos($articulos) {
		$this->articulos = $articulos;
	}

	public function setCantidad($cantidad) {
		$this->cantidad = $cantidad;
	}

	public function setPrecioVenta($precioVenta) {
		$this->precioVenta = $precioVenta;
	}

	public function setBaseImponible() {
		$this->baseImponible = 0;
		foreach ($this->articulos as $articulo) {
			$this->baseImponible += $articulo[0]->getPrecioVenta() * $articulo[1];
		}
	}

	public function setTotalPedido() {
		$this->totalPedido = $this->baseImponible * 1.21;
	}

	// Métodos que devuelven los valores de las propiedades
	public function getLocalizador() {
		return $this->localizador;
	}

	public function getFecha() {
		return $this->fecha;
	}

	public function getHora() {
		return $this->hora;
	}

	public function getCliente() {
		return $this->cliente;
	}

	public function getArticulos() {
		return $this->articulos;
	}

	public function getCantidad() {
		return $this->cantidad;
	}

	public function getPrecioVenta() {
		return $this->precioVenta;
	}

	public function getBaseImponible() {
		return $this->baseImponible;
	}

	public function getTotalPedido() {
		return $this->totalPedido;
	}

	// Método que añade un pedido al archivo de pedidos
	public function escribirPedido() {
		// Inicializa el string con los datos del cliente
		$datosCliente = $this->getCliente()->getDni() . ';' .
				$this->getCliente()->getNombre() . ';' .
				$this->getCliente()->getDireccion() . ';' .
				$this->getCliente()->getEmail() . ';' .
				$this->getCliente()->getTelefono() . ';' .
				$this->getCliente()->getCp() . ';' .
				$this->getCliente()->getLocalidad() . ';' .
				$this->getCliente()->getProvincia() . ';' .
				$this->getCliente()->getPais();

		//var_dump($this->getArticulos());
		// Inicializa el string con los datos de los artículos
		$datosArticulos = '';
                
		foreach ($this->getArticulos() as $articulo) {
			//var_dump($articulo);
			$datosArticulo = $articulo[0]->getNombre() . ';' . $articulo[1];
			$datosArticulos = $datosArticulos.';'.$datosArticulo;
		}
		//var_dump($datosArticulos);

		// Inicializa el elemento a escribir
		//var_dump($this->getArticulos());
		$datosPedido = $this->getFecha() . ';' .
				$this->getHora() . ';' .
				$datosCliente .
				$datosArticulos."\n"; // La linea debe acabar con \n

		//var_dump($datosPedido);
		// Crea un objeto de la clase Archivo
		$archivo = new Archivo();
		// inicializa el nombre del archivo
		$archivo->setNombre('..\capaDatos\pedidos.txt');
		// Inicializa el elemento a escribir
		$archivo->setElemento($datosPedido);
		// Escribe en el archivo el nuevo pedido
		$archivo->escribirArchivo();
	}

}
