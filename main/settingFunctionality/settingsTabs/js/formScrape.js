
/*
 TITLE: formScrape.js
 AUTHOR: Ehtsham Nisar (EN)
 CREATE DATE: 30 November 2018
 PURPOSE: create a formScrape.js file to write on web page
 LAST MODIFIED ON: 30 November 2018
 LAST MODIFIED BY: Ehtsham Nisar (EN)
 MODIFICATION HISTORY:
 30 November 2018: created formScrape (EN)
 */




/***
 Name:
    $(document).ready(function()
 Purpose:
 The purpose of this function is to display form content with on a designated area  
  
 Parameters:
    N/A
 Return:
    N/A
 
 ***/
    $(document).ready(function() {
    
     

        $( "#tabs" ).tabs();                        
    
        /***
 Purpose: validator.setDefaults function is used check all the user's data entry 
 Parameters:
    N/A
 Return:
    N/A
 ***/
        $.validator.setDefaults({
              /***
 Purpose:the purpose of this function is to scrape the data from the form and store it in variables. it is later used to display the content on a designated area. 
 Parameters:
    N/A
 Return:
    N/A
 ***/
            submitHandler: function() {
                // get user's data and store it in vaiables 
                var struserName = $('#userName').val(); 
                var strpassword = $('#password').val();           
                var strphone = $('#phone').val();                
                var stremail = $('#email').val();         
                var strradio = $('input[name="radio"]:checked').val();
                var strdevice = new String($('#device').val()); 
                 var strtext_area = new String($('#text_area').val()); 
                 var strdatepicker = new String($('#datepicker').val()); 
                 var strspinner = new String($('#spinner').val()); 
                 var strautocomplete = new String($('#autocomplete').val()); 
                var strrepairPart = "";  
                $('input[name="repairPart"]:checked').each(function() {     
                    strrepairPart += $(this).val() + " ";
                });
            
                // append all the data to the output paragraph 
                $('#formOutput').append("<br><br> Name: " + struserName)
                                        .append("<br> Password: " + strpassword)
                                       
                                        .append("<br> Phone: " + strphone)
                                        .append("<br> Email: " + stremail)
                                        .append("<br> Contact method: " + strradio)
                                        .append("<br> repairPart: " + strrepairPart)
                                        .append("<br> device: " + strdevice )
                                        .append("<br> Additional Information: " + strtext_area )
                                        .append("<br> Date available: " + strdatepicker)
                                        .append("<br> Time: " + strspinner )
                                        .append("<br> am/pm: " + strautocomplete );
            } 
        }); 
        // Use default rules and error messages when validating
        $("#contact").validate();
    }); 





    