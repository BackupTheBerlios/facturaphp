<?php
//includes
//echo "<p>antes de objeto</p>";
require_once('inc/includes.php');
//echo "<p>antes de objeto</p>";
$object=new users();

$object->login='pepe';
$object->passwd='san';
$object->name='pepe';
$object->last_name='san';
$object->last_name2='tos';
$object->full_name='';
$salida=$object->add();
echo "<table><tr><td>A&ntilde;adiendo un usuario</td><td>";
if($salida>=0){

echo "<font color='green'>A&ntilde;adido</font>";
}else {

	echo "<p align='right'><font color='red'>No A&ntilde;adido</font></p>";
}
echo "</td></tr></table>";

$salida=$object->remove($object->id_user);
echo "<table><tr><td>Borrando el usuario recien creado</td><td>";
if($salida>=0){

echo "<font color='green'>Borrado</font>";
}else {

	echo "<p align='right'><font color='red'>No Borrado</font></p>";
}
echo "</td></tr></table>";

$salida=$object->read(1);
echo "<table><tr><td>Comprobando un usuario existente</td><td>";
if($salida>=0 && $object->login=='admin'){

echo "<font color='green'>Existe</font>";
}else {

	echo "<p align='right'><font color='red'>No Existe</font></p>";
}
echo "</td></tr></table>";

$object->name='Pepe';
$salida=$object->modify();

echo "<table><tr><td>Modificando un usuario existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificado</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificado</font></p>";
}
echo "</td></tr></table>";

$object->name='David';
$salida=$object->modify();

echo "<table><tr><td>Volviendo a Modificar un usuario existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificado</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificado</font></p>";
}
echo "</td></tr></table>";


?>