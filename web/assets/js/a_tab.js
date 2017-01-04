
$(function() {
	console.log("inittab");
	var a_content_tab_header_item = $('.a_content_tab_header_item');
	var a_content_tab_content_item = $('.a_content_tab_content_item');
	var a_content_tab_header_content = $('.a_content_tab_header_content');
	var a_content_tab_header_sep_slide = $('.a_content_tab_header_sep_slide');
	
	a_content_tab_header_item.live('click', function(e) {
        a_content_tab_header_item.removeClass('selected').removeClass('not_selected').addClass('not_selected');
        $(this).addClass('selected').removeClass('not_selected');
		var this_id = $(this).attr('id');
		var content = $("#content_"+this_id);
		a_content_tab_content_item.removeClass('selected').removeClass('not_selected').addClass('not_selected');
		
		content.addClass('selected').removeClass('not_selected');
		var decalage = $('.a_content_tab_header_content .selected').offset().left - a_content_tab_header_content.offset().left;
		console.log(decalage);
		a_content_tab_header_sep_slide.animate({
			marginLeft: decalage
			}, 300, function() {
		});
		a_content_tab_header_sep_slide.width($('.a_content_tab_header_content .selected').outerWidth(true));
		
    });
	function initTab(){
		a_content_tab_header_sep_slide.width($('.a_content_tab_header_content .selected').outerWidth(true));
	}	
    initTab();
	
});