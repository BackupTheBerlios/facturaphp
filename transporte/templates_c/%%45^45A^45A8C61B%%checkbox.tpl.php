<?php /* Smarty version 2.6.3, created on 2005-02-28 20:34:27
         compiled from checkbox.tpl */ ?>
<?php echo '
<script>
	
	function check_uncheck(obj){
		if (obj.checked)
			marca_arriba(obj);
		else
			desmarca_abajo(obj);		
	}
	
	function marca_arriba(obj){
		cadena=obj.name;
		finCadena=cadena.substring(0,cadena.indexOf(\'_\'));
		while(finCadena!=cadena){			
			document.getElementById(cadena).checked=true;			
			cadena=cadena.substring(cadena.lastIndexOf(\'_\'),0);			
		}
	}
	
	function desmarca_abajo(obj){
		for(i=0;i<document.forms[\'form_central\'].elements.length;i++){
			element=document.forms[\'form_central\'].elements[i];
			if(element.name.substring(0,obj.name.length)==obj.name)	
				element.checked=false;
		}		
	}
	
	function selectAll(){
		for (var i=0;i<document.forms["form_central"].elements.length;i++){
			if(document.forms["form_central"].elements[i].type=="checkbox"){
				document.forms["form_central"].elements[i].checked=true;
				}
		}
	}
    function unselectAll(){
		for (var i=0;i<document.forms["form_central"].elements.length;i++){
			if(document.forms["form_central"].elements[i].type=="checkbox"){
				document.forms["form_central"].elements[i].checked=false;
				}
		}
	}
    
</script>
'; ?>