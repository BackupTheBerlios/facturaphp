<?php
require_once('tools.php');

	print_r($_POST);
   print_r($_GET);
   print_r($_SERVER);
   print_r($_FILES);
   print_r($_ENV);
   print_r($_COOKIE);
   print_r($_SESSION);
	$count=vwVarFromInput('count');

	for($z=1;$z<$count+1;$z++)
		{
			$var=vwVarFromInput("r$z");
				if ($var!="VIRGIN")
					{
						$stax[$z]=array(
										"h"=>vwVarFromInput("T$z"),
										"a"=>vwVarFromInput("A$z"));
						}
			}

	print_r($stax);
	die();
?>
