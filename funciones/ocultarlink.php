<?php 
	
	/*
		funcion paea ocultar ruta de un <a> al pasar cursor sobre este
	*/

 ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>Document</title>
	<head>
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	</head>
</head>
<body>
	<a href="http://godaddy.com?id=12" data-url="http://x.co/bufaes" class="link-afiliado">godaddy</a>
</body>
</html>


<script>
	$( ".link-afiliado" ).click(function(e) {
    e.preventDefault();
    window.open( $(this).data('url') );
});
</script>