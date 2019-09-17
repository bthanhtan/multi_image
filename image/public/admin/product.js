var local_link = "http://localhost/Laravel/multi_image/image/public/";
var so_hinh = 0;
function upload_Image_change(this_input, dem) {
    console.log(so_hinh);
    if (dem > 0) {so_hinh =  dem + 1 ;}
    
    console.log(so_hinh);
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
        url: local_link + "admin/product/uploadimage", 
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
                content_img += '<img src="'+ local_link + value + '" width="200">';
                content_img += '<input type="text" name="file[image]['+so_hinh+'][src]" value="' + value + '"/>';
                content_img += '<div style="position: relative;right: 20px;display: inline-block;top: -80px;border: 1px solid;padding: 5px 10px;border-radius: 50%;">X</div>';
                content_img += '</div>';
                status_img += value + '<br>';
                $('#them_img').append(content_img);
                so_hinh++;
            });
            $('.name_img').append(status_img);
            console.log(so_hinh);
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
        url:  local_link + "admin/product/edit_image", 
        dataType: 'json',
        cache: false,
        contentType: false,
        processData: false,
        data: form_data,
        type: 'post',
        success: function(response) {
        	console.log(response);
            val_img = local_link+response[0];
            $(".new_val_img_"+id).attr("src",val_img);
            $('.new_val_input_'+id).attr("value",response[0]);
        }
    });
    return false;
}



function delete_Image(this_input, id) {
    var input = this_input;
    var class_this_input = "btn_delete_" + id;
	$.ajax({
        url:  local_link + "admin/product/delete_image/" + id, 
        type: 'get',
        success: function() {
        	$( input ).parents('.abcd').remove();
        }
    });
}


function upload_Image_change_edit(this_input) {
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
        url: local_link + "admin/product/uploadimage", 
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
                content_img += '<img src="'+ local_link + value + '" width="200">';
                content_img += '<input type="text" name="file[image]['+index+'][src]" value="' + value + '"/>';
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