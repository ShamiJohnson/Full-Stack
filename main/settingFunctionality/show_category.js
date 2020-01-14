
$(document).ready(function() {

    // Datatables
    // $('#assetTable').DataTable();

   // Edit Asset
  $(".editBtn").on("click", function() {
    $("#editModal").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();

    // console.log(data);
    $('#AssetID').val(data[0]);
    $('#Asset').val(data[1]);
  });

  // Delete Asset
  $(".deleteBtn").on("click", function() {
    $("#deleteModal").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();

    // console.log(data);

    $('#deleteid').val(data[0]);

    });



  // make Visible
  $(".makeVisibleModalBtn").on("click", function() {
    $("#makeVisibleModal").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    // console.log(data);

    $('#showCategory').val(data[0]);

  });


});
