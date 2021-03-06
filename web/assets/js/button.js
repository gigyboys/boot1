$(function() {
    var dd_src = $('.dd_src');
    var dd_target = $('.dd_target');
    var link = $('.link');
    
    $(document).click(function() {
        var dd_target = $('.dd_target');
        dd_target.hide();
    });
    
    dd_src.live('click', function(e) {
        var $this = $(this);
        e.stopPropagation(); 
        e.preventDefault(true);
        
        var dd_target = $('.dd_target');
        
        var dd_target_to = $this.closest(".dd").find(".dd_target");
        if(dd_target_to.css('display') == 'none'){
            dd_target.hide();
            dd_target_to.css('display','block').css('margin-left',0);
            var decalage = $(window).width() - dd_target_to.width() - dd_target_to.offset().left - 10; 
            if (decalage < 0){
                dd_target_to.css('margin-left',decalage);
            }
			
			$(window).resize(function() {
				var decalage = $(window).width() - dd_target_to.width() - $this.offset().left - 10; 
				if (decalage < 0){
					dd_target_to.css('margin-left',decalage);
				}else{
					dd_target_to.css('margin-left',0);
				}
			});
        }
        else{
            dd_target.hide();
            dd_target_to.hide();
        }
    });
    
    dd_target.live('click', function(e) {
        e.stopPropagation(); 
        return false;      
    });
    
    link.click(function(e) {
        window.location=$(this).attr("href");
    }); 
    
});