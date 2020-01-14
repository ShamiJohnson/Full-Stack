
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

    $('#update_id').val(data[0]);
    $('#categoryselect').val(data[1]);
    $('#manufacturerselect').val(data[2]);
    $('#serialnumber').val(data[3]);
    $('#modelselect').val(data[4]);
    $('#purchasedate').val(data[5]);
    $('#warranty').val(data[6]);
    $('#user').val(data[7]);
    $('#loc').val(data[8]);
    $('#notes').val(data[9]);
    
    
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


});
