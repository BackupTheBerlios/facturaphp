<?php
//includes
//echo "<p>antes de objeto</p>";
require_once('inc/includes.php');
//echo "<p>antes de objeto</p>";
echo "<h3>Usuarios</h3>";
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

//declaramos un nuevo grupo
//echo "<p>antes de grupo</p>";
echo "<br><h3>Grupos</h3>";
$grupo= new groups();
//echo "<p>despues de grupo</p>";
//a–adimos sus variables
$grupo->name='grupo1';
$grupo->name_web='Grupo numero 1';
$grupo->desc='Descripci—n con texto adicional para el grupo 1';
$salida=$grupo->add();
echo "<table><tr><td>A&ntilde;adiendo un grupo</td><td>";
if($salida>=0){

echo "<font color='green'>A&ntilde;adido</font>";
}else {

	echo "<p align='right'><font color='red'>No A&ntilde;adido</font></p>";
}
echo "</td></tr></table>";

$salida=$grupo->remove($grupo->id_group);
echo "<table><tr><td>Borrando el grupo recien creado</td><td>";
if($salida>=0){

echo "<font color='green'>Borrado</font>";
}else {

	echo "<p align='right'><font color='red'>No Borrado</font></p>";
}
echo "</td></tr></table>";

$salida=$grupo->read(1);
echo "<table><tr><td>Comprobando un grupo existente</td><td>";
if($salida>=0 && $grupo->name=='Mi_grupo'){

echo "<font color='green'>Existe</font>";
}else {

	echo "<p align='right'><font color='red'>No Existe</font></p>";
}
echo "</td></tr></table>";

$grupo->name='grupo2';
$salida=$grupo->modify();

echo "<table><tr><td>Modificando un grupo existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificado</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificado</font></p>";
}
echo "</td></tr></table>";

$grupo->name='Mi_grupo';
$salida=$grupo->modify();

echo "<table><tr><td>Volviendo a Modificar un grupo existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificado</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificado</font></p>";
}
echo "</td></tr></table>";

//declaramos un nuevo relacion grupo usuario
//echo "<p>antes de objeto</p>";
echo "<br><h3>Relaci&oacute;n Grupos Usuarios</h3>";
$grupo_usuario= new group_users();
//echo "<p>despues de objeto</p>";
//a–adimos sus variables
$grupo_usuario->id_group=2;
$grupo_usuario->id_user=2;
$grupo_usuario->up='2004-12-12';
$salida=$grupo_usuario->add();
echo "<table><tr><td>A&ntilde;adiendo una relaci&oacute;n grupo usuario</td><td>";
if($salida>=0){

echo "<font color='green'>A&ntilde;adida</font>";
}else {

	echo "<p align='right'><font color='red'>No A&ntilde;adida</font></p>";
}
echo "</td></tr></table>";

$salida=$grupo_usuario->remove($grupo_usuario->id_group_user);
echo "<table><tr><td>Borrando la relaci&oacute;n grupo usuario recien creada</td><td>";
if($salida>=0){

echo "<font color='green'>Borrada</font>";
}else {

	echo "<p align='right'><font color='red'>No Borrada</font></p>";
}
echo "</td></tr></table>";

$salida=$grupo_usuario->read(1);
echo "<table><tr><td>Comprobando una relaci&oacute;n grupo usuario existente</td><td>";
if($salida>=0 && $grupo_usuario->id_group==1){

echo "<font color='green'>Existe</font>";
}else {

	echo "<p align='right'><font color='red'>No Existe</font></p>";
}
echo "</td></tr></table>";

$grupo_usuario->id_group=27;
$salida=$grupo_usuario->modify();

echo "<table><tr><td>Modificando una relaci&oacute;n grupo usuario existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificada</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificada</font></p>";
}
echo "</td></tr></table>";

$grupo_usuario->id_group=1;
$salida=$grupo_usuario->modify();

echo "<table><tr><td>Volviendo a Modificar una relaci&oacute;n grupo usuario existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificada</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificada</font></p>";
}
echo "</td></tr></table>";

