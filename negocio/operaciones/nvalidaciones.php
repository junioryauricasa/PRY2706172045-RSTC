<script>
function EsDecimalTecla(evt)
{
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode != 46 && charCode > 31 && (charCode < 48 || charCode > 57)){
  	return false;
  }
  return true;
}

function EsNumeroEnteroTecla(evt)
{
  var charCode = (evt.which) ? evt.which : evt.keyCode;
  if (charCode > 31 && (charCode < 48 || charCode > 57)){
  	return false;
  }
  return true;
}

function EsLetraTecla(evt)
{
    var charCode = (evt.which) ? evt.which : evt.keyCode
    if ((charCode > 47 && charCode < 58) && charCode != 192) {
      return false;
    }
    return true;
}

function EsFecha(NombreId){
  var Valor = $("#"+NombreId).val();
  if (EsVacio(NombreId) == false){
    return false;
  } else if(/^([0-9]{2})\/([0-9]{2})\/([0-9]{4})$/.test(Valor) == false) {
    $("#"+NombreId+"Group").attr("class","form-group has-error has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-remove form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").attr("class","text-danger");
    $("#"+NombreId+"Obs").html("Debe tener el formato dd/mm/aaaa");
    return false;
  } else {
    $("#"+NombreId+"Group").attr("class","form-group has-success has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-ok form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").html("");
    return true;
  }
}

