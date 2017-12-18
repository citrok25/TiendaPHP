
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Almacenamiento de Pedidos</title>
        <style>
            body {font-family: Verdana, sans-serif; font-size:1.0em;}
            header, nav, section, article, footer
            {text-align: center; margin:2px; padding:4px;}
			table {text-align: left; margin: auto;}
        </style>
    </head>
    <body>
		<header>
			<h1>Almacenamiento de Pedidos</h1>
		</header>
		<section>
			<h2>Pedido confirmado</h2>
			<?php
			// Incluye las clases correspondientes
			include '..\capaNegocio\articulo.php';
			include '..\capaNegocio\articuloComestible.php';
			include '..\capaNegocio\cliente.php';
			include '..\capaNegocio\pedido.php';

			// Comprueba si todas las variables del formulario estén tienen
			// algún valor
			if (isset($_POST['confirmar'])) {
				// Crea un objeto de tipo Cliente
				$cliente = new Cliente();
				// Inicializa sus propiedades
				$cliente->setDni($_POST['dni']);
				$cliente->setNombre($_POST['nombre']);
				$cliente->setDireccion($_POST['direccion']);
				$cliente->setEmail($_POST['email']);
				$cliente->setTelefono($_POST['telefono']);
				$cliente->setCp($_POST['cp']);
				$cliente->setLocalidad($_POST['localidad']);
				$cliente->setProvincia($_POST['provincia']);
				$cliente->setPais($_POST['pais']);

				// Crea un objeto de tipo Articulo
				$articulo = new Articulo();
				// Crea un array de objetos de tipo [Articulo, cantidad]
				for ($i = 1; $i <= $_POST['articulos']; $i++) {
					// Inicializa las propiedades del artículo
					$articulo->setNombre($_POST['articulo'.$i]);
					// Almacena el objeto Articulo
					$arrayArticulos[$i][0] = clone $articulo;
					// Almacena la cantidad
					$arrayArticulos[$i][1] = $_POST['cantidad'.$i];
				}
				
				// Crea un objeto de tipo Pedido
				$pedido = new Pedido();
				// Inicializa sus propiedades
				$pedido->setFecha($_POST['fecha']);
				$pedido->setHora($_POST['hora']);
				$pedido->setCliente($cliente);
				$pedido->setArticulos($arrayArticulos);
				$pedido->escribirPedido();
			}
			else {
				echo '<h4>No es posible confirmar el pedido</h4>';
			}
			?>
			<h3>Gracias por su visita</h3>
			<br>
			<a href="index.php">Volver a la página principal</a>
		</section>
		<footer>
			<h4>&copy; Almacenamiento de Pedidos</h4>
		</footer>
    </body>
</html>
