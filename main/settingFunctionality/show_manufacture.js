
$(document).ready(function() {

    // Datatables
    // $('#assetTable').DataTable();

   // Edit Asset 
  $(".editBtnManu").on("click", function() {
    $("#editModalManu").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();

    // console.log(data);

    $('#ManuID').val(data[0]);
    $('#AssetManu').val(data[1]);
  });

  // Delete Asset
  $(".deleteBtnManu").on("click", function() {
    $("#deleteModalManu").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();

    // console.log(data);
    
    $('#deleteidManu').val(data[0]);
    
    });


  // make Visible
  $(".makeVisibleModalBtn_Manufacture").on("click", function() {
    $("#makeVisibleModal_Manufacture").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    // console.log(data);

    $('#showManufacture').val(data[0]);

  });









});
