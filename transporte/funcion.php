<?php
	/* Nombre y uso de las variables de la funcion make_table
	* $var_js ->es el nombre de el conjunto de variables de una pestaña en concreto.
	* $list_name-> nombre del listado que le hemos pasado a smarty
	* $cabecera -> Array; nombre que va a ir en la cabecera de la tabla
	* $nombre_campos-> Array; nombre de los campos del array
	* $num_rows -> Numero de registros por página.
	* $acc -> nombre de las acciones.	
	* $listado-> boolean, si es true sera un listaod, si es false, sera una vista.
	* $new ->boolean, indica si estara permitida o no el poner el boton 'nuevo';

	 EJEMPLO DE COMO DEBERIA QUEDAR
	* var contactos = '<table align="center" width="80%">
	* 	<tr><td>
	* 	<a href="formularioAltaClientes.htm"> <img src="pics/btnNuevo.gif" border="0"></a></td><td align="right" valign="center"><img src="pics/buscar.gif"><input type="text" class="textoMenu">
	* <input type="submit" class="botones" value="buscar"></td></tr></table>
	* 
	* 
	* <table align="center" width="80%">
	* <tr class="cabeceraMultiLinea"><td width="40%">Nombre Completo</td><td width="20%">Tel&eacute;fono</td><td width="20%">Tel&eacute;fono M&oacute;vil</td><td width="20%" colspan="3">Acciones</td></tr><tr class="multiLinea1"><td>Miguel Sanchez Hernández</td><td>923123456</td><td>656669988</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								<td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="multiLinea2"><td>Antonio Gonz&aacute;lez Mart&iacute;n</td><td>923652854</td><td>654452589</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="multiLinea1"><td>Carlos Zamora Gutierrez</td><td>923236545</td><td>656632519</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="multiLinea2"><td>Vicente Benito Alc&aacute;ntara</td><td>923456875</td><td>654126545</td><td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td><td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td><td><a href="#"><img src="pics/btnborrar.gif" border="0"></a></td></tr><tr class="cabeceraMultiLinea"><td colspan="6">&nbsp;</td></tr></table>';
	* 
	* 
	 LA FUNCION DEBE ESTAR HECHA PARA QUE LA VARIABLE QUE CONTENGA LA FUNCION LO HAGA MEDIANTE COMILLAS DOBLES.
	 HACER QUE SEA PARA LISTADO O VISTA INDEPENDIENTEMENTE.
	* 
	*/
	/* MODELO DE LISTADO
	* ******************* BOTON DE NUEVO.
	* <table align="center">
				  	<tr>
						<td><a href="formularioAltaClientes.htm"><img src="pics/btnNuevo.gif" border="0"></a></td>
					</tr>
				  </table>
					************************************** CONTENIDO DE LISTADO
				  <table align="center" width="80%">
				  	<tr>
						<td colspan="7" class="cabeceraCampoFormulario">Listado:</td>
					</tr>
							<tr class="cabeceraMultiLinea">
								<td width="20%">Cif/Nif
								</td>
								<td width="20%">Nombre</td>
								<td width="40%">NombreCompleto</td>
								<td width="20%" colspan="3">Acciones</td>
							</tr>
							<tr class="multiLinea1">
								<td>75612534D</td>
								<td>David</td>
								<td>David Vaquero Santiago </td>
								<td><a href="vistaClientes.htm"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="formularioclientes.htm"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnBorrar.gif" border="0" onClick="confirm('¿Desea borrar este registro?\nSi pulsa Sí se borrarán tambien los registros relacionados con este cliente (p.ej: datos de usuario)')"></a></td>		
							</tr>
							<tr class="multiLinea2">
								<td>84235126W</td>
								<td>Antonio</td>
								<td>Antonio Gonz&aacute;lez Mart&iacute;n</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnBorrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea1">
								<td>72316584G</td>
								<td>Carlos</td>
								<td>Carlos Zamora Gutierrez</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnBorrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea2">
								<td>76246316C</td>
								<td>Andr&eacute;s</td>
								<td>Andres Ledesma Moreno </td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnBorrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea1">
								<td>75612534D</td>
								<td>Miguel</td>
								<td>Miguel Sanchez Hernández</td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnBorrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea2">
								<td>84235126W</td>
								<td>Alejandro</td>
								<td>Alejandro L&oacute;pez Becerro </td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnBorrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea1">
								<td>72316584G</td>
								<td>Enrique</td>
								<td>Enrique G&oacute;mez Rodr&iacute;guez </td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnBorrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea2">
								<td>76246316C</td>
								<td>Cristina</td>
								<td>Cristina Loreto P&eacute;rez </td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnBorrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea1">
								<td>72316584G</td>
								<td>Carmen</td>
								<td>Carmen P&eacute;rez Blanco </td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnBorrar.gif" border="0"></a></td>		
							</tr>
							<tr class="multiLinea2">
								<td>76246316C</td>
								<td>Patricia</td>
								<td>Patricia Ingelmo Santos </td>
								<td><a href="#"><img src="pics/btnVer.gif" border="0"></a></td>
								<td><a href="#"><img src="pics/btnEditar.gif" border="0"></a></td>								
								<td><a href="#"><img src="pics/btnBorrar.gif" border="0"></a></td>		
							</tr>
							<tr class="cabeceraMultiLinea">
								<td colspan="6">&nbsp;</td>
							</tr>
						</table>	  
						* 
						* ********************** PAGINACION
						<table align="center">
						<tr><td colspan="3" class="cabeceraCampoFormulario">Ir a la página:</td></tr>
						<tr class="NumerosBuscar">
							<td><a href="#">Primera</a></td>
							<td><a href="#">1</a> <a href="#">2</a> <b>3</b> <a href="#">4</a> <a href="#">5</a></td>
							<td><a href="#">&Uacute;ltima</a></td>
						</tr>

						</table>
	*/
	class table{
	
		var $class_cabecera='cabeceraMultilinea';
		var $class_tr1='multiLinea1';
		var $class_tr2='multiLinea2';	
		var $default_num_rows=10;	
		var $comiezo_variable;
		var $final_variable='';			
		var $campo_id;// para las operaciones.
		var $listado;
		var $comienzo_tabla='<table align=\\"center\\" width=\\"80%\\">';
		var $final_tabla='</table>';
		var $nombres_variables;// aqui se iran poniendo los nombres de las variables para despues pasarselas a smarty y hacer la funcion javscript Ocultar()
		
		function table($list){
			$this->listado = $list;
			if (!$this->listado) {
				$this->final_variable='</td></tr></table>';
			}
			$this->final_variable=$this->final_variable.'";'."\r\n\t";
			return 1;
		}
		
		function make_tables($var_js,$list_name,$cabecera,$nombre_campos,$num_rows,$acc,$new){
			$cadena ='<script>'."\n\r\t";									
			$curr_pag=1;
			$registro=0;
			$num_cols=((count($cabecera)/2) + count($acc));	
			
			// 	 miramos el numero de filas que va a haber por página.
			if ($num_rows=='all') {
			    $num_pags=1;
				$num_regs=count($list_name);
			}
			elseif($num_rows==''){//por defecto.
				$num_rows=$this->default_num_rows;
				$num_regs=$this->default_num_rows;
				$num_pags=ceil(count($list_name)/$num_rows);
				
			}	
			else{$num_pags=ceil(count($list_name)/$num_rows);
				$num_regs=$num_rows;
			}
				
			// escribimos los nomebres de las variables para la funcion (Ocultar())	
			for($i=0;$i<=$num_pags -1;$i++){
				$this->nombres_variables[$i]=$var_js.'_'.($i + 1);
			}
			//Vamos rellenando página por página.
			echo $num_rows.'<br>';
			echo $num_pags.'<br>';
			echo $num_regs;
			while($curr_pag<=$num_pags){
				$variable='var '.$var_js.'_'.$curr_pag.'="';
				
				$curr_reg=1;
				$clase=1;
				// ENCABEZADOS
				//si es un listado no aparecera el desplegable ni la búsqueda.
				if ($this->listado && $new) {				
					     $variable=$variable.'<table align=\\"center\\"><tr><td><a href=\\"index.php?module='.$var_js.'method=add\\"><img border=\\"0\\"src=\\"pics/btnnew.gif\\"></a></td></tr><table>';				
				 }
				elseif(!$this->listado){
					$variable=$variable.'<table width=\\"80%\\" align=\\"center\\"><tr><tdwidth=\\"20%\\">';
					//si puede o no ejecutar nuevo
					if (!$new) {
					    $variable=$variable.'&nbsp;</td>';
					}
					else{
						$variable=$variable.'<a href=\\"index.php?module='.$var_js.'method=add\\"><img border=\\"0\\"src=\\"pics/btnnew.gif\\"></a></td>';
					}
					//numero registros por pagina
					$variable=$variable.'<td width=\\"40%\\" align=\\"center\\" ><span class=\\"cabeceraCampoFormulario\\">Registros por p&aacute;gina:</span> <select><option>Todos</option><option>10</option><option>20</option></select></td>';
					// busqueda
					$variable=$variable.'<td width=\\"40%\\" align=\\"right\\"><form action=\\"index.php?module=&method=view&id=&search=\\"><input type=\\"submit\\" class=\\"botones\\" value=\\"Buscar\\"></form></td>';
					// fin
					$variable=$variable.'</tr></table>';
					//<table><tr><td>nuevo</td><td>numero de registros</td><td>busqueda</td></tr></table>
				}
				
				
				//creamos cabecera
				$i=0;
				$variable=$variable.$this->comienzo_tabla;
				$variable=$variable.'<tr><td colspan=\\"'.$num_cols.'\\" class=\\"cabeceraCampoFormulario\\">Listado</td></tr>';
				$variable=$variable.'<tr class=\\"'.$this->class_cabecera.'\\">';
				while($i<=count($cabecera)- 1){			
					$variable=$variable.'<td align=\\"center\\" WIDTH=\\"'.$cabecera[$i + 1].'%\\">';
					$variable=$variable.$cabecera[$i];	
					$variable=$variable.'</td>';	
					$i=$i+2;
				}
				if (count($acc)!=0) {
				    $variable=$variable.'<td align=\\"center\\" colspan=\\"'.count($acc).'\\">Acciones</td>';
				}
				//acciones
				
				$variable=$variable.'</tr>';
				//creamos filas con contenido.
				while(($curr_reg<=$num_regs)&&!($registro==count($list_name))){
					if ($clase==1) {//aplicamos el estilo
	  					$variable=$variable.'<tr class =\\"'.$this->class_tr1.'\\">';   
						$clase=0;
					 }
					else{
						$variable=$variable.'<tr class =\\"'.$this->class_tr2.'\\">';   
						$clase=1;
					}
					// CUERPO DE TABLA
					$col=0;
					while($col<=(count($cabecera)/2)-1){
						$variable=$variable.'<td>';
						$variable=$variable.$list_name[$registro][$nombre_campos[$col+1]];
						$variable=$variable.'</td>';
						$col++;
					} // while
					$col=0;
					while($col<=count($acc)-1){
						$variable=$variable.'<td align=\\"center\\">';
						$variable=$variable.'<A href=\\"index.php?module='.$var_js.'&method='.$acc[$col].'&id='.$list_name[$registro][$nombre_campos[0]].'\\"><img src=\\"pics/btn'.$acc[$col].'.gif\\" border=\\"0\\"></A>';//AÑADIR ENLACE
						$variable=$variable.'</td>';
						$col++;
					} // while
					// aqui pondremos las acciones;
					
					$variable=$variable.'</tr>';
					$registro++;
					$curr_reg++;	
				} // while							
				$variable=$variable.'<tr class=\\"'.$this->class_cabecera.'\\"><td colspan=\\"'.$num_cols.'\\">&nbsp;</td></tr>';
				$variable=$variable.$this->final_tabla;
				$variable=$variable.$this->tabla_paginacion($var_js,$curr_pag,$num_pags);
				$variable=$variable.$this->final_variable;
				$cadena=$cadena.$variable;
				$curr_pag++;
			} // while			
			$cadena=$cadena."\n\r".'</script>';	
			return $cadena;				
		}
		
		/*
		EL DISEÑO DE ESTA FUNCION OBLIGA A QUE LA VARIABLE DE JAVASCRIPT QUE VAYA A ALBERGAR SU CONTENIDO
		DEBA TENER LA CADENA DE CARACTERES ENTRE COMILLAS DOBLES
		*/
		function tabla_paginacion($var,$curr_page,$num_pages){
				$num = 1;
				$pagina='<br><table align=\\"center\\"><tr><td class=\\"cabeceraCampoFormulario\\" colspan=\\"3\\">Ir a la página:</td></tr><tr class=\\"NumerosBuscar\\">';
				if($num==$num_pages)//SI SOLO HAY UN REGISTRO
					$pagina = $pagina.'<td>&nbsp</td><td><b>1</b></td><td>&nbsp</td>';					
				else{
						if ($curr_page==1)//SI ES EL PRIMERO
							$pagina=$pagina.'<td>&nbsp</td><td>';							
						else
							$pagina=$pagina.'<td><a href=\\"#\\" onClick=\\"Ocultar(\'\',\''.$var.'_'. ($curr_page - 1) .'\')\\">Anterior</a></td><td>';							
						while ($num <= $num_pages){//VAMOS RECORRIENDO LAS PAGINAS
							if($num==$curr_page)
								$pagina=$pagina.'<b>'.$num.'</b>&nbsp;';
							else
								$pagina=$pagina.'<a href=\\"#\\" onClick=\\"Ocultar(\'\',\''.$var.'_'.$num.'\')\\">'.$num.'</a>&nbsp;';
							$num++;
						}									
						if($curr_page==$num_pages)//SI ES EL ULTIMO
							$pagina=$pagina.'</td><td>&nbsp</td>';							
						else
							$pagina=$pagina.'</td><td><a href=\\"#\\" onClick=\\"Ocultar(\'\','.$var.'_'. ($curr_page + 1) .')\\">Siguiente</a></td>';
				}
				$pagina=$pagina.'</tr></table>';
				return $pagina;
			}
		function test(){			
			$micadena=$this->make_tables('modulos',array(0=>array('id_module'=>1,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>2,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>3,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>4,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>5,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>6,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>7,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>8,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>9,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>10,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>11,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>12,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>13,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>14,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>15,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>16,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>17,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>18,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>19,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>20,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>21,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>22,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan'),array('id_module'=>23,'pepe'=>'jose','antonio'=>'tonito','juanito'=>'juan')) ,array('nombre1',25,'nombre2',25,'nombre3',25) ,array('id_module','pepe','antonio','juanito') ,10 , array('modify','delete'), true);
			echo $micadena;
			return;
		}
	
	}
	
	
	


?>