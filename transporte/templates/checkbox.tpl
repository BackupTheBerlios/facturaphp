{literal}
<script>
	
	function clickCheckbox(){
	
	}
	
	function selectRow(){
	
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
{/literal}