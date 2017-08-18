$('document').ready(function() {
    $('#departamento').change(function(){
        var country_id = $(this).val();
        $("#provincia > option").remove();
        $.ajax({
            type: "POST",
            url: "populate_data.php",
            data: "cid=" + country_id,
            success:function(opt){
                $('#provincia').html(opt);
            }
        });
    });

    $('#provincia').change(function(){
        var state_id = $(this).val();
        $("#distrito > option").remove();
        $.ajax({
            type: "POST",
            url: "populate_data.php",
            data: "sid=" + state_id,
            success:function(opt){
                $('#distrito').html(opt);
            }
        });
    });
});