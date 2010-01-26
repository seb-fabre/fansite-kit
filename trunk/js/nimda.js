function resizeModal()
{
    $('#simplemodal-container, #simplemodal-container *').css('height', 'auto');
    if ($('#simplemodal-container').height() > 500)
	$('#simplemodal-container').css('height', '500px');
}

function editTranslations()
{
    $('#fenetre').modal({close: false});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      url: '/ajax/edit_translations.php',
      success: function(response) {
        $("#fenetreText").html(response.text);
        $("#fenetreBottom").html(response.bottom);
	$('#translationsForm').css('height', '320px')
	    .css('margin-top', '10px')
	    .css('overflow-y', 'scroll');
      }
    });
}

function changeLanguage()
{
  $("#translationsForm form").html('<div class="spinner_small">&nbsp;</div>');
  $.ajax({
    type: 'post',
    data: {lan: $('#selectLanguage').val()},
    dataType: 'json',
    url: '/ajax/get_translations.php',
    success: function(response) {
	$("#translationsForm form").html(response.text);
	$.each(response.data, function(key, value) {
	    var input = $('<input type="text" name="' + key + '" size="50" />');
	    input.val(value);
	    var p = $('<p>');
	    var label = $('<label>' + key + '</label>');
	    label.appendTo(p);
	    input.appendTo(p);
	    p.appendTo($("#translationsForm form"));
	});
    }
  });
}

function saveTranslations()
{
    var data = $("#translationsForm form").serialize();
    $('#fenetre').modal({close: false});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: data,
      url: '/ajax/save_translations.php',
      success: function(response) {
        $("#fenetreText").html(response.text);
      }
    });
}

var configJson = '';

function editConfig()
{
    $('#fenetre').modal({close: false});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {},
      url: '/ajax/get_config.php',
      success: function(response) {
        $("#fenetreText").html(response.text);
        $("#fenetreBottom").html(response.bottom);
	c = 0;
	configJson = response.json;
	loadConfigData();
	$('#configForm').css('height', '320px')
	    .css('margin-top', '10px')
	    .css('overflow-y', 'scroll');
      }
    });
}

function makeColorpicker(elem)
{
    elem.ColorPicker({
	color: '#' + elem.val(),
	onShow: function (colpkr) {
	    $(colpkr).fadeIn(500);
	    return false;
	},
	onHide: function (colpkr) {
	    $(colpkr).fadeOut(500);
	    return false;
	},
	onChange: function (hsb, hex, rgb) {
	    elem.val('#' + hex);
	}
    });
}

function saveConfig()
{
    var data = $("#configForm form").serialize();
    $('#fenetre').modal({close: false});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
	type: 'post',
	dataType: 'json',
	data: data,
	url: '/ajax/save_config.php',
	success: function(response) {
	    $.modal.close();
	}
    });
}

function loadConfigData()
{
    $("#configForm form").html('');
    $.each(configJson, function(key, data) {
	var p = $('<p>');
	var label = $('<label>' + data.desc + '</label>');
	label.appendTo(p);
	if (data.type == 'string' || data.type == 'enum')
	{
	    var input = $('<input type="text" name="' + key + '" size="50" />');
	    input.val(data.value);
	    input.appendTo(p);
	}
	else if (data.type == 'bool')
	{
	    var select = $('<select name="' + key + '"><option value="1">yes</option><option value="0">no</option></select>');
	    select.val(data.value);
	    select.appendTo(p);
	}
	else if (data.type == 'color')
	{
	    var input = $('<input type="text" name="' + key + '" size="7" id="color' + c + '" maxlength="7" />');
	    input.val(data.value);
	    input.appendTo(p);
	    makeColorpicker(input);
	    c++;
	}
	p.appendTo($("#configForm form"));
    });
}

function getMembers()
{
    $('#fenetre').modal({close: false});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {},
      url: '/ajax/get_members.php',
      success: function(response) {
        $("#fenetreText").html(response.text);
        $("#fenetreBottom").html(response.bottom);
	$('table.scroll').scrolltable({tbody_height: 380});
      }
    });
}

function editMember(id)
{
    $("#small_loading").html('<div class="spinner_small">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {id: id},
      url: '/ajax/edit_member.php',
      success: function(response) {
	$('.trForm').remove();
	var tr = $('<tr class="trForm">');
	var td = $('<td colspan="' + $('#row_' + id + ' td').size() + '" class="tdForm"></td>');
	td.appendTo(tr);
	td.html(response.html);
	tr.css('width', $('#row_' + id).width());
	$('#row_' + id).after(tr);
	$("#small_loading").html('');
	tr.find('form').slideDown("slow");
      }
    });
}

function saveMember()
{
    $("#small_loading").html('<div class="spinner_small">&nbsp;</div>');
    $('.trForm form .formError').remove();
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: $('.trForm form').serialize(),
      url: '/ajax/save_member.php',
      success: function(response) {
	$("#small_loading").html('');
	var form = $('.trForm form');
	if (response.success == 1)
	{
	    var login = form.find('input[name=login]').val();
	    var id = form.find('input[name=id]').val();
	    $('#row_' + id + ' td:eq(0)').html(login);
	    discardChangesMember();
	}
	else
	{
	    $.each(response.errors, function(i){
		var input = form.find('input[name=' + i + ']');
		var p = input.parents('p');
		var newp = $('<p class="formError">').html(response.errors[i]);
		p.after(newp);
	    });
	}
      }
    });
}

function discardChanges()
{
    $('.trForm form').slideUp("slow", function() {
	$('.trForm').remove();
    });
}

function deleteMember(id)
{
    if (confirm(deleteMemberStr))
	_deleteMember(id);
}

