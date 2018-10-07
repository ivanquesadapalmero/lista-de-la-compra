
<?php
include 'funciones.php'; 
$productos = array();
$error = null;
if (isset($_POST['insertar'])) {
    if (isset($_POST['nombres'])) {
        for ($i=0; $i<count($_POST['nombres']); $i++) {
            $producto = array();
            $producto['nombre'] = $_POST['nombres'][$i];
            $producto['cantidad'] = $_POST['cantidades'][$i];
            $producto['precio'] = $_POST['precios'][$i];
            $producto['total'] = $_POST['totales'][$i];
            $productos[] = $producto;
        }
        
    }
    if((empty($_POST['nombre']))||(empty($_POST['cantidad']))||(empty($_POST['precio']))){
        $error = "No puedes dejar el nombre vacío"; 
        
    } else {
        $producto = array();
        $producto['nombre']=$_POST['nombre'];
        $producto['cantidad']=$_POST['cantidad'];
        $producto['precio']=$_POST['precio'];
        Calcular_Precio_Total_Producto($producto);
        $productos[] = $producto;
    }
}

if (isset($_POST['borrar'])) {
    if (isset($_POST['nombres'])) {
        for ($i=0; $i<count($_POST['nombres']); $i++) {
            $producto = array();
            $producto['nombre'] = $_POST['nombres'][$i];
            $producto['cantidad'] = $_POST['cantidades'][$i];
            $producto['precio'] = $_POST['precios'][$i];
            $producto['total'] = $_POST['totales'][$i];
            $productos[] = $producto;
        }

        $nombre = $_POST['borrado'];
        for ($i=0 ; $i < count($productos) ; $i++){
            if($productos[$i]['nombre'] == $nombre){
                unset($productos[$i]);
                $productos = array_values($productos);
            }
        }
    }

    

    

}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lista de la compra</title>
    <link rel="stylesheet" type="text/css" href="./estilos.css" media="screen" />
</head>
<body>
    <h1>Lista de la compra <?php echo date('j/m/Y'); ?></h1> 
    
    <div>
    <table border = 1px>
        <tr>
            <th>Nombre</th>
            <th>Cantidad</th>
            <th>Precio</th>
            <th>Total</th>
        </tr> 
        <?php     
        foreach($productos as $producto ){
                print"<tr>
                <td>".$producto['nombre']."</td>
                <td>".$producto['cantidad']."</td>
                <td>".$producto['precio']."€</td>
                <td>".$producto['total']."€</td>
                </tr>";
                
            }

        print"<tr><td colspan=3> Total de compra</td>
        <td >".Calcular_Precio_Total_Compra($productos)."€</td>
        </tr>"
        
        
           
        ?>
        </table>
        <h2>Añadir producto</h2>
            
                <form name="input" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    Nombre: <input type="text" name="nombre" value=""/> <span style="color:red"><?php echo $error  ?></span><br />
                    
                    Cantidad: <input type="text" name="cantidad" value=""/> <br />

                    Precio: <input type="text" name="precio" value=""/> <br />
                    <input type="submit" value="Insertar" name="insertar"/>
                    <?php
                    foreach($productos as $producto) {
                        echo '<input type="hidden" name="nombres[]" value="' . $producto['nombre'] . '" />';
                        echo '<input type="hidden" name="cantidades[]" value="' . $producto['cantidad'] . '" />';
                        echo '<input type="hidden" name="precios[]" value="' . $producto['precio'] . '" />';
                        echo '<input type="hidden" name="totales[]" value="' . $producto['total'] . '" />';
                    }
                    ?>
                </form>
        <h2>Borrar producto</h2>
                
                <form name="input" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
                    
                    <select name="borrado">
                    <?php
                    foreach($productos as $producto ){
                         print"
                         <option>".$producto['nombre']."</option>";
                    }
                    ?>
                    <input type="submit" value="Borrar" name="borrar"/>
                    </select>
                    <?php
                    
                    foreach($productos as $producto) {
                        echo '<input type="hidden" name="nombres[]" value="' . $producto['nombre'] . '" />';
                        echo '<input type="hidden" name="cantidades[]" value="' . $producto['cantidad'] . '" />';
                        echo '<input type="hidden" name="precios[]" value="' . $producto['precio'] . '" />';
                        echo '<input type="hidden" name="totales[]" value="' . $producto['total'] . '" />';
                    }
                    ?>
                </form>  
        </div>  
</body>
</html>
