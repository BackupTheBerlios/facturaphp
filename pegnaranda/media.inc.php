<?php
	require_once("v_image.inc.php");

	/* Gestor de recursos y medios
		El array $media define las extensiones admitidas asi como el tratamiento del cual serán objeto
		por parte del gestor de medios.

		Cada extension admitida tiene los siguientes parametros:

		"tipo" => (
								"extension" => "extension admitida",
								"type"		=>	"tipo de archivo" -soportados Audio,Video,Imagen,Documento,
								"restricted"	=> si el medio esta restringido por defecto,
								"preview"	=> si hay alguna imagen previa, si no lo hay la funcion getPreview("tipo")
												nos devuelve una imagen adecuada.
								"funcion"	=> nombre de la funcion que realiza la vista previa.
								"header"	=> tipo enviado al navegador...
												)
	*/

	/*	Prueba de concepto de que funciona.....
		include ("config.inc.php");
		global $rsc_dir;
		$a=fopen($rsc_dir."/a.jpg","r");
		$c=fread($a, filesize($rsc_dir."/a.jpg"));
		fclose($a);

		print_r($c);
		die();
		*/

	global $media;
	/* Anyadir gestion para metaarchivos de wmv y rm , anyadir tiff*/
	$media=array(
					"mp3"=>array
						(	"extension"=>".mp3","type"=>"Audio","restricted"=>false,
							'preview'=>false,"header"=>"audio/mpeg"),
					"ogg"=>array
						(	"extension"=>".ogg","type"=>"Audio","restricted"=>false,
							'preview'=>false,"header"=>"application/ogg"),
					"wav"=>array
						(	"extension"=>".wav","type"=>"Audio","restricted"=>false,
							'preview'=>false,"header"=>"audio/x-wav"),
					"avi"=>array
						(	"extension"=>".avi","type"=>"Video","restricted"=>false,
							'preview'=>false,"header"=>"video/msvideo"),
					"ogm"=>array
						(	"extension"=>".ogg","type"=>"Video","restricted"=>false,
							'preview'=>false,"header"=>"application/x-ogg"),
					"mpg"=>array
						(	"extension"=>".mpg","type"=>"Video","restricted"=>false,
							'preview'=>false,"header"=>"video/mpeg"),
					"png"=>array
						(	"extension"=>".png","type"=>"Imagen","restricted"=>false,
							'preview'=>true,"header"=>"image/png","funcion"=>"pngThumbnail"),
					"jpg"=>array
						(	"extension"=>".jpg","type"=>"Imagen","restricted"=>false,
							'preview'=>true,"header"=>"image/jpeg","funcion"=>"jpgThumbnail"),
					"pdf"=>array
						(	"extension"=>".pdf","type"=>"Document","restricted"=>false,
							'preview'=>true,"header"=>'application/pdf',"funcion"=>"pdfThumbnail"),
					"rtf"=>array
						(	"extension"=>".rtf","type"=>"Document","restricted"=>true,
							'preview'=>false,"header"=>'application/rtf'),
					"sxw"=>array
						(	"extension"=>".sxw","type"=>"Audio","restricted"=>true,
							'preview'=>false,"header"=>"application/vnd.sun.xml.writer"),
					"ram"=>array
						(
							"extension"=>".ram","type"=>"Video","restricted"=>false,
							'preview'=>false,"header"=>"audio/x-pn-realaudio"),
					"rm"=>array
						(
							"extension"=>".rm","type"=>"Video","restricted"=>false,
							'preview'=>false,"header"=>"audio/x-pn-realaudio"),
					"ra"=>array
						(
							"extension"=>".ra","type"=>"Video","restricted"=>false,
							'preview'=>false,"header"=>"audio/x-pn-realaudio"),
					"asx"=>array
						(
							"extension"=>".ram","type"=>"Video","restricted"=>false,
							'preview'=>false,"header"=>"video/x-ms-asf"),
					"asf"=>array
						(
							"extension"=>".rm","type"=>"Video","restricted"=>false,
							'preview'=>false,"header"=>"video/x-ms-asf"),
					"tif"=>array
						(	"extension"=>".tif","type"=>"Imagen","restricted"=>false,
							'preview'=>true,"header"=>"image/tiff","funcion"=>"tiffThumbnail")
					);

	// Nos da true si el archivo subido es un medio valido o no en funcion de su extension
	// si lo es nos da la informacion acerca del mismo.
	function isAValidMedia($filename)
		{
			global $media;
			$valid=false;
			$offset=strlen($filename)-4;
			foreach($media as $k => $v)
				{
					if (strpos($filename,$v['extension'],$offset)!=false)
						{
							$valid=$v;
							break;}
					}
			return $valid;
			}

	function returnMedia($filename)
		{
			global $media;
			$valid=false;
			$offset=strlen($filename)-4;
			foreach($media as $k => $v)
				{
					if (strpos($filename,$v['extension'],$offset)!=false)
						{
							$valid=$k;
							break;}
					}
			return $valid;
			}

	// Sube el archivo y genera si es adecuado una imagen previa para el mismo.

	function UploadResource($resource,$resource_name,$relpath)
		{
			global $rsc_dir;

			if ((isset($resource)))
				{
					$resource_name=$resource_name;
					$resourcetype=isAValidMedia($resource_name);
					if (!($resourcetype===false))
						{
							move_uploaded_file($resource,"$rsc_dir$relpath/".$resource_name);
							chmod("$rsc_dir$relpath/".$resource_name,octdec("0777"));
							$previo=$resourcetype['funcion']($resource_name,$relpath);
							return $previo;
							}
					else
						{
							return false;}
				}
			return false;
		}

	function ImportResource($resource_name,$path,$relpath)
		{
			global $rsc_dir;

			if ((isset($resource_name)))
				{
					$resource_name=$resource_name;
					$resourcetype=isAValidMedia($resource_name);
					if (!($resourcetype===false))
						{
							rename("/var/www/localhost/htdocs/hpenaranda/importar/recursos/$path/$resource_name","$rsc_dir$relpath/".$resource_name);
							chmod("$rsc_dir$relpath/".$resource_name,octdec("0777"));
							$previo=$resourcetype['funcion']($resource_name,$relpath);
							return $previo;
							}
					else
						{
							return false;}
				}
			return false;
		}

	function outputFile($filename,$path)
		{
			if (vwSessionGetVar('downloadz')!=true)
				{
					global $rsc_dir;
					$data=isAValidMedia($filename);
					$size = filesize("$rsc_dir$path/$filename");
					/*echo '<html>
							';
					echo '<body onLoad="clow();">
							&nbsp;
							<script>
								function clow()
									{
										window.close();}
							</script>
							</body >
						</html>';*/
					header("Pragma: public");
					header("Expires: 0");
					header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
					header("Content-Type: $data[header]");
					header("Content-Disposition: attachment; filename=$filename");
					header("Content-Description: Descarga de recurso");
					header('Content-Length: '.$size);
					header('Content-Transfer-Encoding: base64');
					vwSessionSetVar('downloadz',true);
					@readfile("$rsc_dir$path/$filename");
					echo "<meta http-equiv='refresh' content='7'>";
					die();
					}
			else
				{
					vwSessionSetVar('downloadz',false);
					echo '<body onLoad="clow();">
							&nbsp;
							<script>
								function clow()
									{
										window.close();}
							</script>
							</body >
						</html>';
					die();
				}
			}


	function WantImageSize($filename)
	{
		if (!file_exists($filename))
			{
				return false;}
		$imag=new v_Image($filename);
		$c['alto']=$imag->image_original_width;
		$c['ancho']=$imag->image_original_height;
		return $c;
		}

	function PerfectSize($x,$y)
	{
		$MaxX=160;
		$MaxY=160;
		if (($y>$MaxY)&&($x>$MaxX))
			{
				if ($y>$x)
					{
						$coords['y']=$MaxY;
						$coords['x']=floor(($x/$y)*$MaxX);}
				else
					{
						$coords['x']=$MaxX;
						$coords['y']=floor(($y/$x)*$MaxY);}
				}
		else {
				if (($MaxY>=$y)&&($MaxX>=$x))
					{
						$coords['x']=floor($x*0.9);
						$coords['y']=floor($y*0.9); } //NOTA: ESTE CASO NO DEBE DARSE NUNCA!!!!
				else
					{
						$aux=PerfectSize($x*0.9,$y*0.9);
						$coords['x']=$aux['x'];
						$coords['y']=$aux['y'];
					};
				};
		return $coords;
		};

	function pngThumbnail($filename,$relpath)
		{
			return imageThumbnail($filename,$relpath);}

	function jpgThumbnail($filename,$relpath)
		{
			return imageThumbnail($filename,$relpath);}

	function imageThumbnail($filename,$relpath)
		{
			global $gd2;
			global $rsc_dir;
			global $prev_dir;
			$thumb=new v_Image(trim("$rsc_dir$relpath/$filename"),$gd2);
			$x=$thumb->image_original_width;
			$y=$thumb->image_original_height;
			$aux=PerfectSize($x,$y);
			$thumb->resize($aux['x'],$aux['y'],"0");
			$thumb->output_resized("$prev_dir$relpath/");
			$f=$thumb->filename_resized;
			unset($thumb);
			return $f;
			};

	function pdfThumbnail($filename,$relpath)
		{
			global $rsc_dir,$prev_dir;
			$command="convert -resize 113x160 $rsc_dir$relpath/$filename"."[0] $prev_dir$relpath/$filename.jpg";
			$z=`$command`;
			chmod("$prev_dir$relpath/$filename.jpg",0777);
			}

	function tiffThumbnail($filename,$relpath)
		{
			global $rsc_dir,$prev_dir;
			$command="convert -resize 113x160 $rsc_dir$relpath/$filename"."[0] $prev_dir$relpath/$filename.jpg";
			$z=`$command`;
			chmod("$prev_dir$relpath/$filename.jpg",0777);
			}

?>