function _deleteMember(id)
{
    $("#small_loading").html('<div class="spinner_small">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {id: id},
      url: '/ajax/delete_member.php',
      success: function(response) {
        $('#row_' + id).fadeOut("slow", function(){$('#row_' + id).remove()});
	$("#small_loading").html('');
      }
    });
}

function disableMember(id)
{
    if (confirm(disableMemberStr))
	_disableMember(id);
}

function _disableMember(id)
{
    $("#small_loading").html('<div class="spinner_small">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {id: id},
      url: '/ajax/disable_member.php',
      success: function(response) {
	$('#row_' + id).html($('#row_' + id).html().replace(/disableMember/g, 'enableMember'));
	$('#row_' + id).html($('#row_' + id).html().replace(/enabled/g, 'disabled'));
	$('#row_' + id).html($('#row_' + id).html().replace(new RegExp(titleDisableStr, "g"), titleEnableStr));
	$("#small_loading").html('');
      }
    });
}

function enableMember(id)
{
    if (confirm(enableMemberStr))
	_enableMember(id);
}

function _enableMember(id)
{
    $("#small_loading").html('<div class="spinner_small">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {id: id},
      url: '/ajax/enable_member.php',
      success: function(response) {
	$('#row_' + id).html($('#row_' + id).html().replace(/enableMember/g, 'disableMember'));
	$('#row_' + id).html($('#row_' + id).html().replace(/disabled/g, 'enabled'));
	$('#row_' + id).html($('#row_' + id).html().replace(new RegExp(titleEnableStr, "g"), titleDisableStr));
	$("#small_loading").html('');
      }
    });
}

function isadminMember(id)
{
    if (confirm(isadminMemberStr))
	_isadminMember(id);
}

function _isadminMember(id)
{
    $("#small_loading").html('<div class="spinner_small">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {id: id},
      url: '/ajax/isadmin_member.php',
      success: function(response) {
	$('#row_' + id).html($('#row_' + id).html().replace(/isnotadmin/g, 'isadmin'));
	$('#row_' + id).html($('#row_' + id).html().replace(/isadminMember/g, 'isnotadminMember'));
	$('#row_' + id).html($('#row_' + id).html().replace(new RegExp(titleMakeAdminStr, "g"), titleMakeNotAdminStr));
	$("#small_loading").html('');
      }
    });
}

function isnotadminMember(id)
{
    if (confirm(isnotadminMemberStr))
	_isnotadminMember(id);
}

function _isnotadminMember(id)
{
    $("#small_loading").html('<div class="spinner_small">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {id: id},
      url: '/ajax/isnotadmin_member.php',
      success: function(response) {
	$('#row_' + id).html($('#row_' + id).html().replace(/isadmin/g, 'isnotadmin'));
	$('#row_' + id).html($('#row_' + id).html().replace(/isnotadminMember/g, 'isadminMember'));
	$('#row_' + id).html($('#row_' + id).html().replace(new RegExp(titleMakeNotAdminStr, "g"), titleMakeAdminStr));
	$("#small_loading").html('');
      }
    });
}

function getNews()
{
    $('#fenetre').modal({close: false});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {},
      url: '/ajax/get_news.php',
      success: function(response) {
        $("#fenetreText").html(response.text);
        $("#fenetreBottom").html(response.bottom);
	$('table.scroll').scrolltable({tbody_height: 380});
      }
    });
}

function editNews(id)
{
    $("#small_loading").html('<div class="spinner_small">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {id: id},
      url: '/ajax/edit_news.php',
      success: function(response) {
	$('.trForm').remove();
	var tr = $('<tr class="trForm">');
	var td = $('<td colspan="' + $('#row_' + id + ' td').size() + '" class="tdForm"></td>');
	td.appendTo(tr);
	td.html(response.html);
	tr.css('width', $('#row_' + id).width());
	$('#row_' + id).after(tr);
	$("#small_loading").html('');
	tr.find('form').slideDown("slow");
      }
    });
}

function saveNews()
{
    $("#small_loading").html('<div class="spinner_small">&nbsp;</div>');
    $('.trForm form .formError').remove();
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: $('.trForm form').serialize(),
      url: '/ajax/save_news.php',
      success: function(response) {
	$("#small_loading").html('');
	var form = $('.trForm form');
	if (response.success == 1)
	{
	    $('#row_' + id + ' td:eq(0)').html(response.newdate);
	    $('#row_' + id + ' td:eq(1)').html(response.newtitle);
	    discardChanges();
	}
	else
	{
	    $.each(response.errors, function(i){
		var input = form.find('input[name=' + i + ']');
		var p = input.parents('p');
		var newp = $('<p class="formError">').html(response.errors[i]);
		p.after(newp);
	    });
	}
      }
    });
}

function getVideos()
{
    $('#fenetre').modal({close: false});
    $('#fenetreText').html('<div class="spinner">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {},
      url: '/ajax/get_videos.php',
      success: function(response) {
        $("#fenetreText").html(response.text);
        $("#fenetreBottom").html(response.bottom);
	$('table.scroll').scrolltable({tbody_height: 380});
      }
    });
}

function editVideo(id)
{
    $("#small_loading").html('<div class="spinner_small">&nbsp;</div>');
    $.ajax({
      type: 'post',
      dataType: 'json',
      data: {id: id},
      url: '/ajax/edit_video.php',
      success: function(response) {
	$('.trForm').remove();
	var tr = $('<tr class="trForm">');
	var td = $('<td colspan="' + $('#row_' + id + ' td').size() + '" class="tdForm"></td>');
	td.appendTo(tr);
	td.html(response.html);
	tr.css('width', $('#row_' + id).width());
	$('#row_' + id).after(tr);
	$("#small_loading").html('');
	tr.find('form').slideDown("slow");
      }
    });
}

