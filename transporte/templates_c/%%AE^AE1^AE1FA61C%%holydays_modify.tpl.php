<?php /* Smarty version 2.6.3, created on 2004-12-14 17:35:17
         compiled from holydays_modify.tpl */ ?>
<td valign="top">
<?php echo '
<script>
	function setToCero(cad){
		alert(cad);
		alert(document.getElementById(cad).value);
		document.getElementById(cad).value="0000-00-00";
		alert(document.getElementById(cad).value);
		document.getElementById(cad+"Changed").value="00-00-0000";
	}
</script>
'; ?>

<script src="inc/calendar.js" type="text/javascript" language="javascript"></script>
<form method="post" action="index.php?module=holydays&method=modify&id=<?php echo $this->_tpl_vars['objeto']->id_holy; ?>
" name="form_central">
	  	<table align="center" width="100%">
		<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						 <img src="pics/usuariosico.png" width="32" height="32">
						</td>
						<td width="93%" valign="middle"  nowrap>A&ntilde;adir Baja/Alta</td>
			  </tr>
		  </table>
						<br>
		<table width="250px" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos de la baja del empleado <?php echo $this->_tpl_vars['empleado']->name; ?>
&nbsp;<?php echo $this->_tpl_vars['empleado']->last_name; ?>
&nbsp;<?php echo $this->_tpl_vars['empleado']->last_name2; ?>
:</td>
					  <input type="hidden" value="<?php echo $this->_tpl_vars['empleado']->id_emp; ?>
" name="<?php echo $this->_tpl_vars['empleado']->ddbb_id_emp; ?>
">
				  </tr>
					
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Baja:</td>
						<td> <input class="textoMenu" type="text" name="goneChanged" value="<?php echo $this->_tpl_vars['gonecambiado']; ?>
" "size="15" maxlength="99" class="textfield"  id="goneChanged" readonly>
				 <input class="textoMenu" type="hidden" name="<?php echo $this->_tpl_vars['objeto']->ddbb_gone; ?>
" value="<?php echo $this->_tpl_vars['objeto']->gone; ?>
" size="15" maxlength="99" class="textfield"  id="<?php echo $this->_tpl_vars['objeto']->ddbb_gone; ?>
">
                                    <script type="text/javascript">
                                    
                    <!--
                    document.write('<a title="Calendario" href="javascript:openCalendar(\'lang=es-utf-8&amp;server=1\', \'form_central\', \'<?php echo $this->_tpl_vars['objeto']->ddbb_gone; ?>
\', \'goneChanged\', \'date\')"><img class="calendar" valign="center" src="pics/calendar.png" alt="Calendario"/></a>');
                    //-->
                    </script>
                    <input type="button" value="Poner a 0" class="botones" onclick="setToCero('gone');">
                    </td>
					</tr>
					<tr>
						<td width="125px" align="right" class="CampoFormulario">Alta:</td>
						<td> <input class="textoMenu" type="text" name="comeChanged" value="<?php echo $this->_tpl_vars['comecambiado']; ?>
" "size="15" maxlength="99" class="textfield"  id="comeChanged" readonly>
				 <input class="textoMenu" type="hidden" name="<?php echo $this->_tpl_vars['objeto']->ddbb_come; ?>
" value="<?php echo $this->_tpl_vars['objeto']->ddbb_come; ?>
" size="15" maxlength="99" class="textfield"  id="<?php echo $this->_tpl_vars['objeto']->ddbb_come; ?>
">
                                    <script type="text/javascript">
                                    
                    <!--
                    document.write('<a title="Calendario" href="javascript:openCalendar(\'lang=es-utf-8&amp;server=1\', \'form_central\', \'<?php echo $this->_tpl_vars['objeto']->ddbb_come; ?>
\', \'comeChanged\', \'date\')"><img class="calendar" valign="center" src="pics/calendar.png" alt="Calendario"/></a>');
                    //-->
                    </script>                    <input type="button" value="Poner a 0" class="botones" onclick="setToCero('come');">
                    </td>
					</tr>
					 <tr>
					
						<td width="125px" align="right" class="CampoFormulario">Motivo:</td>
						<td> <select name="<?php echo $this->_tpl_vars['objeto']->ddbb_ill; ?>
" class="textomenu">
						 <option value="0" <?php if ($this->_tpl_vars['objeto']->ill == 0): ?>selected<?php endif; ?>>Enfermedad</option>
						 <option value="1" <?php if ($this->_tpl_vars['objeto']->ill == 1): ?>selected<?php endif; ?>>Vacaciones</option>
						 <option value="2" <?php if ($this->_tpl_vars['objeto']->ill == 2): ?>selected<?php endif; ?>>Otros</option>
						 </select></td>
					</tr>					
					
					  <tr>
						<td width="125" align="right" class="CampoFormulario">Descripci&oacute;n:</td>
						<td rowspan="2" ><textarea name="<?php echo $this->_tpl_vars['objeto']->ddbb_descrip; ?>
" class="textoMenu" id="<?php echo $this->_tpl_vars['objeto']->ddbb_descrip; ?>
"><?php echo $this->_tpl_vars['objeto']->descrip; ?>
</textarea> </td>
					</tr>				  
		</table>
		</td>
		</tr>	

		<tr>
			<td align="center"><br><br>
			<input type="submit" name="submit_modify" value="Modificar" class="botones">			
			<input type="reset" Value="Limpiar Datos" class="botones">
			</td>
		</tr>
	  	</table>
	</form>
</td>