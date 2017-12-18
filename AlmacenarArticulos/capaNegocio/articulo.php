<?php

// Incluye la clase Archivo
include '..\capaDatos\archivo.php';

class Articulo {

	// Declaramos las propiedades de la clase
	protected $referencia;
	protected $nombre;
	protected $descripcion;
	protected $imagen;
	protected $precioVenta;
	protected $precioCompra;
	protected $cantidad;

	// Métodos que inicializan las propiedades
	public function setReferencia($referencia) {
		$this->referencia = $referencia;
	}

	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function setDescripcion($descripcion) {
		$this->descripcion = $descripcion;
	}

	public function setImagen($imagen) {
		$this->imagen = $imagen;
	}

	public function setPrecioVenta($precioVenta) {
		$this->precioVenta = $precioVenta;
	}

	public function setPrecioCompra($precioCompra) {
		$this->precioCompra = $precioCompra;
	}

	public function setCantidad($cantidad) {
		$this->cantidad = $cantidad;
	}

	// Métodos que devuelven los valores de las propiedades
	public function getReferencia() {
		return $this->referencia;
	}

	public function getNombre() {
		return $this->nombre;
	}

	public function getDescripcion() {
		return $this->descripcion;
	}

	public function getImagen() {
		return $this->imagen;
	}

	public function getPrecioVenta() {
		return $this->precioVenta;
	}

	public function getPrecioCompra() {
		return $this->precioCompra;
	}

	public function getCantidad() {
		return $this->cantidad;
	}

	// Método que devuelve un array con todos los elementos almacenados en el
	// archivo de texto correspondiente
	public function leerArticulos() {
		// Crea un objeto de la clase Archivo
		$archivo = new Archivo();
		// inicializa sus propiedades
		$archivo->setNombre('..\capaDatos\articulos.txt');
		// Lee el contenido del archivo y lo almacena en un array de strings
		$lineasArticulo = $archivo->leerArchivo();
		// Recorre el array de strings linea a linea
		foreach ($lineasArticulo as $i => $valor) {
			// Divide la cadena utilizando como separador de campos el ;
			$linea_articulo = explode(";", $valor);
			// Inicializa los valores de las propiedades del objeto
			$this->referencia = $linea_articulo[0];
			$this->nombre = $linea_articulo[1];
			$this->descripcion = $linea_articulo[2];
			$this->imagen = $linea_articulo[3];
			$this->precioVenta = $linea_articulo[4];
			$this->precioCompra = $linea_articulo[5];
			$this->cantidad = $linea_articulo[6];
			// Añade un objeto al array de objetos de tipo Artículo
			$arrayArticulos[$i] = clone $this;
		}
		// Devuelve un array de objetos de tipo Articulo
		return $arrayArticulos;
	}

	// Método que devuelve un array con todos los elementos almacenados en el
	// archivo de texto correspondiente
	public function leerArticuloReferencia($referencia) {
		// Crea un objeto de la clase Archivo
		$archivo = new Archivo();
		// inicializa sus propiedades
		$archivo->setNombre('..\capaDatos\articulos.txt');
		// Almacena en un string la línea que contiene como primer campo la 
		// referencia pasada como argumento
		$lineaArticulo = $archivo->leerArchivoId($referencia);
		// Divide la cadena utilizando como separador de campos el ;
		$linea_articulo = explode(";", $lineaArticulo);
		// Inicializa los valores de las propiedades del objeto
		$this->referencia = $linea_articulo[0];
		$this->nombre = $linea_articulo[1];
		$this->descripcion = $linea_articulo[2];
		$this->imagen = $linea_articulo[3];
		$this->precioVenta = $linea_articulo[4];
		$this->precioCompra = $linea_articulo[5];
		$this->cantidad = $linea_articulo[6];
		// Devuelve el objeto de tipo Articulo
		return $this;
	}
        
        public function insertarArticulo() {
		// Inicializa el string con los datos del cliente
		$datosArticulo = $this->referencia . ';' .
				$this->nombre . ';' .
				$this->descripcion . ';' .
				$this->imagen . ';' .
				$this->precioVenta . ';' .
				$this->precioCompra . ';' .
				$this->cantidad . ';' . "\n" ;

		//var_dump($datosPedido);
		// Crea un objeto de la clase Archivo
		$archivo = new Archivo();
		// inicializa el nombre del archivo
		$archivo->setNombre('..\capaDatos\articulos.txt');
		// Inicializa el elemento a escribir
		$archivo->setElemento($datosArticulo);
		// Escribe en el archivo el nuevo pedido
		$archivo->escribirArchivo();
	}

}
