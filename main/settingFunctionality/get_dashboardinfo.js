
$(document).ready(function() {
    // Delete Asset
    $(".deleteBtnModel").on("click", function() {
        $("#deleteModalModel").modal("show");

        $tr= $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        // console.log(data);

        $('#AssetID').val(data[0]);

    });

});
