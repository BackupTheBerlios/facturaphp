<?php
//includes
echo "<p>antes de objeto</p>";
require_once('inc/users.class.php');
echo "<p>antes de objeto</p>";
$object=new users();
echo "despues de objeto";
?>