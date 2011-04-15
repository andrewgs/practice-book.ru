/* 
Author: Creative group Reality http://realitygroup.ru
*/

$(function(){
    
	$('.region-titles a').hover(
		function(){lightRegion(this.id);},function(){hideRegion(this.id);}
	);

	$('#rusmap area').hover(
		function(){
			lightRegion('lnk-'+this.id);},function(){hideRegion('lnk-'+this.id);
		}
	);
    
	$('.point').hover(
		function(){lightRegion('regio'+this.id);},function(){hideRegion('regio'+this.id);}
	);

	function lightRegion(region) {
		log(region);
		if (region && document.getElementById(region)) {
			$("#"+region).addClass('map');
		}
		if (region) {
			document.getElementById('region_image').style.backgroundImage = 'url(regions/' + region + '.gif)';
		}
	}

    function lightPoint(region) {
		if (region && document.getElementById(region)) {
			document.getElementById(region).className ='hover';
		}
		if (region) {document.getElementById('region_image').style.backgroundImage = 'url(../regions/' + region + '.gif)';}
	}

	function hideRegion(region) {
		if (region && document.getElementById(region)) {
			$("#"+region).removeClass('map');
		}
		if (!$.browser.opera){
			document.getElementById('region_image').style.backgroundImage = 'url(../images/blank.gif)';
		}
	}
	
	$("#sel-region").sexyCombo({
		emptyText: "",
		autoFill: true,
		skin: "custom"
	});	
	
	$("#sel-field").sexyCombo({
		emptyText: "",
		autoFill: true,
		skin: "custom"
	});		
	
	function animateSlides() {
		setTimeout(function() {
			$("#slide-1").animate({ opacity: '0' }, 3000, function() {});
			$("#slide-2").animate({ opacity: '1.0' }, 3000, function() {});
		}, 3000);
		setTimeout(function() {
			$("#slide-2").animate({ opacity: '0' }, 3000, function() {});
			$("#slide-3").animate({ opacity: '1.0'}, 3000, function() {});
		}, 11000);
		setTimeout(function() {
			$("#slide-3").animate({ opacity: '0' }, 3000, function() {});
			$("#slide-4").animate({	opacity: '1.0' }, 3000, function() {});
		}, 19000);
		setTimeout(function() {
			$("#slide-4").animate({ opacity: '0' }, 3000, function() {});
			$("#slide-1").animate({ opacity: '1.0' }, 3000, function() {});
		}, 27000);		
	}
	
	$("#slide-2, #slide-3, #slide-4").css({'opacity': '0', 'display': 'block'});
	animateSlides();
	setInterval(function(){ animateSlides(); }, 30000);
	
});
