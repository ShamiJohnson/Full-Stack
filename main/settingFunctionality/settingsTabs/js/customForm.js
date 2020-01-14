
/*
 TITLE: customForm.js
 AUTHOR: Ehtsham Nisar (EN)
 CREATE DATE: 8 December 2018
 PURPOSE: create a customForm.js file to write on web page
 LAST MODIFIED ON: 8 December 2018
 LAST MODIFIED BY: Ehtsham Nisar (EN)
 MODIFICATION HISTORY:
 8 December 2018: created customForm.js (EN)
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
    
     

        $( "#tabs" ).tabs();           //tabs will perform efficiently             
    
        /***
 Purpose: validator.setDefaults function is used to scrape all the user's data and store it in variable which then be diplayed on the screen in a different tab
 Parameters:
    N/A
 Return:
    N/A
 ***/
        $.validator.setDefaults({
              /***
Name: submitHandler()
 Purpose:the purpose of this function is to scrape the data from the form and store it in variables. it is later used to display the content on a designated area. 
 Parameters:
    N/A
 Return:
    N/A
 ***/
            submitHandler: function() {
                // gets user's input data and stores it in vaiables 
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
            
                // append all the data to the output paragraph using append method  
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
        }); //End  $.validator.setDefaults
        
 










// Use custom rules and error messages when validating
        // validate form on keyup and submit
        $("#contact").validate({             
            // Rule to NOT ignore hidden fields
            ignore: [],


    
            rules: {
                userName: {                         //<input name="userName">
                    required: true,
                    minlength: 5
                },
                password: {                         //<input name="password">
                    required: true,
                    minlength: 5
                },
                phone: {                            //<input name="phone">
                    required: true,
                    digits: true,
                    maxlength: 10
                },
                email: {                            //<input name="email">
                    required: true,
                    email: true
                },
                radio: {                              //<input name="radio">
                    required: true
                },
                device: {                            //<input name="device">
                    required: true,
                },
                text_area: {                          //<input name="text_area">
                    required: true,
                    minlength: 10
                },
                datepicker: {                        //<input name="datepicker">
                    required: true,
                    date: true
                },

                spinner: {                          //<input name="spinner">
                    required: true,
                    digits: true,
                    range: [1, 12] 
                },

                autocomplete: {                     //<input name="autocomplete">
                    required: true,
                    maxlength: 2,
                    minlength: 2
                },

                repairPart: {                       //<input name="repairPart">
                    required: true
                }

            }, // end rules




            messages: {                             // These messages are displayed when user input doesn't match the rules
                userName: {                         //<input name="userName">
                    required: "Please enter a your First and Last name",
                    minlength: $.validator.format("Please enter your full name")
                },
                password: {                         //<input name="password">
                    required: "Please enter your password",
                    minlength: $.validator.format("Must have at least {0} characters")
                },
                phone: {                  //<input name="phone"
                     required: "Please enter your phone number",
                     digits: "Please enter numbers only",
                     maxlength: $.validator.format("Must have maximum {0} characters")
                },
                email: {                              //<input name="email">
                    required: "Please enter your email address",
                    email: "Please enter a valid email address"
                },
                radio: {                            //<input name="radio">
                    required: "Please select your preffered way of communication"
                },
                device: {                            //<input name="device">
                    required: "Please select your device"
                },
                text_area: {                        //<input name="text_area">
                    required: "Please provide description about your device",
                    minlength: "Please provide more information"
                },
                datepicker: {                       //<input name="datepicker">
                    required: "Please pick a date",
                    date: "Please enter a valid date"
                },
                spinner: {                            //<input name="spinner">
                    required: "<br>Enter your availability",
                    digits: "<br>Please type numbers",
                    range: "<br>Enter valid hours(1-12)"
                },
                autocomplete: {                     //<input name="autocomplete">
                    required: "Please provide your availability",
                    maxlength:"Please type am OR pm",
                    minlength:"Please type am OR pm"
                },
                repairPart: {                       //<input name="repairPart">
                    required: "Please pick your issue"
                }
            }  // end messages


        }); // end flintstoneForm.validate
        /* End Validation plugin */
    });





    