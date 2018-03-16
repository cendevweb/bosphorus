$(document).ready(function(){


 var sousmenu = $("#sousmenu");
 var liMenu = sousmenu.parent('li');
 var h3Link = $(".display").children('h3');

var padd = liMenu.outerWidth()-liMenu.width();
var liWidth = liMenu.width()+padd;
var submit = $("#submit");
var rechercher =$("#bosphorus_bosphorusbundle_recherche_recherche");
submit.css({"width": submit.outerHeight()});
submit.css({"left": rechercher.outerWidth()+submit.width()});
function openmenu(){
	sousmenu.css({
		"display" : "block",
		"border-top" : "1px solid #1b1b1b",
		"width" : liWidth
	});
}


function closemenu(){
	sousmenu.css({
		"display" : "none"
	});
}


function displayInfo(pThis){
	pThis.parent($(".display")).children().not('h3').css({"display" : "block"});
	var thisDisplay = pThis.parent($(".display"));
	thisDisplay.parent('div').find(".display").not(thisDisplay).children().not('h3').css({"display" : "none"});
}

/*	function resetHeight(pThis){
				pThis.children().stop().animate({
					"display" : "none"
				},500);
				
	}*/


/* 	RANGE TYPE SCRIPT 	*/
var range = $('.input-range'),
    value = $('.range-value');
    
value.html(range.attr('value'));

range.on('input', function(){
    value.html(this.value);
}); 
/* END RANGE TYPE SCRIPT	*/

liMenu.on("mouseenter", function(){
	openmenu();
});

liMenu.on("mouseleave", function(){
	closemenu();
});

h3Link.on("click", function(){
	displayInfo($(this));
});


/* AUTO TOP VALUE FOR SEARCHBAR */


var barHeight = $("#headright").height();

var bandeHeight = $("#bandeau").height();
console.log(bandeHeight);
function calcTop (){
	var topValue = (barHeight/2);
	$("#headright").css({"top" : topValue});
	console.log(topValue);
}
calcTop();


});