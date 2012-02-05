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
 * @author Alexander Müller & Fabian Kajzar
 * 
 * 
 */

$(document).ready(function () {
    $('.users')
        .sortable({
            appendTo:'body',
            connectWith:'.users',
            opacity: '0.6',
            handler:'.user_detail',
            tolerance:'pointer',
            placeholder:"users-placeholder",
            forcePlaceholderSize:true,
            receive:function (event, ui) {
                var roleId = $(ui.item).parent().attr('rel');
                var userId = $(ui.item).attr('rel');
                updatePicture(roleId, userId);
            }
        });
    $('input#search-users').quicksearch('.user_detail');
    $("a.user_edit").fancybox({
        'type':'iframe',
        width:'90%',
        height:'90%'
    });
    $('a.user_delete').click(function () {
        return confirm('Are you sure?');
    });
});

function updatePicture(galleryId, pictureId) {
	var test = window.app.webroot;
	
    var request = $.ajax({
        url:window.app.webroot + "plugin/gallery/manage_galleries/assignImage/"+ galleryId+ "/" + pictureId,
        type:"POST",
        context:document.body
    });
}