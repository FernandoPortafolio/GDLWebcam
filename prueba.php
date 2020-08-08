<?php

   //Clase que sirve para revisar un formulario
   echo '<pre>';
   var_dump($_POST);
   echo '</pre>';

   include 'includes/functions/funciones.php';

   $json = productos_to_json($_POST['boletos'], $_POST['pedido_extra']['camisas']['cantidad'], $_POST['pedido_extra']['etiquetas']['cantidad']);
   $json2 = eventos_to_json($_POST['registro']);

   echo '<pre>';
   var_dump($json);
   var_dump($json2);
   echo '</pre>';