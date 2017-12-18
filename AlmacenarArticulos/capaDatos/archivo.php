<?php

class Archivo {

	// Atributos de la clase
	private $fd;   // Descriptor del archivo
	private $nombre;  // Nombre del archivo
	private $elemento;  // Elemento contenido en el archivo

	// Métodos que inicializan los valores de los atributos

	public function setNombre($nombre) {
		$this->nombre = $nombre;
	}

	public function setElemento($elemento) {
		$this->elemento = $elemento;
	}

	// Métodos que devuelven los valores de los atributos
	public function getNombre() {
		return $this->nombre;
	}

	public function getElemento() {
		return $this->elemento;
	}

	// Método que lee el contenido de un archivo de texto. Devuelve en
	// un array donde cada elemento del array se corresponde con una línea
	// del archivo. 
        // 
        // [0] "ref1;nombre1;descripcion1;etc"
        // [1] "ref2;nobmre2;descripcion2;etc"
        // 
        // En caso de error devuelve false.
        
	public function leerArchivo() {
		// Comprueba si el archivo existe
		if (file_exists($this->nombre)) {
			$contenido = file($this->nombre);
			// Comprueba si la apertura del archivo falla
			if (!$contenido) {
				// Devuelve error
				return false;
			}
			return $contenido;
		}
		// Devuelve error
		return false;
	}

	// Método que lee el contenido de un archivo de texto. Devuelve un string
	// con la línea del elemento buscado. En caso de error devuelve false.
	public function leerArchivoId($id) {
		// Comprueba si el archivo existe
		if (file_exists($this->nombre)) {
                    // Abre el archivo en modo de 'read only'
			$this->fd = fopen($this->nombre, 'r');
			// Comprueba si la apertura del archivo falla
			if (!$this->fd) {
				// Devuelve error
				return false;
			}
			// Bloquea el archivo para evitar inconsistencias
			flock($this->fd, LOCK_EX);
                        // Comprueba si se ha encontrado el articulo
			$encontrado = false;
			while ($encontrado === false && 
                                // Controla el fin del fichero
					($elemento = fgets($this->fd)) !== false) {
				// Extraemos los campos del elemento separando los campos con ;
				$linea = explode(";", $elemento);
                                // Compara dos string, y devuelve 0 si los dos String son iguales
				if (!strcmp($id, $linea[0])) {
					// Si es el buscado
					$encontrado = true;
				}
			}
			// Desbloquea el archivo
			flock($this->fd, LOCK_UN);
			// Cierra el archivo
			fclose($this->fd);
			if ($encontrado) {
				return $elemento;
			}
			// Devuelve error
			return false;
		}
		else {
			return false;
		}
	}

	// Método que escribe un array en un archivo de texto. 
	public function escribirArchivo() {
		// Abre el archivo en modo añadir
		$this->fd = fopen($this->nombre, 'a');
		// Si la apertura del archivo falla, informa del suceso
		if (!$this->fd) {
			return false;
		}
		// Bloquea el archivo para evitar inconsistencias con otros usuarios
		flock($this->fd, LOCK_EX);
		// Escribe el contenido del string en el archivo en una linea
		fwrite($this->fd, $this->elemento);
		// Desbloquea el archivo
		flock($this->fd, LOCK_UN);
		// Cierra el archivo
		fclose($this->fd);
	}
}
