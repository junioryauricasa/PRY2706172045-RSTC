$(document).ready( function () 
    {
      $('#table_cust').DataTable({
        "paging": true,
        "lengthChange": true,
        "searching": true,
        "ordering": true,
        "info": false,
        "responsive": true,
        "autoWidth": false,
        "pageLength": 10,
        "ajax": {
          "url": "data.php",
          "type": "POST"
        },
        "columns": [
        { "data": "urutan" },
        { "data": "intUserId" },
        { "data": "nvchUserName" },
        { "data": "nchUserMail" },
        { "data": "nvchUserPassword" },
        { "data": "intIdEmpleado" },
        { "data": "bitUserEstado" },
        { "data": "intTypeUser" },
        ]
      });


    });
    //ADD
    $(document).on("click","#btnadd",function(){
        $("#modalcust").modal("show");
        //$("#txtnvchUserName").focus();´//predeterminado

        $("#nvchUserName").val("");
        $("#nchUserMail").val("");
        $("#nvchUserPassword").val("");
        $("#intIdEmpleado").val("0");
        $("#bitUserEstado").val("0");
        $("#intTypeUser").val("0");

        $("#txtintUserId").val("0");
    });

    //Delete
    $(document).on( "click",".btnhapus", function() {
      var intUserId = $(this).attr("intUserId");
      var nvchUserName = $(this).attr("nvchUserName");
      swal({   
        title: "Eliminar Registro?",   
        text: "Eliminar Registro: "+nvchUserName+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Eliminar",   
        closeOnConfirm: true }, 
        function(){   
          var value = {
            intUserId: intUserId
          };
          $.ajax(
          {
            url : "delete.php",
            type: "POST",
            data : value,
            success: function(data, textStatus, jqXHR)
            {
              var data = jQuery.parseJSON(data);
              if(data.result ==1){
                $.notify('Registro Eliminado');
                var table = $('#table_cust').DataTable(); 
                table.ajax.reload( null, false );
              }else{
                swal("Error","No se pueden eliminar datos de los clientes, error : "+data.error,"error");
              }

            },
            error: function(jqXHR, textStatus, errorThrown)
            {
             swal("Error!", textStatus, "error");
            }
          });
        });
    });

    //guardar
    $(document).on("click","#btnsave",function(){
      var intUserId = $("#intUserId").val();
      var nvchUserName = $("#nvchUserName").val();
      var nchUserMail = $("#nchUserMail").val();
      var nvchUserPassword = $("#nvchUserPassword").val();
      var intIdEmpleado = $("#intIdEmpleado").val();
      var bitUserEstado = $("#bitUserEstado").val();
      var intTypeUser = $("#intTypeUser").val();

      var db_resteco=$("#crudmethod").val();
      if(nvchUserName == '' || nvchUserName == null ){
        swal("Warning","Por favor, rellene el nombre del cliente","warning");
        $("#nvchUserName").focus();
        return;
      }
      var value = {
        intUserId:        intUserId,
        nvchUserName:     nvchUserName,
        nchUserMail:      nchUserMail,
        nvchUserPassword: nvchUserPassword,
        intIdEmpleado:    intIdEmpleado,
        bitUserEstado:    bitUserEstado,
        intTypeUser:      intTypeUser,

        db_resteco:db_resteco
      };
      $.ajax(
      {
        url : "save.php",
        type: "POST",
        data : value,
        success: function(data, textStatus, jqXHR)
        {
          var data = jQuery.parseJSON(data);
          if(data.db_resteco == 'N'){
            if(data.result == 1){
              $.notify('Registro Guardado');
              var table = $('#table_cust').DataTable(); 
              table.ajax.reload( null, false );
              $("#intUserId").val("");
              $("#nvchUserName").val("");
              $("#nchUserMail").val("");
              $("#nvchUserPassword").val("");
              $("#intIdEmpleado").val("0");
              $("#bitUserEstado").val("0");
              $("#intTypeUser").val("0");
            }else{
              swal("Error","No se pueden guardar los datos del cliente, error : "+data.error,"error");
            }
          }else if(data.db_resteco == 'E'){
            if(data.result == 1){
              $.notify('Registro Actualizado Exitosamente!!!');
              var table = $('#table_cust').DataTable(); 
              table.ajax.reload( null, false );
              $("#nvchUserName").focus();
            }else{
             swal("Error","No se pueden actualizar los datos del cliente, error : "+data.error,"error");
            }
          }else{
            swal("Error","Orden inválida","error");
          }
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
           swal("Error!", textStatus, "error");
        }
      });
    });

    //actualizar
    $(document).on("click",".btnedit",function(){
      var intUserId=$(this).attr("intUserId");
      var value = {
        intUserId: intUserId
      };
      $.ajax(
      {
        url : "get_cust.php",
        type: "POST",
        data : value,
        success: function(data, textStatus, jqXHR)
        {
          var data = jQuery.parseJSON(data);
          $("#crudmethod").val("E");

          $("#intUserId").val(data.intUserId);
          $("#nvchUserName").val(data.nvchUserName);
          $("#nchUserMail").val(data.nchUserMail);
          $("#nvchUserPassword").val(data.nvchUserPassword);
          $("#intIdEmpleado").val(data.intIdEmpleado);
          $("#bitUserEstado").val(data.bitUserEstado);
          $("#intTypeUser").val(data.intTypeUser);

          $("#modalcust").modal('show');
          $("#nvchUserName").focus();
        },
        error: function(jqXHR, textStatus, errorThrown)
        {
          swal("Error!", textStatus, "error");
        }
      });
    });
    $.notifyDefaults({
      type: 'success',
      delay: 500
    });