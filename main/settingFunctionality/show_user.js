
$(document).ready(function() {

  // Datatables
  // $('#assetTable').DataTable();

  // Edit Asset
  $(".editBtn_User").on("click", function() {
    $("#displayEdit_User").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    // console.log(data);

    $('#user_ID').val(data[0]);
    $('#user_Fname').val(data[1]);
    $('#user_lName').val(data[2]);
    $('#user_Email').val(data[3]);
    $('#user_Phone').val(data[4]);
    $('#user_Location').val(data[5]);
  });

  // Delete Asset
  $(".deleteBtn_User").on("click", function() {
    $("#displayDelete_User").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    // console.log(data);

    $('#deleteidUSER').val(data[0]);

  });






  // make Visible
  $(".makeVisibleModalBtn_User").on("click", function() {
    $("#makeVisibleModal_User").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
      return $(this).text();
    }).get();

    // console.log(data);

    $('#showUSER_').val(data[0]);

  });







});
