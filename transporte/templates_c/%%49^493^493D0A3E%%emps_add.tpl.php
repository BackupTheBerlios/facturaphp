<?php /* Smarty version 2.6.3, created on 2005-02-14 19:32:37
         compiled from emps_add.tpl */ ?>
<td valign="top">
<script>
<?php echo '
function enableDisable(value){
	if (value==\'exist\')
		action=true;
	else
		action=false;
	//Deshabilitamos/Habilitamos la lista desplegable
	document.getElementById("existUser").disabled = !(action);
	//Deshabilitamos/Habilitamos los campos de texto de usuarios
	document.getElementById("user_login").disabled = action;
	document.getElementById("user_passwd").disabled = action;
	document.getElementById("user_name").disabled = action;
	document.getElementById("user_last_name").disabled = action;
	document.getElementById("user_last_name2").disabled = action;
	//Deshabilitamos/Habilitamos los botones de las checkbox
	document.getElementById("selectAll").disabled = action;
	document.getElementById("unselectAll").disabled = action;
	
	for (var i=0;i<document.forms["form_central"].elements.length;i++){
			if(document.forms["form_central"].elements[i].type=="checkbox"){
				document.forms["form_central"].elements[i].disabled=action;
				}
		}
}


function hola(){
	alert(document.getElementById("birthday").value);
}

'; ?>

</script>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "checkbox.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<form method="post" action="index.php?module=emps&method=add" name="form_central">
<script src="inc/calendar.js" type="text/javascript" language="javascript"></script>
	 <table align="center" width="100%">
	<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						<img src="pics/clientesico.png" width="32" height="32">
						 <!--<img src="pics/usuariosico.png" width="32" height="32">-->
						</td>
						<td width="93%" valign="middle"  nowrap>A&ntilde;adir empleado</td>
				</tr>
			  </table>
						<br>
	<table align="center" width="90%"><tr><td width ="40%"valign="top">
	<tr>
					  <td  colspan="2" class="cabeceraCampoFormulario">Datos del empleado:</td>
		  </tr>
		<tr><td valign="top">
<!--		<input type="hidden" name="id_emps">
		<input type="hidden" name="id_corp">
		<input type="hidden" name="id_user">-->
		
			
		  
		<table width="250px" align="center" >

					 
				  <tr>
						<td width="125" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_name; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_name; ?>
" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125" class="CampoFormulario" >Primer apellido: </td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_last_name; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_last_name; ?>
" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Segundo apellido:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_last_name2; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_last_name2; ?>
" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125" class="CampoFormulario" nowrap>Fecha de nacimiento:</td>
						<td > <!--<input type="text" id="birthday"  name="fields[multi_edit][0][up]" class="textoMenu">-->						
				 <input class="textoMenu" type="text" name="dateChanged" value="00-00-0000" "size="15" maxlength="99" class="textfield" onchange="alert(this.value)" id="dateChanged" readonly>
				 <input class="textoMenu" type="hidden" name="<?php echo $this->_tpl_vars['objeto']->ddbb_birthday; ?>
" value="0000-00-00" size="15" maxlength="99" class="textfield" onchange="alert(this.value)" id="<?php echo $this->_tpl_vars['objeto']->ddbb_birthday; ?>
">
                                    <script type="text/javascript">
                                    
                    <!--
                    document.write('<a title="Calendario" href="javascript:openCalendar(\'lang=es-utf-8&amp;server=1\', \'form_central\', \'<?php echo $this->_tpl_vars['objeto']->ddbb_birthday; ?>
\', \'dateChanged\', \'date\')"><img class="calendar" valign="center" src="pics/calendar.png" alt="Calendario"/></a>');
                    //-->
                    </script>
		    
						
						</td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Direcci&oacute;n:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_address; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_address; ?>
" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">C&oacute;digo postal:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_postal_code; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_postal_code; ?>
" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Localidad:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_city; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_city; ?>
" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Provincia:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_state; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_state; ?>
" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Pa&iacute;s:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_country; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_country; ?>
" class="textoMenu"></td>
				 </tr>
				 
				</table>
			
			</td>
			<td width ="60%" valign="top">
			
			<table width="250px" align="center">
			<tr><td cospan="2" class="cabeceraCampoFormulario"></td></tr>
			 <tr>
						<td width="125" class="CampoFormulario">Tel&eacute;fono:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_phone; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_phone; ?>
" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Tel&eacute;fono m&oacute;vil:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_mobile_phone; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_mobile_phone; ?>
" class="textoMenu"></td>
				 </tr>
				<tr>
						<td width="125" class="CampoFormulario">Fax:</td>
						<td > <input type="text" id="<?php echo $this->_tpl_vars['objeto']->ddbb_fax; ?>
" name="<?php echo $this->_tpl_vars['objeto']->ddbb_fax; ?>
" class="textoMenu"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">E-mail:</td>
						<td > <input name="<?php echo $this->_tpl_vars['objeto']->ddbb_mail; ?>
" type="text" class="textoMenu" id="<?php echo $this->_tpl_vars['objeto']->ddbb_mail; ?>
"></td>
				 </tr>
				  <tr>
						<td width="125" class="CampoFormulario">Categoria:</td>
						<td><select name="category">
						<?php unset($this->_sections['indice']);
$this->_sections['indice']['name'] = 'indice';
$this->_sections['indice']['loop'] = is_array($_loop=$this->_tpl_vars['categorias']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['indice']['show'] = true;
$this->_sections['indice']['max'] = $this->_sections['indice']['loop'];
$this->_sections['indice']['step'] = 1;
$this->_sections['indice']['start'] = $this->_sections['indice']['step'] > 0 ? 0 : $this->_sections['indice']['loop']-1;
if ($this->_sections['indice']['show']) {
    $this->_sections['indice']['total'] = $this->_sections['indice']['loop'];
    if ($this->_sections['indice']['total'] == 0)
        $this->_sections['indice']['show'] = false;
} else
    $this->_sections['indice']['total'] = 0;
if ($this->_sections['indice']['show']):

            for ($this->_sections['indice']['index'] = $this->_sections['indice']['start'], $this->_sections['indice']['iteration'] = 1;
                 $this->_sections['indice']['iteration'] <= $this->_sections['indice']['total'];
                 $this->_sections['indice']['index'] += $this->_sections['indice']['step'], $this->_sections['indice']['iteration']++):
$this->_sections['indice']['rownum'] = $this->_sections['indice']['iteration'];
$this->_sections['indice']['index_prev'] = $this->_sections['indice']['index'] - $this->_sections['indice']['step'];
$this->_sections['indice']['index_next'] = $this->_sections['indice']['index'] + $this->_sections['indice']['step'];
$this->_sections['indice']['first']      = ($this->_sections['indice']['iteration'] == 1);
$this->_sections['indice']['last']       = ($this->_sections['indice']['iteration'] == $this->_sections['indice']['total']);
?>
						  <option value="<?php echo $this->_tpl_vars['categorias'][$this->_sections['indice']['index']]['id_cat_emp']; ?>
"><?php echo $this->_tpl_vars['categorias'][$this->_sections['indice']['index']]['name']; ?>
</option>						 
						  <?php endfor; endif; ?>
						</select></td>
				 </tr>
				 <tr>
						<td width="125" class="CampoFormulario" nowrap>Fecha de alta:</td>
						<td > <!--<input type="text" id="come"  name="fields[multi_edit][0][up]" class="textoMenu">-->						
				<input type="hidden" name="<?php echo $this->_tpl_vars['holyday']->ddbb_ill; ?>
" id="<?php echo $this->_tpl_vars['holyday']->ddbb_ill; ?>
" value="2">
				 <input class="textoMenu" type="text" name="comeChanged" value="00-00-0000" "size="15" maxlength="99" class="textfield" id="comeChanged" readonly>
				 <input class="textoMenu" type="hidden" name="<?php echo $this->_tpl_vars['holyday']->ddbb_come; ?>
" id="<?php echo $this->_tpl_vars['holyday']->ddbb_come; ?>
" value="0000-00-00" size="15" maxlength="99" class="textfield" id="<?php echo $this->_tpl_vars['holyday']->ddbb_come; ?>
"><!--<?php echo $this->_tpl_vars['holiday']->ddbb_come; ?>
-->
                                    <script type="text/javascript">
                                    
                    <!--
                    document.write('<a title="Calendario" href="javascript:openCalendar(\'lang=es-utf-8&amp;server=1\', \'form_central\', \'<?php echo $this->_tpl_vars['holyday']->ddbb_come; ?>
\', \'comeChanged\', \'date\')"><img class="calendar" valign="center" src="pics/calendar.png" alt="Calendario"/></a>');
                    //-->
                    </script>
		    
						
						</td>
				 </tr>
			</table>
			<br>
			<table  width="250px" align="center">
			<tr class="textoMenu" align="center"><td>
				<input type="radio" checked name="user" id="user_exist" value="exist" onChange="enableDisable(this.value)"> Escoger un usuario existente
			</td></tr>
			<tr class="class="textoMenu" align="center"><td><select name="existUser" id="existUser">
						<?php unset($this->_sections['indice']);
$this->_sections['indice']['name'] = 'indice';
$this->_sections['indice']['loop'] = is_array($_loop=$this->_tpl_vars['listado_usuarios']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['indice']['show'] = true;
$this->_sections['indice']['max'] = $this->_sections['indice']['loop'];
$this->_sections['indice']['step'] = 1;
$this->_sections['indice']['start'] = $this->_sections['indice']['step'] > 0 ? 0 : $this->_sections['indice']['loop']-1;
if ($this->_sections['indice']['show']) {
    $this->_sections['indice']['total'] = $this->_sections['indice']['loop'];
    if ($this->_sections['indice']['total'] == 0)
        $this->_sections['indice']['show'] = false;
} else
    $this->_sections['indice']['total'] = 0;
if ($this->_sections['indice']['show']):

            for ($this->_sections['indice']['index'] = $this->_sections['indice']['start'], $this->_sections['indice']['iteration'] = 1;
                 $this->_sections['indice']['iteration'] <= $this->_sections['indice']['total'];
                 $this->_sections['indice']['index'] += $this->_sections['indice']['step'], $this->_sections['indice']['iteration']++):
$this->_sections['indice']['rownum'] = $this->_sections['indice']['iteration'];
$this->_sections['indice']['index_prev'] = $this->_sections['indice']['index'] - $this->_sections['indice']['step'];
$this->_sections['indice']['index_next'] = $this->_sections['indice']['index'] + $this->_sections['indice']['step'];
$this->_sections['indice']['first']      = ($this->_sections['indice']['iteration'] == 1);
$this->_sections['indice']['last']       = ($this->_sections['indice']['iteration'] == $this->_sections['indice']['total']);
?>
						  <option value="<?php echo $this->_tpl_vars['listado_usuarios'][$this->_sections['indice']['index']]['id_user']; ?>
"><?php echo $this->_tpl_vars['listado_usuarios'][$this->_sections['indice']['index']]['login']; ?>
 :: <?php echo $this->_tpl_vars['listado_usuarios'][$this->_sections['indice']['index']]['name']; ?>
 <?php echo $this->_tpl_vars['listado_usuarios'][$this->_sections['indice']['index']]['last_name']; ?>
 <?php echo $this->_tpl_vars['listado_usuarios'][$this->_sections['indice']['index']]['last_name2']; ?>
</option>
					  <?php endfor; endif; ?>
						</select></td>
			</tr>
			<tr class="textoMenu" align="center"><td>
				<input type="radio" name="user" id="new_user" value="new" onChange="enableDisable(this.value)"> Crear un nuevo usuario
			</td></tr>
			</table>
			</td>
</tr>	
		<tr>
		<td colspan="2">
		
		
		<br>
		<table width="100%" align="center" border="0"><tr><td>
		<table width="50%" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos de Login:</td>
				  </tr>
					<tr>
						<td width="125px" align="right" class="CampoFormulario" nowrap>Login:</td>
						<td > <input type="text" id="user_login" name="user_<?php echo $this->_tpl_vars['usuarios']->ddbb_login; ?>
" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario">Password:</td>
						<td > <input type="password" id="user_passwd" name="user_<?php echo $this->_tpl_vars['usuarios']->ddbb_passwd; ?>
" class="textoMenu"></td>
				  </tr>
				  <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del Usuario:</td>
				  </tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="user_name" name="user_<?php echo $this->_tpl_vars['usuarios']->ddbb_name; ?>
" class="textoMenu"></td>
					</tr>
					<tr>
						<td width="125px" class="CampoFormulario" >Primer Apellido:</td>
						<td > <input type="text" id="user_last_name" name="user_<?php echo $this->_tpl_vars['usuarios']->ddbb_last_name; ?>
" class="textoMenu"></td>
				  </tr>
				  <tr>
						<td width="125px" class="CampoFormulario">Segundo Apellido:</td>
						<td > <input type="text" id="user_last_name2" name="user_<?php echo $this->_tpl_vars['usuarios']->ddbb_last_name2; ?>
" class="textoMenu"></td>
				  </tr>
				   <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Permisos: </td>
				  </tr>
				  <tr>
				  	<td colspan="2">
				  		<input type="button" Value="Seleccionar Todos" id="selectAll" class="botones" onClick="selectAll();">
					<input type="button" Value="Deseleccionar Todos" id="unselectAll" class="botones" onClick="unselectAll();">
				  	</td>
				  </tr>			
		</table>
		</td><td>
		<table width="100%" align="center" border="0">
			 <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Grupos: </td>
			</tr>
			<tr class="cabeceraMultiLinea">
				<td width="100%" colspan="2">Grupos</td>				
			</tr>
			
			<?php 
				$linea = 0;
			 ?>
			<?php unset($this->_sections['indice']);
$this->_sections['indice']['name'] = 'indice';
$this->_sections['indice']['loop'] = is_array($_loop=$this->_tpl_vars['grupos']) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['indice']['show'] = true;
$this->_sections['indice']['max'] = $this->_sections['indice']['loop'];
$this->_sections['indice']['step'] = 1;
$this->_sections['indice']['start'] = $this->_sections['indice']['step'] > 0 ? 0 : $this->_sections['indice']['loop']-1;
if ($this->_sections['indice']['show']) {
    $this->_sections['indice']['total'] = $this->_sections['indice']['loop'];
    if ($this->_sections['indice']['total'] == 0)
        $this->_sections['indice']['show'] = false;
} else
    $this->_sections['indice']['total'] = 0;
if ($this->_sections['indice']['show']):

            for ($this->_sections['indice']['index'] = $this->_sections['indice']['start'], $this->_sections['indice']['iteration'] = 1;
                 $this->_sections['indice']['iteration'] <= $this->_sections['indice']['total'];
                 $this->_sections['indice']['index'] += $this->_sections['indice']['step'], $this->_sections['indice']['iteration']++):
$this->_sections['indice']['rownum'] = $this->_sections['indice']['iteration'];
$this->_sections['indice']['index_prev'] = $this->_sections['indice']['index'] - $this->_sections['indice']['step'];
$this->_sections['indice']['index_next'] = $this->_sections['indice']['index'] + $this->_sections['indice']['step'];
$this->_sections['indice']['first']      = ($this->_sections['indice']['iteration'] == 1);
$this->_sections['indice']['last']       = ($this->_sections['indice']['iteration'] == $this->_sections['indice']['total']);
?>
				<?php 
				if ($linea==0){
					$clase="multiLinea1";
					$linea=1;
				}				
				else{
					$clase="multiLinea2";	
					$linea=0;
				}				
				print('<tr class="'.$clase.'">');
				 ?>
				<td>
				<input type="checkbox" value="1" name="grupo_<?php echo $this->_tpl_vars['grupos'][$this->_sections['indice']['index']]->id_group; ?>
" <?php if ($this->_tpl_vars['grupos'][$this->_sections['indice']['index']]->belong == true): ?>checked<?php endif; ?>><?php echo $this->_tpl_vars['grupos'][$this->_sections['indice']['index']]->name_web; ?>

				<?php $this->_sections['indice']['index']+=1;
					$this->_sections['indice']['iteration']+=1; ?>
				
				</td>
				<?php if (! $this->_sections['indice']['last']): ?>
				<td>
				<input type="checkbox" value="1" name="grupo_<?php echo $this->_tpl_vars['grupos'][$this->_sections['indice']['index']]->id_group; ?>
" <?php if ($this->_tpl_vars['grupos'][$this->_sections['indice']['index']]->belong == true): ?>checked<?php endif; ?>><?php echo $this->_tpl_vars['grupos'][$this->_sections['indice']['index']]->name_web; ?>

				</td>
				<?php else: ?>
				<td>
				&nbsp;
				</td>
				<?php endif; ?>
				</tr>
			<?php endfor; endif; ?>
			<tr class="cabeceraMultilinea"><td colspan="2">&nbsp</td></tr>
			</table>
		</td></tr></table>
			<br>
			<br>    
			
			<table width="90%" align="center" border="0">
			 <tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Permisos por modulos-metodos: </td>
			</tr>
			<tr class="cabeceraMultiLinea">
				<td width="30%">Nombre de Modulo</td>
				<td Colspan="4" width="70%">Metodos</td>
			</tr>
			
			<?php 
				$linea = 0;
			 ?>
			<?php unset($this->_sections['indice']);
$this->_sections['indice']['name'] = 'indice';
$this->_sections['indice']['loop'] = is_array($_loop=$this->_tpl_vars['modulos']->per_modules) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['indice']['show'] = true;
$this->_sections['indice']['max'] = $this->_sections['indice']['loop'];
$this->_sections['indice']['step'] = 1;
$this->_sections['indice']['start'] = $this->_sections['indice']['step'] > 0 ? 0 : $this->_sections['indice']['loop']-1;
if ($this->_sections['indice']['show']) {
    $this->_sections['indice']['total'] = $this->_sections['indice']['loop'];
    if ($this->_sections['indice']['total'] == 0)
        $this->_sections['indice']['show'] = false;
} else
    $this->_sections['indice']['total'] = 0;
if ($this->_sections['indice']['show']):

            for ($this->_sections['indice']['index'] = $this->_sections['indice']['start'], $this->_sections['indice']['iteration'] = 1;
                 $this->_sections['indice']['iteration'] <= $this->_sections['indice']['total'];
                 $this->_sections['indice']['index'] += $this->_sections['indice']['step'], $this->_sections['indice']['iteration']++):
$this->_sections['indice']['rownum'] = $this->_sections['indice']['iteration'];
$this->_sections['indice']['index_prev'] = $this->_sections['indice']['index'] - $this->_sections['indice']['step'];
$this->_sections['indice']['index_next'] = $this->_sections['indice']['index'] + $this->_sections['indice']['step'];
$this->_sections['indice']['first']      = ($this->_sections['indice']['iteration'] == 1);
$this->_sections['indice']['last']       = ($this->_sections['indice']['iteration'] == $this->_sections['indice']['total']);
?>
				<?php 
				if ($linea==0){
					$clase="multiLinea1";
					$linea=1;
				}				
				else{
					$clase="multiLinea2";	
					$linea=0;
				}				
				print('<tr class="'.$clase.'">');
				 ?>

				<?php if ($this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->per == 1): ?>
					<td nowrap><input type="checkbox" name="modulo_<?php echo $this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->id_module; ?>
" value="1" onClick="selectRow()" checked> <?php echo $this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->module_name; ?>
</td> 
				<?php else: ?>
					<td nowrap><input type="checkbox" name="modulo_<?php echo $this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->id_module; ?>
" value="1" onClick="selectRow()"> <?php echo $this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->module_name; ?>
</td> 				
				<?php endif; ?>
				<td nowrap>						
					<table width="100%"><tr class="<?php print($clase); ?>">				
					 <?php unset($this->_sections['j']);
$this->_sections['j']['name'] = 'j';
$this->_sections['j']['loop'] = is_array($_loop=$this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->per_methods) ? count($_loop) : max(0, (int)$_loop); unset($_loop);
$this->_sections['j']['show'] = true;
$this->_sections['j']['max'] = $this->_sections['j']['loop'];
$this->_sections['j']['step'] = 1;
$this->_sections['j']['start'] = $this->_sections['j']['step'] > 0 ? 0 : $this->_sections['j']['loop']-1;
if ($this->_sections['j']['show']) {
    $this->_sections['j']['total'] = $this->_sections['j']['loop'];
    if ($this->_sections['j']['total'] == 0)
        $this->_sections['j']['show'] = false;
} else
    $this->_sections['j']['total'] = 0;
if ($this->_sections['j']['show']):

            for ($this->_sections['j']['index'] = $this->_sections['j']['start'], $this->_sections['j']['iteration'] = 1;
                 $this->_sections['j']['iteration'] <= $this->_sections['j']['total'];
                 $this->_sections['j']['index'] += $this->_sections['j']['step'], $this->_sections['j']['iteration']++):
$this->_sections['j']['rownum'] = $this->_sections['j']['iteration'];
$this->_sections['j']['index_prev'] = $this->_sections['j']['index'] - $this->_sections['j']['step'];
$this->_sections['j']['index_next'] = $this->_sections['j']['index'] + $this->_sections['j']['step'];
$this->_sections['j']['first']      = ($this->_sections['j']['iteration'] == 1);
$this->_sections['j']['last']       = ($this->_sections['j']['iteration'] == $this->_sections['j']['total']);
?>
						<?php if ($this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->per_methods[$this->_sections['j']['index']]->per == 1): ?>
							<td width="20%"><input type="checkbox" name="modulo_<?php echo $this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->id_module; ?>
_metodo_<?php echo $this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->per_methods[$this->_sections['j']['index']]->id_method; ?>
" value="1" checked><?php echo $this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->per_methods[$this->_sections['j']['index']]->method_name_web; ?>
</td>
						<?php else: ?>
							<td width="20%"><input type="checkbox" name="modulo_<?php echo $this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->id_module; ?>
_metodo_<?php echo $this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->per_methods[$this->_sections['j']['index']]->id_method; ?>
" value="1"><?php echo $this->_tpl_vars['modulos']->per_modules[$this->_sections['indice']['index']]->per_methods[$this->_sections['j']['index']]->method_name_web; ?>
</td>
						<?php endif; ?>
					<?php endfor; endif; ?>   
					</tr></table>
				</td>				
				</tr>				
			<?php endfor; endif; ?>
			<tr  class="cabeceraMultiLinea"><td colspan="2">&nbsp;</td></tr>
			</table>
		<script>enableDisable('exist');</script>
		</td>
		</tr>	
		
		

		
		






		</td>
		</tr>
		<tr>
			<td align="center" colspan="2"><br><br><input type="submit" name="submit_add" value="A&ntilde;adir" class="botones">
			<input type="reset" Value="Borrar Datos" class="botones">
			</td>
		</tr>
	  	</table> </td></tr></table>
		</form></td>