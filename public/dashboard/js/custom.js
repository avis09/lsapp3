$('.numbers-only').on('keypress', function(evt) {
    var charCode = (evt.which) ? evt.which : evt.keyCode
     if (charCode > 31 && (charCode < 48 || charCode > 57))
        return false;
  
     return true;
  });
  
  function numbersOnly(evt){
      var charCode = (evt.which) ? evt.which : evt.keyCode
      if (charCode > 31 && (charCode < 48 || charCode > 57))
         return false;
   
      return true;
  }
  function alphabetsOnly(e) {
      try {
          if (window.event) {
              var charCode = window.event.keyCode;
          }
          else if (e) {
              var charCode = e.which;
          }
          else { return true; }
          if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123))
              return true;
          else
              return false;
      }
      catch (err) {
          alert(err.Description);
      }
  }

  function strip_tags(str){
      return str.replace(/<\/?[^>]+(>|$)/g, "");
  }
  
  var current_file;
  var base_url = "{{URL::to('/')}}";
  var form_empty_error = "This field is required.";
  var form_invalid_email = "Please enter a valid email address.";
  var form_script = "Javascript and PHP Script are not allowed.";
  var form_invalid_mobile_no = "Invalid mobile number. Required format : 9XXXXXXXXX";
  var form_nohtml = "HTML Tags are not allowed";
  var form_invalid_extension = "File type is not supported.";
  var form_max_size = "Maximum file size exceeded";
  var form_invalid_password = "Password should have mininimum of 6 characters";
// Standard Validation
  var validate = {
      standard: function(element){
          var counter = 0;
          $(this).css('border-color','#b8b8b8');
          $(".validate_error_message").remove();
          var error_message = "<span class='validate_error_message'>"+form_empty_error+"<br></span>";
          $(element).each(function(){
              var type = $(this).attr("type");
              if(type != "ckeditor"){
                  if($(this).val() != null){
<<<<<<< HEAD

=======
>>>>>>> 6ea6090b4b55798797ab9de501b10c1dc9ccbe3a
                      var input = $(this).val().trim();
                        if (input.length == 0) {
  
                            $(this).addClass('err_inputs');
                            if(type == "text" || type == "textarea" || type == "dropdown" || type == "email"  || type == "password" || type == "date" ){
                                $(error_message).insertAfter(this);
                            }
                            else{
                              $(error_message).insertAfter($(this).parent()); //this
                            }
  
                          counter++;
                        }else{
                            $(this).css('border-color','#b8b8b8');
                          $(this).removeClass('err_inputs');
                            $(this).next(".validate_error_message").remove();
                        }
                  } else {
  
                      $(this).addClass('err_inputs');
                      $(error_message).insertAfter(this);
                      counter++;
                  }
              }
          });
  
          //Text only
          $(".alphaonly").each(function(){
              var str = $(this).val();
              if(/^[a-zA-Z -]*$/.test(str) == false) {
                  counter++;
                  $(this).addClass('err_inputs');
                    $("<span class='validate_error_message'>This field only required only Letters.<br></span>").insertAfter(this);
              }
          });
  
          $(".mobile_number").each(function(){
              var number = $(this).val();
              if(number){
                  if(/^9\d{9}$/.test(number) === false){
                      counter++;
                      $(this).addClass('err_inputs');
                      $("<span class='validate_error_message'>"+form_invalid_mobile_no+"<br></span>").insertAfter(this);
  
                  }
                  else{
                      $(this).removeClass('err_inputs');
                  }
              }
          });
  
          $(".email").each(function(){
              if($(this).val() != ""){
                  var email = $(this).val();
                  var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
                  if(!pattern.test(email)){
                      counter++;
                      $(this).addClass('err_inputs');
                        $("<span class='validate_error_message'>"+form_invalid_email+"<br></span>").insertAfter(this);
                  }
                  else{
                      $(this).removeClass('err_inputs');
                  }
              }
          });
  
          $(".password").each(function(){
              if($(this).val() != ""){
                  var err_pass = 0;
                  var password = $(this).val();
                  if (password.length<6){
                      err_pass++;
                      counter++;
                  }

                  if (err_pass>0) {
                      $(this).addClass('err_inputs');
                        $("<span class='validate_error_message'>"+form_invalid_password+"<br></span>").insertAfter(this);
                  } else {
                      $(this).removeClass('err_inputs');
  
                  }
              }
          });
          return counter;
      }
  }
  