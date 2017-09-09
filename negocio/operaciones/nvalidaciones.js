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
    return true;
  }
}