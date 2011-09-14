/* 
Author: Creative group Reality http://realitygroup.ru
*/

$(function(){
	Cufon.replace('.font-replace', { fontFamily: 'Myriad Pro Regular', textShadow: '1px 1px 1px #eee', hover: true });
	Cufon.now();
	
	$('div.business-nav-box').hover(function() {
		$('div.new-bg', $(this)).slideUp(600, 'easeInOutExpo');
	}, function() {
		$('div.new-bg', $(this)).slideDown(600, 'easeInOutExpo');
	});
});