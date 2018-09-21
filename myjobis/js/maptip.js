this.screenshotPreview = function(){	
	/* CONFIG */
		
		yOffset = -39;
		xOffset = -12;
		
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
		
	/* END CONFIG */
	$("area.screenshot").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<p id='screenshot' class='arrow_box'>"+ this.alt + c +"</p>");
		$("#screenshot")
			.css("top",(e.pageY - $('#screenshot').height() + yOffset) + "px")
			.css("left",(e.pageX - $('#screenshot').width()/2 + xOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#screenshot").remove();
    });	
	$("area.screenshot").mousemove(function(e){
		$("#screenshot")
			.css("top",(e.pageY - $('#screenshot').height() + yOffset) + "px")
			.css("left",(e.pageX - $('#screenshot').width()/2 + xOffset) + "px");
	});			
};


// starting the script on page load
$(document).ready(function(){
	screenshotPreview();
});
