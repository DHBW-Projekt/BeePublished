$(document).ready(function () {

	$( "#sortable1, #sortable2" ).sortable({
		connectWith: ".connectedSortable",
		receive:function (event, ui) {
			if($(ui.item).parent().attr('id') == 'sortable1') {
             var categoryId = $("#FoodMenuCategoriesFoodMenuEntriesCategoryID").val();
             var entryId = $(ui.item).attr('id');
             addCategoryEntries(entryId, categoryId);
             }
            if($(ui.item).parent().attr('id') == 'sortable2') {
             var categoryId = $("#FoodMenuCategoriesFoodMenuEntriesCategoryID").val();
             var entryId = $(ui.item).attr('id');
             deleteCategoryEntries(entryId, categoryId);
            }
        }
	});
});

function addCategoryEntries(entryId, categoryId) {
    var request = $.ajax({
        url:window.app.webroot + "plugin/FoodMenu/FoodMenuCategoriesFoodMenuEntries/add/" + entryId + "/" + categoryId,
        type:"POST",
        context:document.body
    });
}

function deleteCategoryEntries(entryId, categoryId) {
    var request = $.ajax({
        url:window.app.webroot + "plugin/FoodMenu/FoodMenuCategoriesFoodMenuEntries/delete/" + entryId + "/" + categoryId,
        type:"POST",
        context:document.body
    });
}