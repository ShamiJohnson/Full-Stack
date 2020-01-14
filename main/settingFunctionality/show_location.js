
$(document).ready(function() {

    // Datatables
    // $('#assetTable').DataTable();

    // Edit Asset
    $(".editBtn_Location").on("click", function() {
        $("#displayEdit_Location").modal("show");

        $tr= $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        // console.log(data);

        $('#Loc_LocationID').val(data[0]);
        $('#Building_Location').val(data[1]);
        $('#Loc_BuildingNumber').val(data[2]);
    });

    // Delete Asset
    $(".deleteBtn_Location").on("click", function() {
        $("#displayDelete_Location").modal("show");

        $tr= $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        // console.log(data);

        $('#deleteidLocation').val(data[0]);

    });

});
