$(document).ready(function () {

	$( "#sortable1, #sortable2" ).sortable({
		connectWith: ".connectedSortable",
		receive:function (event, ui) {
			if($(ui.item).parent().attr('id') == 'sortable1') {
             var menuId = $("#FoodMenuMenusFoodMenuCategoriesMenuID").val();
             var categoryId = $(ui.item).attr('id');
             addMenuCategories(categoryId, menuId);
             }
            if($(ui.item).parent().attr('id') == 'sortable2') {
             var menuId = $("#FoodMenuMenusFoodMenuCategoriesMenuID").val();
             var categoryId = $(ui.item).attr('id');
             deleteMenuCategories(categoryId, menuId);
            }
        }
	});
});

function addMenuCategories(categoryId, menuId) {
    var request = $.ajax({
        url:window.app.webroot + "plugin/FoodMenu/FoodMenuMenusFoodMenuCategories/add/" + categoryId + "/" + menuId,
        type:"POST",
        context:document.body
    });
}

function deleteMenuCategories(categoryId, menuId) {
    var request = $.ajax({
        url:window.app.webroot + "plugin/FoodMenu/FoodMenuMenusFoodMenuCategories/delete/" + categoryId + "/" + menuId,
        type:"POST",
        context:document.body
    });
}