//declaramos un nuevo relacion de permisos grupo modulo
//echo "<p>antes de objeto</p>";
echo "<br><h3>Relaci&oacute;n Permisos Grupos modulos</h3>";
$permiso_grupo_modulo= new per_group_modules();
//echo "<p>despues de objeto</p>";
//a–adimos sus variables
$permiso_grupo_modulo->id_group=2;
$permiso_grupo_modulo->id_module=2;
$permiso_grupo_modulo->per=2;
$salida=$permiso_grupo_modulo->add();
echo "<table><tr><td>A&ntilde;adiendo una relaci&oacute;n de permiso grupo modulo</td><td>";
if($salida>=0){

echo "<font color='green'>A&ntilde;adida</font>";
}else {

	echo "<p align='right'><font color='red'>No A&ntilde;adida</font></p>";
}
echo "</td></tr></table>";

$salida=$permiso_grupo_modulo->remove($permiso_grupo_modulo->id_per_group_module);
echo "<table><tr><td>Borrando la relaci&oacute;n de permiso grupo modulo recien creada</td><td>";
if($salida>=0){

echo "<font color='green'>Borrada</font>";
}else {

	echo "<p align='right'><font color='red'>No Borrada</font></p>";
}
echo "</td></tr></table>";

$salida=$permiso_grupo_modulo->read(1);
echo "<table><tr><td>Comprobando una relaci&oacute;n de permiso grupo modulo existente</td><td>";
if($salida>=0 && $permiso_grupo_modulo->id_group==1){

echo "<font color='green'>Existe</font>";
}else {

	echo "<p align='right'><font color='red'>No Existe</font></p>";
}
echo "</td></tr></table>";

$permiso_grupo_modulo->id_group=27;
$salida=$permiso_grupo_modulo->modify();

echo "<table><tr><td>Modificando una relaci&oacute;n de permiso grupo modulo existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificada</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificada</font></p>";
}
echo "</td></tr></table>";

$permiso_grupo_modulo->id_group=1;
$salida=$permiso_grupo_modulo->modify();

echo "<table><tr><td>Volviendo a Modificar una relaci&oacute;n de permiso grupo modulo existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificada</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificada</font></p>";
}
echo "</td></tr></table>";

//declaramos un nuevo relacion de permisos grupo modulo
//echo "<p>antes de objeto</p>";
echo "<br><h3>Relaci&oacute;n Permisos Usuarios modulos</h3>";
$permiso_usuario_modulo= new per_user_modules();
//echo "<p>despues de objeto</p>";
//a–adimos sus variables
$permiso_usuario_modulo->id_user=2;
$permiso_usuario_modulo->id_module=2;
$permiso_usuario_modulo->per=2;
$salida=$permiso_usuario_modulo->add();
echo "<table><tr><td>A&ntilde;adiendo una relaci&oacute;n de permiso usuario modulo</td><td>";
if($salida>=0){

echo "<font color='green'>A&ntilde;adida</font>";
}else {

	echo "<p align='right'><font color='red'>No A&ntilde;adida</font></p>";
}
echo "</td></tr></table>";

$salida=$permiso_usuario_modulo->remove($permiso_usuario_modulo->id_per_user_module);
echo "<table><tr><td>Borrando la relaci&oacute;n de permiso usuario modulo recien creada</td><td>";
if($salida>=0){

echo "<font color='green'>Borrada</font>";
}else {

	echo "<p align='right'><font color='red'>No Borrada</font></p>";
}
echo "</td></tr></table>";

$salida=$permiso_usuario_modulo->read(1);
echo "<table><tr><td>Comprobando una relaci&oacute;n de permiso usuario modulo existente</td><td>";
if($salida>=0 && $permiso_usuario_modulo->id_user==1){

echo "<font color='green'>Existe</font>";
}else {

	echo "<p align='right'><font color='red'>No Existe</font></p>";
}
echo "</td></tr></table>";

$permiso_usuario_modulo->id_user=27;
$salida=$permiso_usuario_modulo->modify();

echo "<table><tr><td>Modificando una relaci&oacute;n de permiso usuario modulo existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificada</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificada</font></p>";
}
echo "</td></tr></table>";

$permiso_usuario_modulo->id_user=1;
$salida=$permiso_usuario_modulo->modify();

echo "<table><tr><td>Volviendo a Modificar una relaci&oacute;n de permiso usuario modulo existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificada</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificada</font></p>";
}
echo "</td></tr></table>";

