function confirmDelete() {
	if(countChecked() > 0) {
		Check = confirm('Do you really want to delete the selection');
		if(Check == true) {
			if($('#FoodMenuMenuIndexForm').length > 0) {
   			document.forms["FoodMenuMenuIndexForm"].submit();
   			}
   			if($('#FoodMenuMenuAdminForm').length > 0) {
   			document.forms["FoodMenuMenuAdminForm"].submit();
   			}
   			if($('#FoodMenuCategoryIndexForm').length > 0) {
   			document.forms["FoodMenuCategoryIndexForm"].submit();
   			}
   			if($('#FoodMenuEntryIndexForm').length > 0) {
   			document.forms["FoodMenuEntryIndexForm"].submit();
   			}
   			
		}	
	}
}

function countChecked() {
  	var n = $("input:checked").length;
	return n;
}

$(document).ready(function () {
	/*$(".foodmenu-overlay").fancybox({
        'type':'iframe',
        'width':'90%',
        'height':'90%',
        'onClosed':function () {
            window.location.reload(true);
        }
	}*/
	
});