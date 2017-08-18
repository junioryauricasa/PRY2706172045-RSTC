<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>ubigeo</title>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
	<script type="text/javascript">
		$(document).ready(function(){
			$.ajax({
				url: 'datos.php?Accion=GetDepartamentos',
				success:function(Datos){
					for (x = 0; x<Datos.length; x++) 
					{
						//$("#CboDepartamentos").append("<option value='"+ Datos[x].IdDepartamento+"'>"+ Datos[x].Departamento+"</option>");
						$("#CboDepartamentos").append(new Option(Datos[x].Departamento, Datos[x].IdDepartamento));
					}
				}
			})
			$('#CboDepartamentos').change(function() {
				$('#CboProvincias,#CboDistritos').empty();
				$.getJSON('datos.php', {Accion: 'GetProvincias',IdDepartamento:$('#CboDepartamentos option:selected').val()}, function(Datos) {
						for (x=0, x<Datos.length; x++) {
							$('#CboProvincias').append(new Option(Datos[x].Provincia, Datos[x].IdProvincia));
						}
				})
			});
			$('#CboProvincias').change(function() {
				$('#CboDistritos').empty();
				$.getJSON('datos.php', {Accion: 'GetDistritos',IdProvincia:$('#CboProvincias option:selected').val()}, function(Datos) {
						for (x=0, x<Datos.length; x++) {
							$('#CboDistritos').append(new Option(Datos[x].Distrito, Datos[x].IdDistrito));
						}
				});
			});
		});
	</script>
</head>
<body>
	<select name="" id="CboDepartamentos"></select>
	<select name="" id="CboProvincias"></select>
	<select name="" id="CboDistritos"></select>
</body>
</html>