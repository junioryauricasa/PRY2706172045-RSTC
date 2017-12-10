<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ejemplo preloader</title>
</head>
<body>
	<!-- input de activacion para el preloader -->
	<input type="button" value="Busqeuda avanzada" onclick="myFunction()">
	<!-- loader activado -->
	<div id="loader" style="display: none"></div>
	<!-- div del form -->
	<div id="divBusquedaAvanzada">
		<input type="text" placeholder="nombre">
		<br>
		<input type="text" placeholder="apellidos">
		<br>
		<input type="button" value="Enviar">
	</div>
	<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Consequuntur maxime recusandae magni possimus nisi nihil ipsam aliquam quas delectus? Odio accusamus facilis totam dignissimos labore temporibus nihil itaque beatae incidunt.</p>

</body>
</html>


<style>
	/* Center the loader */
	#loader {
	  position: absolute;
	  /*
	  left: 50%;
	  top: 50%;
	  
	  z-index: 1;
	  */
	  width: 50px;
	  height: 50px;

	  border: 6px solid #f3f3f3;
	  border-radius: 50%;
	  border-top: 6px solid #3498db;
	  width: 30px;
	  height: 30px;
	  -webkit-animation: spin 2s linear infinite;
	  animation: spin 2s linear infinite;
	}

	@-webkit-keyframes spin {
	  0% { -webkit-transform: rotate(0deg); }
	  100% { -webkit-transform: rotate(360deg); }
	}

	@keyframes spin {
	  0% { transform: rotate(0deg); }
	  100% { transform: rotate(360deg); }
	}

	/* Add animation to "page content" */
	.animate-bottom {
	  position: relative;
	  -webkit-animation-name: animatebottom;
	  -webkit-animation-duration: 1s;
	  animation-name: animatebottom;
	  animation-duration: 1s
	}

	@-webkit-keyframes animatebottom {
	  from { bottom:-100px; opacity:0 } 
	  to { bottom:0px; opacity:1 }
	}

	@keyframes animatebottom { 
	  from{ bottom:-100px; opacity:0 } 
	  to{ bottom:0; opacity:1 }
	}

	#divBusquedaAvanzada {
	  display: none;
	  margin-top: 10px
	}
</style>


<script>

	function myFunction() {
	    document.getElementById("loader").style.display = "block";
	    setTimeout(showPage, 2000);
	}

	function showPage() {
	  document.getElementById("loader").style.display = "none";
	  document.getElementById("divBusquedaAvanzada").style.display = "block";
	}
</script>