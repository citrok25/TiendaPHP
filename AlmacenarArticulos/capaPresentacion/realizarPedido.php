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
            img {height: 50px; width: 100px}
        </style>
    </head>
    <body>
        <header>
            <h1>Almacenamiento de Pedidos</h1>
        </header>

        <section>
            <h1>Realizar el Pedido</h1>
            <nav>
                <a href="index.php">Inicio</a> |
                <a href="realizarPedido.php">Realizar pedido</a> |
                <a href="insertarArticulo.php">Añadir artículo</a> |
            </nav>
            <?php
            // Incluye la clase Elementos y Articulo
            include '..\capaNegocio\articulo.php';

            $articulos = new Articulo();

            // Inicializa un array de objetos de tipo Articulo
            $arrayArticulos = $articulos->leerArticulos();

            // Crea objetos de la clase Articulo e inicializa sus propiedades
            $articulo1 = new Articulo();
            //$articulo1->setNombre($arrayArticulos[0]->getNombre());
            //$articulo1->setImagen($arrayArticulos[0]->getImagen());

            $articulo2 = new Articulo();
            //$articulo2->setNombre($arrayArticulos[1]->getNombre());

            $articulo3 = new Articulo();
            //$articulo3->setNombre($arrayArticulos[2]->getNombre());

            $articulo4 = new Articulo();
            //$articulo4->setNombre($arrayArticulos[3]->getNombre());
            ?>
            <form action="procesarPedido.php" method="post">
                <table border="0">
                    <tr>
                        <td>DNI:</td>
                        <td>Nombre: </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="dni" size="40"
                                   autofocus></td>
                        <td><input type="text" name="nombre" size="40"></td>
                    </tr>
                    <tr>
                        <td>Dirección: </td>
                        <td>Teléfono: </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="direccion"
                                   size="40"></td>
                        <td><input type="text" name="telefono" size="40"></td>
                    </tr>
                    <tr>
                        <td>Email: </td>
                        <td>Código postal: </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="email" size="40"></td>
                        <td><input type="text" name="cp" size="40"></td>
                    </tr>
                    <tr>
                        <td>Localidad: </td>
                        <td>Provincia: </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="localidad" size="40"></td>
                        <td><input type="text" name="provincia" size="40"></td>
                    </tr>
                    <tr>
                        <td>País: </td>
                    </tr>
                    <tr>
                        <td><input type="text" name="pais" size="40"></td>
                    </tr>
                    <tr>
                        <td>Artículo: </td>
                        <td>Cantidad: </td>
                    </tr>
                    <!--
                    <tr>
                        <td><input type="checkbox" name="articulo1" size="40"
                                   value="1001">
                    <?php echo $articulo1->getNombre(); ?></td>
                        
                        <td>
                    <!-- Prueba insertar imagen --><!--
                    <input type="checkbox" name="articulo1" size="40"
                           value="1001"><img src="..\capaDatos\images\<?php echo $articulo1->getImagen(); ?>"/>
                    <?php echo $articulo1->getNombre(); ?></td>
                <td><input type="text" name="cantidad1" size="40"></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="articulo2" size="40"
                           value="1002">
                    <?php echo $articulo2->getNombre(); ?></td>
                <td><input type="text" name="cantidad2" size="40"></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="articulo3" size="40"
                           value="1003">
                    <?php echo $articulo3->getNombre(); ?></td>
                <td><input type="text" name="cantidad3" size="40"></td>
            </tr>
            <tr>
                <td><input type="checkbox" name="articulo4" size="40"
                           value="1004">
                    <?php echo $articulo4->getNombre(); ?></td>
                <td><input type="text" name="cantidad4" size="40"></td>
            </tr>
            
                    -->

                    <?php
                    // Inicializamos las propiedades que recogerá el formulario
                    $articulo = 'articulo01';
                    $cantidad = 'cantidad01';
                    $value = '1001';

                    for ($i = 0; $i < (count($arrayArticulos)); $i++) {
                    if (!empty($arrayArticulos[$i]->getNombre())) {
                            if ($arrayArticulos[$i]->getCantidad() > 0){
                                echo '<tr>
                                    <td><input type="checkbox" name="' . $articulo . '" size="40" value="' . $value . '">' . $arrayArticulos[$i]->getNombre() . ' </td>                              
                                    <td><input type="text" name="' . $cantidad . '" size="40"></td>
                                  </tr>';
                            }else{
                                echo '<tr>
                                    <td>' . $arrayArticulos[$i]->getNombre() . ' </td>                              
                                    <td><input type="text" name="' . $cantidad . '" size="40" readonly value="No hay articulos suficientes"></td>
                                  </tr>';
                            }
                        }
                    }
                    ?>
                    <tr>
                        <td> <br> </td>
                        <td> <br> </td>
                    </tr>
                    <tr>
                        <td colspan="2" align="center">
                            <input type="submit" value="Realizar pedido"
                                   style="height:40px; width: 200px;">
                            <input type="reset" value="Cancelar"
                                   style="height:40px; width: 200px;">
                        </td>
                    </tr>
                </table>
            </form>
        </section>
        <footer>
            <h4>&copy; Almacenamiento de Pedidos</h4>
        </footer>
    </body>
</html>

