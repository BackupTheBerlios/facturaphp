<?php /* Smarty version 2.6.1, created on 2004-09-03 11:59:08
         compiled from bl_login.tpl */ ?>
<div style="background-color: #feeab1; color: #106010; width: 140px;"align="left">
	<h1 style="background-color: #106010; color:#fdcf51; font-weight: bold; text-align: left; font-size: 13px;">Entrada al sistema</h1>
 <form action="index.php?actor=usuarios&accion=login" method="POST" enctype="application/x-www-form-urlencoded" name="login">
		Usuario:&nbsp;<input type="text" name="uname" value="Mi usuario" size="10" maxlength="10"<br
		<br>
  Clave:&nbsp;<input type="password" name="clave" value="MiPass" size="10" maxlength="8" <br
		<br>
		<center><input type="submit" name="submit" value=" Enviar "></center>
 </form>
	<p>&nbsp;<span style="font-size:15px;font-weight: bold;">E</span>l registro en este servicio es completamente gratu&iacute;to. Si desea registrarse pulse con el rat&oacute; en este <a onMouseOver="enlaceEntra(this);" onMouseOut="enlaceSale(this);" style="color: #106010; font-size:11px; text-decoration: none; margin: 2px;" link href="index.php?actor=usuarios&accion=registro">enlace</a></p>
</div>