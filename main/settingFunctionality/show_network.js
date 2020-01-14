
$(document).ready(function() {

    // Datatables
    // $('#assetTable').DataTable();

   // Edit Asset
  $(".editBtnNETWORK").on("click", function() {
    $("#editModalNETWORK").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();

    // console.log(data);

    $('#Network_Name').val(data[0]);
  });

  // Delete Asset
  $(".deleteBtnNETWORK").on("click", function() {
    $("#deleteModalNETWORK").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();

    // console.log(data);

    $('#deleteidNETWORK').val(data[0]);

    });

});

