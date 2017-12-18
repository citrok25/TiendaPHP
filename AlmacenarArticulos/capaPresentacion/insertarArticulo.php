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
            <nav>
                <a href="index.php">Inicio</a> |
                <a href="realizarPedido.php">Realizar pedido</a> |
                <a href="insertarArticulo.php">Añadir artículo</a> |
            </nav>
            
            <h1>Insertar artículo</h1>
            
            <?php
            
            include '..\capaNegocio\articulo.php';
            
            // Comprobar que todas las variables del formulario estén inicializadas
            
            if (!empty($_POST['referencia']) && 
                    !empty($_POST['nombre']) && 
                    !empty($_POST['descripcion']) && 
                    !empty($_POST['imagen']) && 
                    !empty($_POST['precioventa']) && 
                    !empty($_POST['preciocompra']) && 
                    !empty($_POST['cantidad'])){
                
                // Crea un articulo
                echo '<br><h4>Insertando artículo..</h4>';
                $articulo = new Articulo();
                
                // Inicializa las propiedades del objeto
                $articulo->setReferencia($_POST['referencia']);
                $articulo->setNombre($_POST['nombre']);
                $articulo->setDescripcion($_POST['descripcion']);
                $articulo->setImagen($_POST['imagen']);
                $articulo->setPrecioCompra($_POST['preciocompra']);
                $articulo->setPrecioVenta($_POST['precioventa']);
                
                $articulo->setCantidad($_POST['cantidad']);
                
                // Almacena el artículo de forma permanente
                // Si falla al abrir/escribir el archivo, entra en el IF e informa del error
                if (!$articulo->insertarArticulo()){
                    echo '<br><h4>Fallo al insertar el artículo.</h4>';
                }
                
                // Si todo ha ido bien, informa de que el articulo se ha insertado 
                echo '<br><h4>Artículo insertado correctamente.</h4>';
                
                echo '<a href="javascript:window.history.back()">Volver a insertar artículo</a>';
                
            }else if (isset($_POST['referencia']) ||
                    isset($_POST['nombre']) ||
                    isset($_POST['descripcion']) ||
                    isset($_POST['imagen']) ||
                    isset($_POST['precioventa']) ||
                    isset($_POST['preciocompra']) ||
                    isset($_POST['cantidad'])){
                
                echo '<h4>Todos los campos del formulario son obligatorios</h4>';
                echo '<a href="javascript:window.history.back()">Volver a insertar artículo</a>';   
            }else{
                // Muestra el formulario la primera vez que se accede al módulo
                ?>
            <form action="insertarArticulo.php" method="post">
                <table border="0">
                    <tr>
                        <td>Referencia:</td>
                        <td>Nombre: </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="referencia" size="40" autofocus></td>
                        <td><input type="text" name="nombre" size="40"></td>
                    </tr>
                    <tr>
                        <td>Descripción: </td>
                        <td>Imagen: </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="descripcion" size="40"></td>
                        <td><input type="text" name="imagen" size="40"></td>
                    </tr>
                    <tr>
                        <td>Precio de venta: </td>
                        <td>Precio de compra: </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="precioventa" size="40"></td>
                        <td><input type="text" name="preciocompra" size="40"></td>
                    </tr>
                    <tr>
                        <td>Cantidad: </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="cantidad" size="40"></td>
                    </tr>
                    <tr>
                        <td> <br> </td>
                        <td> <br> </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Insertar Artículo"
                                   style="height:40px; width: 200px;">
                            <input type="reset" value="Cancelar"
                                   style="height:40px; width: 200px;">
                        </td>
                    </tr>
                </table>
            </form>
            <?php
            // Cierra el ELSE que muestra el formulario
            }
            ?>
        </section>
        <footer>
            <h4>&copy; Almacenamiento de Pedidos</h4>
        </footer>
    </body>
</html>