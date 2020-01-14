/*
 TITLE: moverShakers.js
 AUTHOR: Ehtsham Nisar (EN)
 CREATE DATE: 14 November 2018
 PURPOSE: create a moverShakers.js file to write on web page
 LAST MODIFIED ON: 14 November 2018
 LAST MODIFIED BY: Ehtsham Nisar (EN)
 MODIFICATION HISTORY:
 14 November 2018: created moverShakers (EN)
 */




/***
 Name:
    $(document).ready(function()
 Purpose:
 The purpose of this function is to display content with effects on the webpage using jquery 
  
 Parameters:
    N/A
 Return:
    N/A
 
 ***/
$(document).ready(function() {






 /***
 Name: submit()
 Purpose: the purpose of this function is to display text in the output area. later this will be used to collect user's data 
 Parameters:
    N/A
 Return:
    N/A
 ***/

$( "#submit").click( submit );
function submit() {
        $("#textOutput").append(" <br> <b>Hello World!</b>");
    } 

/***
 Name:run_MouseEnter
 Purpose:if the user hovers over the element then the background color will change. 
 Parameters:
    N/A
 Return:
    N/A
 
 ***/
  //function calls for mouse activities 
$("#submit").mouseenter(run_MouseEnter);
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




 //function calls for mouse activities 
$("#Reset").mouseenter(run_MouseEnter);
 $("#Reset").mouseleave(run_MouseLeave);


    



$( "#accordion" ).accordion();



var availableTags = [
  "Greenwood",
  "Indianapolis",
  "Fort Myer",
  "Avon",
  "Fishers",
  "Noblesville",
  "Spring Feild",
  "Plainfeild",
  "Columbus",
  "Carmel",
  "Southport",
  "Beech Grove",
  "Martinsville",
  "Moresville",
  "Muncie",
  "Edingburgh"
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







