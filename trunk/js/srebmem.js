function resizeModal()
{
    $('#simplemodal-container, #simplemodal-container *').css('height', 'auto');
    if ($('#simplemodal-container').height() > 500)
	$('#simplemodal-container').css('height', '500px');
}

function addGallery()
{
    $('#fenetre').modal({close: false});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
	type: 'post',
	dataType: 'json',
	url: '/ajax/add_gallery.php',
	success: function(response) {
	    $("#fenetreText").html(response.text);
	    $("#fenetreBottom").html(response.bottom);
	}
    });
}

function selectGallery(id)
{
    selectedGallery = id;
    
    $.ajax({
	type: 'post',
	data: {id: id},
	url: '/ajax/list_gallery.php',
	success: function(response) {
	    if ($("#galleryTree0 .galleryTree").length != 0 && $("#linkToGallery" + id).parents(".liGallerySelected").length == 0 && $("#linkToGallery" + id).parent().siblings(".liGallerySelected").length == 0)
	    {
		$("#galleryTree0 .galleryTree").slideUp("slow", function() {
		    $(this).remove();
		    $("#linkToGallery" + id).parent().append(response);
		    $("#linkToGallery" + id).next("ul").slideDown("slow");
		});
	    }
	    else
	    {
		$("#linkToGallery" + id).parent().append(response);
		$("#linkToGallery" + id).next("ul").slideDown("slow");
	    }
	    
	    $("#parentGallerySelected").html($("#linkToGallery" + id).html());
    
	    $(".liGallerySelected").each(function(){$(this).removeClass("liGallerySelected");});
	    $(".linkGallerySelected").each(function(){$(this).removeClass("linkGallerySelected");});
	    
	    $("#linkToGallery" + id).parent().addClass("liGallerySelected");
	    $("#linkToGallery" + id).addClass("linkGallerySelected");
	    
	    $("#parent_id").val(id);
	}
    });
}

var selectedGallery = false;

function submitAddGallery()
{
    var emptyFields = false;
    $("#formResult").html('');
    $('.gallery_name').each(function(){
	if ($(this).val() == "")
	    emptyFields = true;
    });
    
    if (emptyFields)
    {
	$("#formResult").html(emptyFieldsMsg);
    }
    
    if ($("#parent_id").val() == "")
    {
	$("#formResult").html(emptyParentMsg);
    }
    
    if (!emptyFields && $("#parent_id").val() != "")
    {
	$.ajax({
	    type :'post',
	    url: '/ajax/save_gallery.php',
	    data: $('#fenetre form').serialize(),
	    dataType: 'json',
	    success: function(response){
		if (response.success == 1)
		    $.modal.close();
		else
		    $("#formResult").html(response.errors);
	    }
	});
    }
}

function addPhotos()
{
    $('#fenetre').modal({close: false, containerCss: {width: 980}});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
	type: 'post',
	dataType: 'json',
	url: '/ajax/add_photos.php',
	success: function(response) {
	    $("#fenetreText").html(response.text);
	    $("#fenetreBottom").html(response.bottom);
	    initFileUploader();
	}
    });
}

function initFileUploader()
{
    var conf = {
	url: "/ajax/upload_image.php?currentTimestamp=" + currentTimestamp + '&userId=' + userId,
	callback: {
	    init: function() {
		var div = $('<div>').html(allowedFileFormatsStr).css('float', 'left').css('margin-left', '10px');
		$('.jcu_toolbar_right').before(div);
	    },
	    queue_upload_end: function() {
		/*
		TO DO:
		insert JS code to execute when file queue uploaded
		*/
	    }
	},
	flash_file: "/js/jcupload/jcupload.swf",
	flash_background: "/js/jcupload/jcu_button.png",
	extensions: ["JPG pictures and ZIP archives (*.jpg;*.zip)|*.zip;*.jpg"],
	file_icon_ready: "/js/jcupload/jcu_file_ready.gif",
	file_icon_uploading: "/js/jcupload/jcu_file_uploading.gif",
	file_icon_finished: "/js/jcupload/jcu_file_finished.gif",
	box_height: 380,
	max_file_size: 20 * 1024 * 1024, // =20MB
	max_queue_count: 99,
	max_queue_size: 50 * 1024 * 1024 // =50MB
    };
    var jcu = $.jcuploadUI(conf);
    jcu.append_to("#jcupload_content");
}

function submitPhotos()
{
    $("#formResult").html('');
    
    var noError = true;
    
    if ($("#parent_id").val() == "")
    {
    	$("#formResult").html(emptyParentMsg);
    	noError = false;
    }
    
    if ($("#linkToGallery" + selectedGallery).parent('li').parent('ul').attr('id') == 'galleryTree0')
    {
    	$("#formResult").html(invalidGallery);
    	noError = false;
    }
    
    if (noError)
    {
        $("#formResult").html('<div class="spinner_small">&nbsp;</div>');
        
    	$.ajax({
		    type :'post',
		    url: '/ajax/save_photos.php',
		    data: $('#fenetre form').serialize(),
		    dataType: 'json',
		    success: function(response){
			if (response.success == 1)
			    $.modal.close();
			else
			    $("#formResult").html(response.errors);
		    }
		});
    }
}

function changePassword()
{
    $('#fenetre').modal({close: false});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
	type: 'post',
	dataType: 'json',
	url: '/ajax/change_password.php',
	success: function(response) {
	    $("#fenetreText").html(response.text);
	    $("#fenetreBottom").html(response.bottom);
	    resizeModal();
	}
    });
}

function savePassword()
{
    $('#fenetre').modal({close: false});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
	type: 'post',
	dataType: 'json',
	url: '/ajax/change_password.php',
	success: function(response) {
	    if (response.success == 1)
		$.modal.close();
	    else
	    {
		$("#formResult").html(response.message);
		resizeModal();
	    }
	}
    });
}