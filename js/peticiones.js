function send_data(path_php,id_form,div_resp) {
    $.ajax({
        type: "POST",
        url: path_php,
        data: $("#"+id_form).serialize(),
        success: function (data){
            $('#'+div_resp).html(data);
        }
    });
}
