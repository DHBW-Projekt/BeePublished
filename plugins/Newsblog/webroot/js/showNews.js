/*
* This file is part of BeePublished which is based on CakePHP.
* BeePublished is free software: you can redistribute it and/or
* modify it under the terms of the GNU General Public License
* as published by the Free Software Foundation, either version 3
* of the License, or any later version.
* BeePublished is distributed in the hope that it will be useful, but
* WITHOUT ANY WARRANTY; without even the implied warranty of
* MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
* GNU General Public License for more details.
* You should have received a copy of the GNU General Public
* License along with BeePublished. If not, see
* http://www.gnu.org/licenses/.
*
* @copyright 2012 Duale Hochschule Baden-Württemberg Mannheim
* @author Philipp Scholl
*
* @description JavaScript to configure ckeditor and jQuery UI Datetimepicker
*/

$(document).ready(function () {
	$(".newsblog_entry").mouseenter(function(){
		$('.newsblog_entry_buttons', this).show();
	});
	$(".newsblog_entry").mouseleave(function(){
		$('.newsblog_entry_buttons', this).hide();
	});
	
	$(".overlay").fancybox({
		'type':'iframe',
		'width':'90%',
		'height':'90%',
		'onClosed':function () {
			window.location.reload(true);
		}
	});
	
	$('.newsblogreadconfig_button').click(function(){
		$('.newsblogreadconfig_items').slideToggle('slow', function(){
			var isVisible = $('.newsblogreadconfig_items').is(':visible');
			var isHidden = $('.newsblogreadconfig_items').is(':hidden');
			if( isVisible ){
				$('.newsblogreadconfig_button a').html(window.app.hideConfigText);
			} else if( isHidden ){
				$('.newsblogreadconfig_button a').html(window.app.showConfigText);
			}
		});
	});
	
	$('.newsblogcontainer').jPaginate({
		items: window.app.itemsPerPage,
		minimize: true,
		nav_items: 5,
		next: '>',
		previous: '<',
		equal: false
	});
});