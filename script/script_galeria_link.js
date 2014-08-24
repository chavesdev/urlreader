$(document).ready(function() {

	
	
	//After that, the following script will set the width and height accordingly
	$('#mask-gallery, #gallery li').width($('#slider').width());	
	$('#gallery').width($('#slider').width() * $('#gallery li').length);
	$('#mask-gallery, #gallery li, #mask-excerpt, #excerpt li').height($('#slider').height());
	
	//Assign a timer, so it will run periodically	
	
	$('#gallery li:first, #excerpt li:first').addClass('selected');

	
	//Next Slide by calling the function
	$('#btn-next').click(function () {
		newsscoller(0);	
		return false;
	});	

	//Previous slide by passing prev=1
	$('#btn-prev').click(function () {
		newsscoller(1);	
		return false;
	});	
	
	
});


function newsscoller(prev) {
	$("div#contador").text("");
	//Get the current selected item (with selected class), if none was found, get the first item
	var current_image = $('#gallery li.selected').length ? $('#gallery li.selected') : $('#gallery li:first');
	
	//if prev is set to 1 (previous item)
	if (prev) {
		
		//Get previous sibling
		var next_image = (current_image.prev().length) ? current_image.prev() : $('#gallery li:last');
	
	//if prev is set to 0 (next item)
	} else {
		
		//Get next sibling
		var next_image = (current_image.next().length) ? current_image.next() : $('#gallery li:first');
	}

	//clear the selected class
	$('#gallery li').fadeOut("slow");
	
	$('#gallery li').removeClass('selected');
	
	//reassign the selected class to current items
	next_image.addClass('selected');
	next_image.fadeIn("slow");
	
	var id_proximo = $("#gallery li.selected").attr("id");
	id_proximo++;
	
	var selector = id_proximo+" de "+tam;
	$("#contador").text(selector);
	//Scroll the items					
	
}
