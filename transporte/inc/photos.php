<?php
if((isset($_GET['module']))&& (isset($_GET['method']))&&($_GET['module']=='vehicles')&&($_GET['method']=='add'))
{
   $_SESSION['ruta_photo'] = "";
   $_SESSION['nombre_photo'] = $_FILES['path_photo']['name'];
   $_SESSION['ruta_temporal'] =  $_FILES['path_photo']['tmp_name'];
   $_SESSION['tamanno_photo'] = $_FILES['path_photo']['size'];
 }
 

//Si se modifica la foto de un coche
if((isset($_GET['module']))&& (isset($_GET['method']))&&($_GET['module']=='vehicles')&&($_GET['method']=='modify'))
{
 $_SESSION['ruta_photo'] = "";
 $_SESSION['nombre_photo'] = $_FILES['path_photo']['name'];
 $_SESSION['ruta_temporal'] =  $_FILES['path_photo']['tmp_name'];
 $_SESSION['tamanno_photo'] = $_FILES['path_photo']['size'];
}

//Si se añade la foto de una categoria de producto
if((isset($_GET['module']))&& (isset($_GET['method']))&&($_GET['module']=='cat_prods')&&($_GET['method']=='add'))
{
   $_SESSION['ruta_photo'] = "";
   $_SESSION['nombre_photo'] = $_FILES['path_photo']['name'];
   $_SESSION['ruta_temporal'] =  $_FILES['path_photo']['tmp_name'];
   $_SESSION['tamanno_photo'] = $_FILES['path_photo']['size'];
}

//Si se modifica la foto de una categoria de producto
if((isset($_GET['module']))&& (isset($_GET['method']))&&($_GET['module']=='cat_prods')&&($_GET['method']=='modify'))
{
   $_SESSION['ruta_photo'] = "";
   $_SESSION['nombre_photo'] = $_FILES['path_photo']['name'];
   $_SESSION['ruta_temporal'] =  $_FILES['path_photo']['tmp_name'];
   $_SESSION['tamanno_photo'] = $_FILES['path_photo']['size'];
}
?>