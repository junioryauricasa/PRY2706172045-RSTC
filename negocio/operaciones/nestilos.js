//////////////////////////////////////////////////////////////
/* INICIO - Dirigirse al div */
function goToBox(box){
	window.location.href = box;
	window.scrollTo(window.scrollX, window.scrollY - 60);
}
/* FIN - Dirigirse al div */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Dirigirse al div */
function MensajeNormal(texto,tipomensaje){
	$(".modal-header").css("background-color", "#78909c");
    $(".modal-title").css("color", "#FFFFFF");
    $(".modal-footer").css("background-color", "#cfd8dc");
	if(tipomensaje == 1){
		$(".modal-title").html("Mensaje Informativo");
		$(".modal-body").html("<div class='text-center'>"+
			"<img src='../../view/modals/imagenes/icon-info.png' style='width: 30px; height: 30px; margin: 0px 6px;'>"+
			texto+"</div>");
		$("#MensajeNormal").modal("show");
	} else if(tipomensaje == 2) {
		$(".modal-title").html("Mensaje de Advertencia");
		$(".modal-body").html("<div class='text-center'>"+
			"<img src='../../view/modals/imagenes/icon-warning.png' style='width: 30px; height: 30px; margin: 0px 6px;'>"+
			texto+"</div>");
		$("#MensajeNormal").modal("show");
	} else if(tipomensaje == 3) {
		$(".modal-title").html("Mensaje de Alerta");
		$(".modal-body").html("<div class='text-center'>"+
			"<img src='../../view/modals/imagenes/icon-alert.png' style='width: 30px; height: 30px; margin: 0px 6px;'>"+
			texto+"</div>");
		$("#MensajeNormal").modal("show");
	}
}
/* FIN - Dirigirse al div */
//////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////
/* INICIO - Dirigirse al div */
function MensajeConfirmacion(texto,tipomensaje){
	if(tipomensaje == 1){
		$(".modal-title").html("Mensaje Informativo");
		$(".modal-body").html(texto);
		$("#MensajeConfirmacion").modal("show");
	} else if(tipomensaje == 2) {
		$(".modal-title").html("Mensaje de Advertencia");
		$(".modal-body").html(texto);
		$("#MensajeConfirmacion").modal("show");
	} else if(tipomensaje == 3) {
		$(".modal-title").html("Mensaje de Alerta");
		$(".modal-body").html(texto);
		$("#MensajeConfirmacion").modal("show");
	}
}
/* FIN - Dirigirse al div */
//////////////////////////////////////////////////////////////