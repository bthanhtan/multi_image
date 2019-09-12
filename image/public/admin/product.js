
function upload_Image_change(this_input) {
    var data_file = this_input.files;
    var token = $('meta[name="csrf-token"]').attr('content');
    var form_data = new FormData();
    form_data.append('_token', token);
    $.each(data_file, function(index, value) {

        form_data.append('file[]', value);
    });
    for (var value of form_data.values()) {
	   console.log(value); 
	}
    var content_img = "";
    var status_img = "";
    $.ajax({
        url: "http://weblocal.win/admin/product/uploadimage", 
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(response) {
            var danhsach_images = response;
            console.log(danhsach_images);
            $.each(danhsach_images, function(index, value) {
                console.log('test');
                console.log(value);
                content_img = '<div style="margin-bottom: 60px;" onclick="xoa_ajax_multi_Image(' + value + ')">';
                content_img += '<img src="http://weblocal.win/' + value + '" width="200">';
                content_img += '<input type="text" name="file[image]['+index+']" value="' + value + '"/>';
                content_img += '<div style="position: relative;right: 20px;display: inline-block;top: -80px;border: 1px solid;padding: 5px 10px;border-radius: 50%;">X</div>';
                content_img += '</div>';
                status_img += value + '<br>';
                $('#them_img').append(content_img);

            });
            $('.name_img').append(status_img);
        }
    });
    return false;
}




function edit_Image_change(this_btn, id) {
	var data_file = this_btn.files;
    var token = $('meta[name="csrf-token"]').attr('content');
    var form_data = new FormData();
    form_data.append('_token', token);
    form_data.append('id', id);
    $.each(data_file, function(index, value) {
        form_data.append('file[]', value);
    });
    
	var val_img = "";
    var val_input = "";
    $.ajax({
        url: "http://weblocal.win/admin/product/edit_image", 
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(response) {
        	console.log(response);
            val_img = "http://weblocal.win/"+response[0];
            val_input = ' <input id="new_val_input" type="text" name="file[image][src][{{$key}}]" value="'+response[0]+'"/>';
            $(".new_val_img_"+id).attr("src",val_img);
            $('.new_val_input_'+id).attr("value",response[0]);
        }
    });
    return false;
}



function delete_Image(id) {
	$.ajax({
        url: "http://weblocal.win/admin/product/edit_image", 
        type: 'get',
        success: function(response) {
        	console.log(response);
            val_img = "http://weblocal.win/"+response[0];
            val_input = ' <input id="new_val_input" type="text" name="file[image][src][{{$key}}]" value="'+response[0]+'"/>';
            $(".new_val_img_"+id).attr("src",val_img);
            $('.new_val_input_'+id).attr("value",response[0]);
        }
    });
}