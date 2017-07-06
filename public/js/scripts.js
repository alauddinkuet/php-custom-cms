$(document).ready(function () {
    $(document).ready(function() {
        $("#fileuploader").uploadFile({
            url:$('#basepath').val() + "admin/product/upload_image",
            fileName:"myfile",
            dataType: 'json',
            onSuccess : function (e, data) {
                $('#image-list').html(data.image_list);
            }
        });
    });
});