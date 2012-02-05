/**
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
 * @author Tobias Höhmann
 * 
 * @description javasript file for the email template admin configuration
 */

$(document).ready(function () {
	// Definition for the CKEditor in the Email Template preview view
    $('#EmailTemplatesPreview').ckeditor(function () {
        },
        {
         // ignore global configuration and define own configuration
         customConfig : '',
         readOnly : 'true',
         toolbar : [],
         resize_enabled : false,
         toolbarCanCollapse : false
        });
    // Definition for the CKEditor in the Email Template save view
    $('#EmailTemplateContent').ckeditor(function () {
    	},
    	{   // ignore global configuration and define own configuration
    		customConfig : '',
    	    filebrowserBrowseUrl : '/kcfinder/browse.php?type=files&cms=beepublished',
        	filebrowserImageBrowseUrl : '/kcfinder/browse.php?type=images&cms=beepublished',
        	filebrowserFlashBrowseUrl : '/kcfinder/browse.php?type=flash&cms=beepublished',
        	filebrowserUploadUrl : '/kcfinder/upload.php?type=files&cms=beepublished',
        	filebrowserImageUploadUrl : '/kcfinder/upload.php?type=images&cms=beepublished',
        	filebrowserFlashUploadUrl : '/kcfinder/upload.php?type=flash&cms=beepublished',
    });
});