//declaramos un nuevo relacion de permisos grupo operacion
//echo "<p>antes de objeto</p>";
echo "<br><h3>Relaci&oacute;n Permisos Grupos operaciones</h3>";
$permiso_grupo_operacion=new per_group_methods();
//echo "<p>despues de objeto</p>";
//a–adimos sus variables
$permiso_grupo_operacion->id_group=2;
$permiso_grupo_operacion->id_method=2;
$permiso_grupo_operacion->per=2;
$salida=$permiso_grupo_operacion->add();
echo "<table><tr><td>A&ntilde;adiendo una relaci&oacute;n de permiso grupo operacion</td><td>";
if($salida>=0){

echo "<font color='green'>A&ntilde;adida</font>";
}else {

	echo "<p align='right'><font color='red'>No A&ntilde;adida</font></p>";
}
echo "</td></tr></table>";

$salida=$permiso_grupo_operacion->remove($permiso_grupo_operacion->id_per_group_method);
echo "<table><tr><td>Borrando la relaci&oacute;n de permiso grupo operacion recien creada</td><td>";
if($salida>=0){

echo "<font color='green'>Borrada</font>";
}else {

	echo "<p align='right'><font color='red'>No Borrada</font></p>";
}
echo "</td></tr></table>";

$salida=$permiso_grupo_operacion->read(1);
echo "<table><tr><td>Comprobando una relaci&oacute;n de permiso grupo operacion existente</td><td>";
if($salida>=0 && $permiso_grupo_operacion->id_group==1){

echo "<font color='green'>Existe</font>";
}else {

	echo "<p align='right'><font color='red'>No Existe</font></p>";
}
echo "</td></tr></table>";

$permiso_grupo_operacion->id_group=27;
$salida=$permiso_grupo_operacion->modify();

echo "<table><tr><td>Modificando una relaci&oacute;n de permiso grupo operacion existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificada</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificada</font></p>";
}
echo "</td></tr></table>";

$permiso_grupo_operacion->id_group=1;
$salida=$permiso_grupo_operacion->modify();

echo "<table><tr><td>Volviendo a Modificar una relaci&oacute;n de permiso grupo operacion existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificada</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificada</font></p>";
}
echo "</td></tr></table>";

//declaramos un nuevo relacion de permisos grupo operacion
//echo "<p>antes de objeto</p>";
echo "<br><h3>Relaci&oacute;n Permisos Usuarios operaciones</h3>";
$permiso_usuario_operacion= new per_user_methods();
//echo "<p>despues de objeto</p>";
//a–adimos sus variables
$permiso_usuario_operacion->id_user=2;
$permiso_usuario_operacion->id_method=2;
$permiso_usuario_operacion->per=2;
$salida=$permiso_usuario_operacion->add();
echo "<table><tr><td>A&ntilde;adiendo una relaci&oacute;n de permiso usuario operacion</td><td>";
if($salida>=0){

echo "<font color='green'>A&ntilde;adida</font>";
}else {

	echo "<p align='right'><font color='red'>No A&ntilde;adida</font></p>";
}
echo "</td></tr></table>";

$salida=$permiso_usuario_operacion->remove($permiso_usuario_operacion->id_per_user_method);
echo "<table><tr><td>Borrando la relaci&oacute;n de permiso usuario operacion recien creada</td><td>";
if($salida>=0){

echo "<font color='green'>Borrada</font>";
}else {

	echo "<p align='right'><font color='red'>No Borrada</font></p>";
}
echo "</td></tr></table>";

$salida=$permiso_usuario_operacion->read(1);
echo "<table><tr><td>Comprobando una relaci&oacute;n de permiso usuario operacion existente</td><td>";
if($salida>=0 && $permiso_usuario_operacion->id_user==1){

echo "<font color='green'>Existe</font>";
}else {

	echo "<p align='right'><font color='red'>No Existe</font></p>";
}
echo "</td></tr></table>";

$permiso_usuario_operacion->id_user=27;
$salida=$permiso_usuario_operacion->modify();

echo "<table><tr><td>Modificando una relaci&oacute;n de permiso usuario operacion existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificada</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificada</font></p>";
}
echo "</td></tr></table>";

$permiso_usuario_operacion->id_user=1;
$salida=$permiso_usuario_operacion->modify();

echo "<table><tr><td>Volviendo a Modificar una relaci&oacute;n de permiso usuario operacion existente</td><td>";
if($salida>=0){

echo "<font color='green'>Modificada</font>";
}else {

	echo "<p align='right'><font color='red'>No Modificada</font></p>";
}
echo "</td></tr></table>";
?>