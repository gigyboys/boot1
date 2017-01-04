$(function() {
	console.log('header');
	
	var search_entity_item = $('.search_entity_item');
	var search_entity_content = $('.search_entity_content');
	
	search_entity_item.live('click', function(e) {
        search_entity_item.removeClass('selected');
        $(this).addClass('selected');
		
		search_entity_content.css('display','none');
		var content = $("#search_critere_"+$(this).data("entity"));
		content.css('display','block');
		
    });
	
	$( "#search_submit_button_go" ).click(function() {
		var target = $(this).data("target");
		var critere = "";
		var entity = $(".search_entity_item.selected").data("entity");
		var q = "";
		switch (entity) {
			case "sl":
				critere = "entity=school";
				q = $("#q_"+entity).val();
				critere = critere+"&q="+q;
				break;
			case "bg":
				critere = "entity=new";
				q = $("#q_"+entity).val();
				critere = critere+"&q="+q;
				break;
			case "at":
				critere = "entity=advert";
				q = $("#q_"+entity).val();
				critere = critere+"&q="+q;
				break;
		}
		console.log(critere);
		if(q == ""){
			alert("Ne pas laisser le critère de recherche à vide.");
		}else{
			window.location=target+"?"+critere;
		}
	});
});
