
$(function() {
	console.log("inittabuser");
	var tab_ur_item = $('.tab_ur_item');
	var content_tab_ur_item = $('.content_tab_ur_item');
	
	tab_ur_item.live('click', function(e) {
        tab_ur_item.removeClass('selected');
        $(this).addClass('selected');
		var this_id = $(this).attr('id');
		var content = $("#content_"+this_id);
		content_tab_ur_item.removeClass('selected').css('display','none');
		
		content.addClass('selected').css('display','block');
		console.log($(this).data("link"));
		document.title = $(this).data("title");
		history.pushState('', '', $(this).data("link"));
		
    });
	
	//mise a jour de common information.
	$('#form_ur_common').submit( function(e){
		e.preventDefault();
		$('#btn_save_ur_common').trigger('click');
	});
	
	$('#btn_save_ur_common').on('click', function(){
        var $this = $(this);
		var bloc_editable = $this.closest(".bloc_editable");
        var target = $this.data('target');
		console.log(target);
		var data = {
			name : bloc_editable.find("#ur_input_name").val(), 
			username : bloc_editable.find("#ur_input_username").val(), 
			location : bloc_editable.find("#ur_input_location").val(), 
			email : bloc_editable.find("#ur_input_email").val()
		};
		loadBlocEdit(bloc_editable);
        $.ajax({
            type: 'POST',
            url: target,
            data: data,
            dataType : 'json',
            success: function(data){
                console.log(data.state);
				if(data.state){
					bloc_editable.find("#ur_view_name").text(data.name);
					bloc_editable.find("#ur_view_username").text(data.username);
					bloc_editable.find("#ur_view_location").text(data.location);
					bloc_editable.find("#ur_view_email").text(data.email);
					resetBlocEdit(bloc_editable);
					document.title = data.title;
					history.pushState('', 'Profile '+data.username, data.url);
					$("#profil_link").attr("href", data.url);
				}
				else{
					editBlocEdit(bloc_editable);
					alert(data.message);
				}
				bloc_editable.find(".btn_loading").hide();
            },
            error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.status);
				console.log(textStatus);
				console.log(errorThrown);
				bloc_editable.find(".btn_loading").hide();
			}
        });
    });
	
    /*
    *upload avatar for user
    */
    $('#avatarfile').on('change', function(){
		/*console.log("change avatar");*/
        var $this = $(this);
        var file = $this[0].files[0];
        var target = $this.data('target');
        var data = new FormData();
		console.log(target);
        data.append('file', file);
		//console.log(data);
		
        $.ajax({
            type: 'POST',
            url: target,
            data: data,
            contentType: false,
            processData: false,
            dataType : 'json',
            success: function(data){
                console.log(data.avatar32x32);
                console.log(data.avatar80x80);
				$("#avatar_banner").attr("src", data.avatar32x32);
				$("#user_avatar").attr("src", data.avatar80x80);
            },
            error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.status);
				console.log(textStatus);
				console.log(errorThrown);
			}
        });
    });
	
});