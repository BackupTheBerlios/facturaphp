<td valign="top">
{literal}
<script>

	function comienza_por(){
		
	}
	
</script>
{/literal}
<form method="post" action="index.php?module=products&method=add" name="form_central" enctype="multipart/form-data">
	  	<table align="center" width="100%">
		<tr>
		<td valign="top">
			<table width="100%" cellpadding="0" cellspacing="0"  bgcolor="#000000">
						<tr Class="CabeceraModulo">
						<td width="7%">
						 <img src="pics/usuariosico.png" width="32" height="32">
						</td>
						<td width="93%" valign="middle"  nowrap>A&ntilde;adir Producto</td>
			  </tr>
		  </table>
						<br>
		<table width="250px" align="center">

					<tr>
					  <td colspan="2" class="cabeceraCampoFormulario">Datos del producto:</td>
				  </tr>
					
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre:</td>
						<td> <input type="text" id="{$objeto->ddbb_name}" name="{$objeto->ddbb_name}" class="textoMenu"></td>
					</tr>
				  <tr>
						<td width="125px" align="right" class="CampoFormulario">Nombre Web:</td>
						<td> <input type="text" id="{$objeto->ddbb_name_web}" name="{$objeto->ddbb_name_web}" class="textoMenu"></td>
					</tr>
					
					<tr>
				 	<td width="125px" class="CampoFormulario" >Imagen:</td>
					<td><input type="file" class="textoMenu" name="{$objeto->ddbb_path_photo}"></input></td>	
				</tr>		
				<tr>
					<td width="125px" align="right" class="CampoFormulario">P.V.P.:</td>
					<td> <input type="text" id="{$objeto->ddbb_pvp}" name="{$objeto->ddbb_pvp}" class="textoMenu"></td>
				</tr>
				<tr>
					<td width="125px" align="right" class="CampoFormulario">Impuestos:</td>
					<td> <input type="text" id="{$objeto->ddbb_tax}" name="{$objeto->ddbb_tax}" class="textoMenu"></td>
				</tr>
				<tr>
					<td width="125px" align="right" class="CampoFormulario">PVP-TAX:</td>
					<td> <input type="text" id="{$objeto->ddbb_pvp_tax}" name="{$objeto->ddbb_pvp_tax}" class="textoMenu"></td>
				</tr>
				<tr>
					<td width="125px" align="right" class="CampoFormulario">Stock M&iacute;nimo:</td>
					<td> <input type="text" id="{$objeto->ddbb_minimun_stock}" name="{$objeto->ddbb_minimun_stock}" class="textoMenu"></td>
				</tr>
		</table>
		</td>
		</tr>	
		<tr>
		<td>
		<br>
		<table width="250px" align="center">

					<tr>
					  <td class="cabeceraCampoFormulario" align="center">Categor&iacute;as:</td>
				  </tr>
		</table><br>
		
		<table align="center"><tr><td>
		
		<table width="100%" align="center">

					<tr class="cabeceraMultilinea">
					  <td>&nbsp;</td>
				  </tr>
		</table><br>
		{$tabla_checkbox}
		<br>
		<table width="100%" align="center">

					<tr class="cabeceraMultilinea">
					  <td>&nbsp;</td>
				  </tr>
		</table>
		</td></tr></table>
		</td>
		</tr>
		<tr>
			<td align="center"><br><br>
			<input type="submit" name="submit_add" id="submit_add" value="A&ntilde;adir" class="botones">			
			<input type="reset" Value="Limpiar Datos" class="botones">
			</td>
		</tr>
	  	</table>
	</form>
</td>