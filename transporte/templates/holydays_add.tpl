<td valign="top">
<form method="post" action="index.php?module=holydays&method=add" name="form_central">
	  	<table align="center" width="100%">
		<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						 <img src="pics/usuariosico.png" width="32" height="32">
						</td>
						<td width="93%" valign="middle"  nowrap>A&ntilde;adir Baja</td>
			  </tr>
		  </table>
						<br>
		<table width="250px" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos de la baja del empleado {$empleado}:</td>
					  <input type="hidden" value="{$empleado->id_emp}" name="{$empleado->ddbb_id_emp}">
				  </tr>
					
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Baja:</td>
						<td> <input class="textoMenu" type="text" name="goneChanged" value="00-00-0000" "size="15" maxlength="99" class="textfield"  id="goneChanged" readonly>
				 <input class="textoMenu" type="hidden" name="{$objeto->ddbb_gone}" value="0000-00-00" size="15" maxlength="99" class="textfield"  id="{$objeto->ddbb_gone}">
                                    <script type="text/javascript">
                                    
                    <!--
                    document.write('<a title="Calendario" href="javascript:openCalendar(\'lang=es-utf-8&amp;server=1\', \'form_central\', \'{$objeto->ddbb_gone}\', \'goneChanged\', \'date\')"><img class="calendar" valign="center" src="pics/calendar.png" alt="Calendario"/></a>');
                    //-->
                    </script></td>
					</tr>
					
					 <tr>
					 <input type="hidden" name="{$objeto->ddbb_come}" value="0000-00-00">
						<td width="125px" align="right" class="CampoFormulario">Motivo:</td>
						<td> <select name="{$objeto->ddbb_ill}" class="textomenu">
						 <option value="0">Enfermedad</option>
						 <option value="1">Vacaciones</option>
						 <option value="2" selected>Otros</option>
						 </select></td>
					</tr>
					 <tr>
						<td width="125px" align="right" class="CampoFormulario">CIF/NIF:</td>
						<td> <input type="text" id="{$objeto->ddbb_cif_nif}" name="{$objeto->ddbb_cif_nif}" class="textoMenu"></td>
					</tr>
					
					  <tr>
						<td width="125" align="right" class="CampoFormulario">Descripci&oacute;n:</td>
						<td rowspan="2" ><textarea name="{$objeto->ddbb_descrip}" class="textoMenu" id="{$objeto->ddbb_descrip}"></textarea> </td>
					</tr>				  
		</table>
		</td>
		</tr>	

		<tr>
			<td align="center"><br><br>
			<input type="submit" name="submit_add" id =" name="submit_add" "value="A&ntilde;adir" class="botones">			
			<input type="reset" Value="Limpiar Datos" class="botones">
			</td>
		</tr>
	  	</table>
	</form>
</td>