<?php
 // Importar documentos a la bbdd 
 	
 		global $documentdir;
		$documentdir="/var/www/importardocs/";
		
 		require_once("tools.php");
		require_once("db.inc.php");
		require_once("vardb.inc.php");
		require_once("varsession.inc.php");
		require_once("render.inc.php");
		Init();
		
		list($db)=Getdb();
		
		$table=GetTable("archivos");
		$cols=GetCols("archivos");
		$sql="SELECT $cols[aid],$cols[abrev] from $table";
		$rs=$db->Execute($sql);
		
		while(!$rs->EOF)
			{
				$archivo=$rs->FetchRow();
				$archivos[$archivo[$cols['aid']]]=$archivo[$cols['abrev']];
				//$rs->MoveNext();
				}
				
		$table=GetTable("documentos");
		$cols=GetCols("documentos");

		$sql="SELECT $cols[did],$cols[aid],$cols[signatura],$cols[folios] from $table";
		$rs=$db->Execute($sql);
		$z=0;
		while(!$rs->EOF)
			{
				$Documentos[$z]=$rs->FetchRow();
				$Documentos[$z][$cols['aid']]=$archivos[$Documentos[$z][$cols['aid']]];
				//$rs->MoveNext();
				$z=$z+1;
				}
		echo '<font style="font-size: 8px;">';
		foreach($Documentos as $doc)
			{
				echo "$doc[did];\"$doc[aid]\";\"$doc[txtSignatura]\";\"$doc[txtFolios]\"<br>";}
		echo '</font>';
		die();
		function importarDocs()
			{
				}
				
?>