function EsFechaHora(NombreId){
  var Valor = $("#"+NombreId).val();
  if (EsVacio(NombreId) == false){
    return false;
  } else if(/^([0-9]{2})\/([0-9]{2})\/([0-9]{4}) ([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(Valor) == false) {
    $("#"+NombreId+"Group").attr("class","form-group has-error has-feedback");
    $("#"+NombreId+"Obs").attr("class","text-danger");
    $("#"+NombreId+"Obs").html("Debe tener el formato dd/mm/aaaa HH:mm:ss");
    return false;
  } else {
    $("#"+NombreId+"Group").attr("class","form-group has-success has-feedback");
    $("#"+NombreId+"Obs").html("");
    return true;
  }
}

function EsHora(NombreId){
  var Valor = $("#"+NombreId).val();
  if (EsVacio(NombreId) == false){
    return false;
  } else if(/^([0-1]?[0-9]|2[0-4]):([0-5][0-9])(:[0-5][0-9])?$/.test(Valor) == false) {
    $("#"+NombreId+"Group").attr("class","form-group has-error has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-remove form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").attr("class","text-danger");
    $("#"+NombreId+"Obs").html("Debe tener el formato HH:mm:ss");
    return false;
  } else {
    $("#"+NombreId+"Group").attr("class","form-group has-success has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-ok form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").html("");
    return true;
  }
}

function EsVacio(NombreId)
{
  var Valor = $("#"+NombreId).val();
  if (Valor == "" || Valor == null){
    $("#"+NombreId+"Group").attr("class","form-group has-error has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-remove form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").attr("class","text-danger");
    $("#"+NombreId+"Obs").html("Se debe rellenar el campo");
    return false;
  } else if(Valor != "" || Valor != null) {
    $("#"+NombreId+"Group").attr("class","form-group has-success has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-ok form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").html("");
    if(NombreId == "nvchUserPassword") {
      ComprobarPassword();
    }
    return true;
  }
}

function EsVacioOp(NombreId)
{
  var Valor = $("#"+NombreId).val();
  if (Valor == "" || Valor == null){
    $("#"+NombreId+"Group").attr("class","form-group");
    $("#"+NombreId+"Icono").attr({"class":"", "aria-hidden":""});
    $("#"+NombreId+"Obs").html("");
    return true;
  } else if(Valor != "" || Valor != null) {
    $("#"+NombreId+"Group").attr("class","form-group has-success has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-ok form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").html("");
    return true;
  }
}

function EsLetraOp(NombreId){
  var Valor = $("#"+NombreId).val();
  if (EsVacioOp(NombreId) == true){
    return true;
  } else if(/^[A-zÀ-ÖØ-öø-ÿ]+$/.test(Valor) == false) {
    $("#"+NombreId+"Group").attr("class","form-group has-error has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-remove form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").attr("class","text-danger");
    $("#"+NombreId+"Obs").html("Debe ser solo alfabético");
    return false;
  } else {
    $("#"+NombreId+"Group").attr("class","form-group has-success has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-ok form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").html("");
    return true;
  }
}

function EsNumeroEnteroOp(NombreId){
  var Valor = $("#"+NombreId).val();
  if (EsVacioOp(NombreId) == true){
    return true;
  } else if(/^\d+$/.test(Valor) == false) {
    $("#"+NombreId+"Group").attr("class","form-group has-error has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-remove form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").attr("class","text-danger");
    $("#"+NombreId+"Obs").html("Debe ser solo numérico");
    return false;
  } else {
    $("#"+NombreId+"Group").attr("class","form-group has-success has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-ok form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").html("");
    if(NombreId == "intCantidadOrdenCompra") {
      CalcularTotalOrdenCompra(NombreId);
    }
    return true;
  }
}

function EsLetra(NombreId){
  var Valor = $("#"+NombreId).val();
  if (EsVacio(NombreId) == false){
    return false;
  } else if(/^[A-zÀ-ÖØ-öø-ÿ]+$/.test(Valor) == false) {
    $("#"+NombreId+"Group").attr("class","form-group has-error has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-remove form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").attr("class","text-danger");
    $("#"+NombreId+"Obs").html("Debe ser solo alfabético");
    return false;
  } else {
    $("#"+NombreId+"Group").attr("class","form-group has-success has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-ok form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").html("");
    return true;
  }
}

function EsNumeroEntero(NombreId){
  var Valor = $("#"+NombreId).val();
  if (EsVacio(NombreId) == false){
    return false;
  } else if(/^\d+$/.test(Valor) == false) {
    $("#"+NombreId+"Group").attr("class","form-group has-error has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-remove form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").attr("class","text-danger");
    $("#"+NombreId+"Obs").html("Debe ser solo numérico");
    return false;
  } else {
    $("#"+NombreId+"Group").attr("class","form-group has-success has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-ok form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").html("");
    if(NombreId == "intCantidadOrdenCompra") {
      CalcularTotalOrdenCompra(NombreId);
    }
    return true;
  }
}

function EsDecimal(NombreId){
  var Valor = $("#"+NombreId).val();
  if (EsVacio(NombreId) == false){
    return false;
  } else if(/^\d+\.\d+$/.test(Valor) == false && /^\d+$/.test(Valor) == false) {
    $("#"+NombreId+"Group").attr("class","form-group has-error has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-remove form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").attr("class","text-danger");
    $("#"+NombreId+"Obs").html("Debe ser solo numérico o decimal");
    return false;
  } else {
    $("#"+NombreId+"Group").attr("class","form-group has-success has-feedback");
    $("#"+NombreId+"Icono").attr({"class":"glyphicon glyphicon-ok form-control-feedback", "aria-hidden":"true"});
    $("#"+NombreId+"Obs").html("");
    if(NombreId == "dcmPrecioOrdenCompra") {
      CalcularTotalOrdenCompra(NombreId);
    }
    if(NombreId == "dcmPrecioVenta1") {
      CalcularPrecios(Valor);
    }
    if(NombreId == "dcmDescuentoVenta2") {
      CalcularPrecioVenta2(Valor);
    }
    if(NombreId == "dcmDescuentoVenta3") {
      CalcularPrecioVenta3(Valor);
    }
    return true;
  }
}

function RestablecerValidacion(NombreId,Tipo){
  if(Tipo==1){
    $("#"+NombreId).val("");
  }
  $("#"+NombreId+"Group").attr("class","form-group");
  $("#"+NombreId+"Icono").attr({"class":"", "aria-hidden":""});
  $("#"+NombreId+"Obs").attr("class","");
  $("#"+NombreId+"Obs").html("");
}

function FechaActual(){
  var hoy = new Date();
  var dd = hoy.getDate();
  var mm = hoy.getMonth()+1;
  var yyyy = hoy.getFullYear();
  if(dd<10) {
      dd = '0'+dd
  } 

  if(mm<10) {
      mm = '0'+mm
  } 
  hoy = dd + '/' + mm + '/' + yyyy;
  return hoy;
}

function ActualizarHora(){
  var hoy = new Date();
  var dd = hoy.getDate();
  var mm = hoy.getMonth()+1;
  var yyyy = hoy.getFullYear();

  var segundos = hoy.getSeconds();
  var minutos = hoy.getMinutes();
  var horas = hoy.getHours();

  if(dd<10) {
      dd = '0'+dd
  } 

  if(mm<10) {
      mm = '0'+mm
  } 
  fecha = dd + '/' + mm + '/' + yyyy;

  if(segundos < 10)
    segundos = "0"+segundos;
  if(minutos < 10)
    minutos = "0"+minutos;
  if(horas < 10)
    horas = "0"+horas;

  $("#nvchFecha").val(fecha+" "+horas+":"+minutos+":"+segundos);
}

var miReloj = null;

function IniciarHora(){
  miReloj = setInterval(ActualizarHora,1000);
}

function OpcionFecha(accion){
  //var opcion = $("#txtOpcionFecha").val();
  clearInterval(miReloj);
  if(accion == 1){
    $("#nvchFecha").attr("readonly",false);
    $("#txtOpcionFecha").val("2");
    $("#iconOpFecha").attr("data-original-title","Reestablecer");
  } else {
    IniciarHora();
    $("#nvchFecha").attr("readonly",true);
    $("#txtOpcionFecha").val("1");
    $("#iconOpFecha").attr("data-original-title","Modificar");
  }
}
</script>