
$(function() {
	console.log("at.js");
	
	$('.btn_at_new_cmt').on('click', function(){
        var $this = $(this);
        var target = $this.data('target');
		console.log(target);
		var data = {
			message : $("#at_cmt_message").val()
		};
		//loadBlocEdit(bloc_editable);
        $.ajax({
            type: 'POST',
            url: target,
            data: data,
            dataType : 'json',
            success: function(data){
                console.log(data.state);
				if(data.state){
					$("#at_list_cmt").append(data.commentItem);
					$("#at_cmt_message").val("");
					$("#info_comment").html(data.infoComment);
				}
				else{
					alert("une erreur est survenue");
				}
            },
            error: function(jqXHR, textStatus, errorThrown) {
				console.log(jqXHR.status);
				console.log(textStatus);
				console.log(errorThrown);
			}
        });		
    });
	
});