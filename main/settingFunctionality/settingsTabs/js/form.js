/*
 TITLE: form.js
 AUTHOR: Ehtsham Nisar (EN)
 CREATE DATE: 8 December 2018
 PURPOSE: create a form.js file to write on web page
 LAST MODIFIED ON: 8 December 2018
 LAST MODIFIED BY: Ehtsham Nisar (EN)
 MODIFICATION HISTORY:
 8 December 2018: created form.js (EN)

 */




/***
 Name:
    $(document).ready(function()
 Purpose:
 The purpose of this function is to add functionality on the webpage
  
 Parameters:
    N/A
 Return:
    N/A
 
 ***/
$(document).ready(function() {


//i will get only hours 1-12 from this 
$( "#spinner" ).spinner({ min: 0 });
$( "#spinner" ).spinner({ max: 12 });

/***
 Purpose:the purpose of this function is to reduce user error. this function does not let there be a letter  
 Parameters:
    N/A
 Return:
    N/A
 ***/
$( "#spinner").keyup(function() {
            if(  isNaN ($(this).val() )){ 
            //numbers  between 1-12 will be displayed
                $(this).prop("value", "1") ; //if the user tries to enter a letter then the value will be changed to 1
            }
      });








  //function calls for mouse activities 
$("#submit").mouseenter(run_MouseEnter);
 //function calls for mouse activities 
$("#Reset").mouseenter(run_MouseEnter);
 $("#Reset").mouseleave(run_MouseLeave);


/***
 Name:run_MouseEnter
 Purpose:if the user hovers over the element then the background color will change. 
 Parameters:
    N/A
 Return:
    N/A
 
 ***/
function run_MouseEnter(){
        $(this).css("background-color", "orange");
    };


/***
 Name:run_MouseLeave
 Purpose:if the user leaves the targetted elemant then the text's background will change color 
 Parameters:
    N/A
 Return:
    N/A
 
 ***/
 $("#submit").mouseleave(run_MouseLeave);
    function run_MouseLeave(){
        $(this).css("background-color", "#4CAF50");
    };





///////////////////////////////// Downloded widget code and edited it ////////////////////////////////////

$( "#accordion" ).accordion();


//gives users option to enter am or pm
var availableTags = [
  "am",
  "pm"
];
$( "#autocomplete" ).autocomplete({
  source: availableTags
});



$( "#button" ).button();
$( "#button-icon" ).button({
  icon: "ui-icon-gear",
  showLabel: false
});



$( "#radioset" ).buttonset();



$( "#controlgroup" ).controlgroup();



$( "#tabs" ).tabs();



$( "#dialog" ).dialog({
  autoOpen: false,
  width: 400,
  buttons: [
    {
      text: "Ok",
      click: function() {
        $( this ).dialog( "close" );
      }
    },
    {
      text: "Cancel",
      click: function() {
        $( this ).dialog( "close" );
      }
    }
  ]
});

// Link to open the dialog
$( "#dialog-link" ).click(function( event ) {
  $( "#dialog" ).dialog( "open" );
  event.preventDefault();
});



$( "#datepicker" ).datepicker({
  inline: true
});



$( "#slider" ).slider({
  range: true,
  values: [ 17, 67 ]
});



$( "#progressbar" ).progressbar({
  value: 20
});



$( "#spinner" ).spinner();



$( "#menu" ).menu();



$( "#tooltip" ).tooltip();



$( "#selectmenu" ).selectmenu();


// Hover states on the static widgets
$( "#dialog-link, #icons li" ).hover(
  function() {
    $( this ).addClass( "ui-state-hover" );
  },
  function() {
    $( this ).removeClass( "ui-state-hover" );
  }
);





});







