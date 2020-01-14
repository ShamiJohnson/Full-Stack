
$(document).ready(function() {
   // Edit Asset
  $(".editBtn_Display").on("click", function() {
    $("#displayEdit_Display").modal("show");

    $tr= $(this).closest('tr');
    var data = $tr.children("td").map(function(){
        return $(this).text();
    }).get();

    // console.log(data);

    $('#DisplayName').val(data[0]);
    $('#Display').val(data[1]);
  });
});
