<?php
    function Calcular_Precio_Total_Producto(&$producto){
        $producto['total']=$producto['cantidad']*$producto['precio'];
    }

    function Calcular_Precio_Total_Compra($productos){
        $total = 0;
        foreach($productos as $producto){
            $total += $producto['total'];
        }
        return $total;
    }

?>