
$(document).ready(function() {

    // Datatables
    // $('#assetTable').DataTable();

   // Edit Asset
  $(".editBtn_Models").on("click", function() {

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();

    // console.log(data);
    
    $('#ModelIDdisplay').val(data[0]);
    $('#AssetdisplayModel').val(data[1]);
    $('#VisibleModel').val(data[4]);

    $.get("settingFunctionality/dynamic_model_edit.php?id=" + $('#ModelIDdisplay').val(), function (result) {
    console.log(result);
        let $editModal = $("#myFormModelTWODynamic");
        $editModal.html(result);
        $editModal.find("select").selectize();
        
    }).fail(function (result){doError("An error occured contacting the server. Please check your internet connection or reload the page."); console.log(result);});


    $("#editModalModelDisplay").modal("show");
  });

  // Delete Asset
  $(".deleteBtnModel").on("click", function() {
    $("#deleteModalModel").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();

    // console.log(data);

    $('#deleteidModel').val(data[0]);

    });





    // make Visible
    $(".makeVisibleModalBtn_Model").on("click", function() {
        $("#makeVisibleModal_Model").modal("show");

        $tr= $(this).closest('tr');
        var data = $tr.children("td").map(function(){
            return $(this).text();
        }).get();

        // console.log(data);

        $('#showVisible_Model').val(data[0]);

    });







});
