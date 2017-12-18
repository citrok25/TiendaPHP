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
			<h1>Confirmar el Pedido</h1>
			<?php
			// Incluye las clases correspondientes
			include '..\capaNegocio\articulo.php';
			include '..\capaNegocio\articuloComestible.php';
			include '..\capaNegocio\cliente.php';
			include '..\capaNegocio\pedido.php';

			// Comprueba si todas las variables del formulario estén tienen
			// algún valor
			if (!empty($_POST['dni']) && !empty($_POST['nombre']) &&
					!empty($_POST['direccion']) && !empty($_POST['telefono']) &&
					!empty($_POST['email']) && !empty($_POST['cp']) &&
					!empty($_POST['localidad']) && !empty($_POST['provincia']) &&
					!empty($_POST['pais'])) {
				// Instancia un objeto de tipo Cliente
				$cliente = new Cliente();
				// Inicializa todas sus propiedades
				$cliente->setDni($_POST['dni']);
				$cliente->setNombre($_POST['nombre']);
				$cliente->setDireccion($_POST['direccion']);
				$cliente->setEmail($_POST['email']);
				$cliente->setTelefono($_POST['telefono']);
				$cliente->setCp($_POST['cp']);
				$cliente->setLocalidad($_POST['localidad']);
				$cliente->setProvincia($_POST['provincia']);
				$cliente->setPais($_POST['pais']);

				// Bandera de control que indica si al menos hay un artículo
				// seleccionado
				$articuloSeleccionado = false;
				
				// Bandera de control de error en la cantidad de artículos
				$errorArticulo1 = false;
				$errorArticulo2 = false;
				$errorArticulo3 = false;
				$errorArticulo4 = false;

				// Identifica los artículos seleccionados y los almacena en
				// un array de objetos de tipo Articulo
				$articulo = new Articulo();
				if (isset($_POST['articulo01']) && !empty($_POST['cantidad01'])) {
					// Se ha seleccionado el artículo
					$articuloSeleccionado = true;
					// Almacena en un array de objetos un objeto Articulo
					// junto con su cantidad
					$arrayArticulos[1][0] = clone $articulo->leerArticuloReferencia($_POST['articulo01']);
					$arrayArticulos[1][1] = $_POST['cantidad01'];
					// Comprueba si existe cantidad suficiente de artículo
					if ($arrayArticulos[1][1] > $arrayArticulos[1][0]->getCantidad()) {
						// Error en la cantidad
						$errorArticulo1 = true;
						echo '<h4>No hay cantidad suficiente del artículo ' .
						$arrayArticulos[1][0]->getNombre() . '</h4>';
					}
				}

				if (isset($_POST['articulo02']) && !empty($_POST['cantidad02'])) {
					// Se ha seleccionado el artículo
					$articuloSeleccionado = true;
					// Almacena en un array de objetos un objeto Articulo
					// junto con su cantidad
					$arrayArticulos[2][0] = clone $articulo->leerArticuloReferencia($_POST['articulo02']);
					$arrayArticulos[2][1] = $_POST['cantidad02'];
					// Comprueba si existe cantidad suficiente de artículo
					if ($arrayArticulos[2][1] > $arrayArticulos[2][0]->getCantidad()) {
						$errorArticulo2 = true;
						// Error en la cantidad
						echo '<h4>No hay cantidad suficiente del artículo ' .
						$arrayArticulos[2][0]->getNombre() . '</h4>';
					}
				}

				if (isset($_POST['articulo03']) && !empty($_POST['cantidad03'])) {
					// Se ha seleccionado el artículo
					$articuloSeleccionado = true;
					// Almacena en un array de objetos un objeto Articulo
					// junto con su cantidad
					$arrayArticulos[3][0] = clone $articulo->leerArticuloReferencia($_POST['articulo03']);
					$arrayArticulos[3][1] = $_POST['cantidad03'];
					// Comprueba si existe cantidad suficiente de artículo
					if ($arrayArticulos[3][1] > $arrayArticulos[3][0]->getCantidad()) {
						$errorArticulo3 = true;
						// Error en la cantidad
						echo '<h4>No hay cantidad suficiente del artículo ' .
						$arrayArticulos[3][0]->getNombre() . '</h4>';
					}
				}

				if (isset($_POST['articulo04']) && !empty($_POST['cantidad04'])) {
					// Se ha seleccionado el artículo
					$articuloSeleccionado = true;
					// Almacena en un array de objetos un objeto Articulo
					// junto con su cantidad
					$arrayArticulos[4][0] = clone $articulo->leerArticuloReferencia($_POST['articulo04']);
					$arrayArticulos[4][1] = $_POST['cantidad04'];
					// Comprueba si existe cantidad suficiente de artículo
					if ($arrayArticulos[4][1] > $arrayArticulos[4][0]->getCantidad()) {
						$errorArticulo4 = true;
						// Error en la cantidad
						echo '<h4>No hay cantidad suficiente del artículo ' .
						$arrayArticulos[4][0]->getNombre() . '</h4>';
					}
				}

				// Si no hay errores en los artículos y cantidades seleccionados
				if ($articuloSeleccionado && 
						!$errorArticulo1 && !$errorArticulo2 &&
						!$errorArticulo3 && !$errorArticulo4) {
					// Instancia un objeto de tipo Pedido
					$pedido = new Pedido();
					// Inicializa las propiedades del pedido
					$pedido->setFecha(date('d/m/Y'));
					$pedido->setHora(date('H:i'));
					$pedido->setCliente($cliente);
					$pedido->setArticulos($arrayArticulos);
					?>
					<form action="confirmarPedido.php" method="post">
						<table border="0">
							<tr>
								<td>Fecha:</td>
								<td>Hora: </td>
							</tr>
							<tr>
								<td><input type="text" name="fecha" value="<?php
									echo $pedido->getFecha();
									?>"
										   size="40" readonly></td>
								<td><input type="text" name="hora" value="<?php
									echo $pedido->getHora();
									?>"
										   size="40" readonly></td>
							</tr>
							<tr>
								<td>DNI:</td>
								<td>Nombre: </td>
							</tr>
							<tr>
								<td><input type="text" name="dni" value="<?php
									echo $pedido->getCliente()->getDni();
									?>"
										   size="40" readonly></td>
								<td><input type="text" name="nombre" value="<?php
									echo $pedido->getcliente()->getNombre();
									?>"
										   size="40" readonly></td>
							</tr>
							<tr>
								<td >Dirección: </td>
								<td >Teléfono: </td>
							</tr>
							<tr>
								<td><input type="text" name="direccion" value="<?php
									echo $pedido->getcliente()->getDireccion();
									?>"
										   size="40" readonly></td>
								<td><input type="text" name="telefono" value="<?php
									echo $pedido->getcliente()->getTelefono();
									?>"
										   size="40" readonly></td>
							</tr>
							<tr>
								<td>Email: </td>
								<td>Código postal: </td>
							</tr>
							<tr>
								<td><input type="text" name="email" value="<?php
									echo $pedido->getcliente()->getEmail();
									?>"
										   size="40" readonly></td>
								<td ><input type="text" name="cp" value="<?php
									echo $pedido->getcliente()->getCp();
									?>"
											size="40" readonly></td>
							</tr>
							<tr>
								<td>Localidad: </td>
								<td>Provincia: </td>
							</tr>
							<tr>
								<td ><input type="text" name="localidad" value="<?php
									echo $pedido->getcliente()->getLocalidad();
									?>"
											size="40" readonly></td>
								<td><input type="text" name="provincia" value="<?php
									echo $pedido->getcliente()->getProvincia();
									?>"
										   size="40" readonly></td>
							</tr>
							<tr>
								<td>País: </td>
							</tr>
							<tr>
								<td><input type="text" name="pais" value="<?php
									echo $pedido->getcliente()->getPais();
									?>"
										   size="40" readonly></td>
							</tr>
							<tr>
								<td>Artículo: </td>
								<td>Cantidad: </td>
								<td>Precio: </td>
								<td>Total: </td>
							</tr>
							<?php
							// Acumula el total del pedido
							$totalPedido = 0;
							$i = 1;
							// Recorre el array de objetos [Articulo, cantidad]
							foreach ($pedido->getArticulos() as $lineaArticulo) {
								?>
								<tr>
									<td><input type="text" 
										name="articulo<?php echo $i; ?>" 
										value="<?php
										echo $lineaArticulo[0]->getNombre();
										?>"
										size="40" readonly></td>
									<td><input type="text" 
										name="cantidad<?php echo $i; ?>" 
										value="<?php
										echo $lineaArticulo[1];
										?>"
										size="40" readonly></td>
									<td><input type="text" 
										name="precio<?php echo $i; ?>" 
										value="<?php
										echo number_format($lineaArticulo[0]->getPrecioVenta(), 2);
										?>€"
										size="10" readonly></td>
									<td><input type="text" value="<?php
										$totalPedido += $lineaArticulo[0]->getPrecioVenta() * $lineaArticulo[1];
										echo number_format($lineaArticulo[0]->getPrecioVenta() * $lineaArticulo[1], 2);
										?>€"
										size="10" readonly></td>
									</tr>
								<?php
								$i++;
							}
							$pedido->setBaseImponible();
							$pedido->setTotalPedido();
							?>
							<tr>
								<td colspan="3" align="right">Base imponible del pedido: </td>
								<td><input type="text" value="<?php
									echo number_format($pedido->getBaseImponible(), 2);
									?>€"
									size="10" readonly></td>
							</tr>
							<tr>
								<td colspan="3" align="right">Precio total del pedido con IVA: </td>
								<td><input type="text" value="<?php
									echo number_format($pedido->getTotalPedido(), 2);
									?>€"
									size="10" readonly></td>
							</tr>
							<tr>
								<td> <br> </td> <td> <br> </td>
							</tr>
							<tr>
								<td colspan="4" align="center">
									<input type="hidden" name="articulos" value="<?php echo $i-1?>">
									<input type="submit" name="confirmar" value="Confirmar pedido"
										   style="height:40px; width: 200px">
									<input type="button" value="Cancelar"
										   onClick="javascript:window.history.back();"
										   style="height:40px; width: 200px">
								</td>
							</tr>
						</table>
					</form>
					<?php
				}
				else {
					echo '<h4>No es posible realizar el pedido</h4>';
					echo '<h4>Debes seleccionar algún artículo junto con su cantidad</h4>';
					echo '<br><a href="javascript:window.history.back();">
							Volver a la página inicial</a>';
				}
			}
			else {
				// Comprueba si todos las variables de formulario han sido
				// inicializadas
				if (isset($_POST['dni']) || isset($_POST['nombre']) ||
						isset($_POST['direccion']) || isset($_POST['telefono']) ||
						isset($_POST['email']) || isset($_POST['cp']) ||
						isset($_POST['localidad']) || isset($_POST['provincia']) ||
						isset($_POST['pais'])) {
					// Todos las variables de formulario deben estar inicializadas
					echo '<h4>Todos los campos del formulario deben estar inicializados</h4>';
				}
				echo '<br>
					<a href="javascript:window.history.back();">Volver a la página inicial</a>';
			}
			?>
		</section>
		<footer>
			<h4>&copy; Almacenamiento de Pedidos</h4>
		</footer>
    </body>
</html>
