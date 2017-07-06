$(document).ready(function () {
    $("#fileuploader").uploadFile({
        url:$('#basepath').val() + "admin/product/upload_image",
        fileName:"myfile",
        dataType: 'json',
        onSuccess : function (e, data) {
            $('#image-list').html(data.image_list);
        }
    });
    $('.is_primary').on('click', function(){
        is_primary = $(this).prop('checked') ? 1 : 0;
        if(is_primary){
           $('.is_primary').prop('checked', false); 
           $(this).prop('checked', true);
        }
        $.ajax({
            url: $('#basepath').val() + "admin/product/imagePrimary/" + $(this).attr('data-id') + '/' + is_primary 
        });
    });
});