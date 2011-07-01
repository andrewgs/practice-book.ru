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
});
