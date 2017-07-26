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
        { "data": "name" },
        { "data": "gender" },
        { "data": "country" },
        { "data": "phone" },
        { "data": "button" },
        ]
      });


    });
    //ADD
    $(document).on("click","#btnadd",function(){
        $("#modalcust").modal("show");
        $("#txtname").focus();
        $("#txtname").val("");
        $("#txtcountry").val("");
        $("#txtphone").val("");
        $("#crudmethod").val("N");
        $("#txtid").val("0");
    });

    //Delete
    $(document).on( "click",".btnhapus", function() {
      var id_cust = $(this).attr("id_cust");
      var name = $(this).attr("name_cust");
      swal({   
        title: "Eliminar Registro?",   
        text: "Eliminar Registro: "+name+" ?",   
        type: "warning",   
        showCancelButton: true,   
        confirmButtonColor: "#DD6B55",   
        confirmButtonText: "Eliminar",   
        closeOnConfirm: true }, 
        function(){   
          var value = {
            id_cust: id_cust
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
      var id_cust = $("#txtid").val();
      var name = $("#txtname").val();
      var gender = $("#cbogender").val();
      var country = $("#txtcountry").val();
      var phone = $("#txtphone").val();
      var crud=$("#crudmethod").val();
      if(name == '' || name == null ){
        swal("Warning","Por favor, rellene el nombre del cliente","warning");
        $("#txtname").focus();
        return;
      }
      var value = {
        id_cust: id_cust,
        name: name,
        gender:gender,
        country:country,
        phone:phone,
        crud:crud
      };
      $.ajax(
      {
        url : "save.php",
        type: "POST",
        data : value,
        success: function(data, textStatus, jqXHR)
        {
          var data = jQuery.parseJSON(data);
          if(data.crud == 'N'){
            if(data.result == 1){
              $.notify('Registro Guardado');
              var table = $('#table_cust').DataTable(); 
              table.ajax.reload( null, false );
              $("#txtname").focus();
              $("#txtname").val("");
              $("#txtcountry").val("");
              $("#txtphone").val("");
              $("#crudmethod").val("N");
              $("#txtid").val("0");
              $("#txtnama").focus();
            }else{
              swal("Error","No se pueden guardar los datos del cliente, error : "+data.error,"error");
            }
          }else if(data.crud == 'E'){
            if(data.result == 1){
              $.notify('Registro Actualizado Exitosamente!!!');
              var table = $('#table_cust').DataTable(); 
              table.ajax.reload( null, false );
              $("#txtname").focus();
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
      var id_cust=$(this).attr("id_cust");
      var value = {
        id_cust: id_cust
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
          $("#txtid").val(data.id_cust);
          $("#txtname").val(data.name);
          $("#cbogender").val(data.gender);
          $("#txtcountry").val(data.country);
          $("#txtphone").val(data.phone);

          $("#modalcust").modal('show');
          $("#txtname").focus();
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