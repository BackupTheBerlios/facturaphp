// JavaScript Document

//Declaracion de variables globales
	var contactos = '<table align="center"><tr><td><a href="formularioAltaClientes.htm"><img src="pics/btnNuevo.gif" border="0"></a></td></tr></table><table align="center" width="80%"><tr class="cabeceraMultiLinea"><td width="40%">Nombre Completo</td><td width="20%">Tel&eacute;fono</td><td width="20%">Tel&eacute;fono M&oacute;vil</td><td width="20%" colspan="3">Acciones</td></tr><tr class="multiLinea1"><td>Miguel Sanchez Hernández</td><td>923123456</td><td>656669988</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="multiLinea2"><td>Antonio Gonz&aacute;lez Mart&iacute;n</td><td>923652854</td><td>654452589</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="multiLinea1"><td>Carlos Zamora Gutierrez</td><td>923236545</td><td>656632519</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="multiLinea2"><td>Vicente Benito Alc&aacute;ntara</td><td>923456875</td><td>654126545</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="cabeceraMultiLinea"><td colspan="6">&nbsp;</td></tr></table>';
	var facturas = '<table align="center"><tr><td><a href="formularioAltaClientes.htm"><img src="pics/btnNuevo.gif" border="0"></a></td></tr></table><table align="center" width="80%"><tr class="cabeceraMultiLinea"><td width="20%">N&ordm; de Factura</td><td width="40%">Asunto</td><td width="20%">Fecha</td><td width="20%" colspan="3">Acciones</td></tr><tr class="multiLinea1"><td>00024</td><td>Compra de Camión</td><td>24 / 04 / 2003</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>	</tr><tr class="multiLinea2"><td>00025</td><td>Compra de Neum&aacute;ticos </td><td>27 / 04 / 2003</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="multiLinea1"><td>00026</td><td>Compra de material de oficina </td><td>30 / 06 / 2003</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="multiLinea2"><td>00027</td><td> Compra de Camión</td><td>28 / 10 / 2003</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="cabeceraMultiLinea"><td colspan="6">&nbsp;</td></tr></table>';
	var partes = '<table align="center"><tr><td><a href="formularioAltaClientes.htm"><img src="pics/btnNuevo.gif" border="0"></a></td></tr></table><br>Listado de partes';
	var tarifas = '<table align="center"><tr><td><a href="formularioAltaClientes.htm"><img src="pics/btnNuevo.gif" border="0"></a></td></tr></table><table align="center" width="80%"><tr class="cabeceraMultiLinea">	<td width="20%">Tarifa</td><td width="40%">Cliente</td><td width="20%">Descuento</td><td width="20%" colspan="3">Acciones</td></tr><tr class="multiLinea1"><td>002</td><td>Migu&eacute;l S&aacute;nchez Hern&aacute;ndez </td><td>10%</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>	<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>		</tr><tr class="multiLinea2"><td>002</td><td>Joaqu&iacute;n Ledesma Alonso </td><td>10%</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>	</tr><tr class="multiLinea1"><td>005</td><td>Teresa Viejo Mart&iacute;n </td><td>5%</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>	<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="multiLinea2"><td>001</td><td> Estefan&iacute;a Gonz&aacute;lez Fraile </td><td>3%</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>			<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td>	</tr><tr class="cabeceraMultiLinea"><td colspan="6">&nbsp;</td></tr></table>';
	var i = 0;

	
//Funciones	
	
	function botones(obj,cadena){
		imgContactos = document.getElementById('Contactos');
		imgContactos.src = 'pics/pestagna-contactos.gif';
		imgFacturas = document.getElementById('Facturas');
		imgFacturas.src = 'pics/pestagna-facturas.gif';		
		imgPartes = document.getElementById('Partes');
		imgPartes.src = 'pics/pestagna-partes.gif';
		imgTarifas = document.getElementById('Tarifas');
		imgTarifas.src = 'pics/pestagna-tarifas.gif';
		obj.src = 'pics/pestagna-' + cadena + 'sobre.gif';
	}
	
	function Ocultar(obj,cad){		
		botones(obj, cad);
		 miDivMostrar = document.getElementById('divMostrar');
		 switch (cad){
			 case 'Contactos':
			 			miDivMostrar.innerHTML = contactos;
						break;
			 case 'Facturas':
			 			miDivMostrar.innerHTML = facturas;
						break;
			 case 'Partes':
			 			miDivMostrar.innerHTML = partes;
						break;
			 case 'Tarifas':
			 			miDivMostrar.innerHTML = tarifas;
						break;			 
		 }
		 
		
	}
	