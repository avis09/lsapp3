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
  
  function allowedDate(max=null,min=null){
      var dtToday = new Date();
  
      var month = dtToday.getMonth() + 1;
      var day = dtToday.getDate();
      var year = dtToday.getFullYear();
  
      if(month < 10)
          month = '0' + month.toString();
      if(day < 10)
          day = '0' + day.toString();
  
      var restrictDate = year + '-' + month + '-' + day;
  
      $('#'+max).attr('max', restrictDate);
      $('#'+min).attr('min', restrictDate);
  }
  
  //return if json
  function isJson(str) {
      try {
          return JSON.parse($.trim(str));
      } catch (e) {
          return $.trim(str)
      }
  }
  
  //return if json
  function isText(str) {
      try {
          return JSON.parse($.trim(str));
      } catch (e) {
          return $.trim(str)
      }
  }
  
  
  function is_in_array(s,your_array) {
      for (var i = 0; i < your_array.length; i++) {
          if (your_array[i].toLowerCase() === s.toLowerCase()) return true;
      }
      return false;
  }
  
  //strip_html tags
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
  //validation
  var validate = {
      emailaddress : function(element){
          var input = $(element).val().trim();
          $(".validate_error_message").remove();
          if(input.length > 0){
              var email = $(element).val();
              var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
              if(!pattern.test(email)){
                  $(element).addClass('err_inputs');
                    $("<span class='validate_error_message'>"+form_invalid_email+"<br></span>").insertAfter(element);
                    return false;
              }
              else{
                  $(element).removeClass('err_inputs');
                  return true;
              }
          }
          else{
              var error_message = "<span class='validate_error_message'>"+form_empty_error+"<br></span>"
              $(element).addClass('err_inputs');
              $(error_message).insertAfter(element);
              return false;
          }
      },
      standard: function(element){
          //var element = ".required_input";
          var counter = 0;
  
          $(this).css('border-color','#b8b8b8');
          $(".validate_error_message").remove();
          var error_message = "<span class='validate_error_message'>"+form_empty_error+"<br></span>";
          $(element).each(function(){
  
              var type = $(this).attr("type");
              if(type != "ckeditor"){
  
                  if($(this).val() != null){
  
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
  
          //alpha only
  
          $(".alphaonly").each(function(){
              var str = $(this).val();
              if(/^[a-zA-Z -]*$/.test(str) == false) {
                  counter++;
                  $(this).addClass('err_inputs');
                    $("<span class='validate_error_message'>This field only required only Letters.<br></span>").insertAfter(this);
              }
          });
  
          //test mobile number
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
  
  
          ///email validator
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
  
          ///password validator
          $(".password").each(function(){
              if($(this).val() != ""){
                  var err_pass = 0;
                  var password = $(this).val();
                  if(password.length<6){
                      err_pass++;
                      counter++;
                  }
                  // var pattern = /^[a-zA-Z]+[0-9]+[!@#$%^&*()_+]$/g;
                  // if(!pattern.test(password)){
                  //
                  // 	err_pass++;
                  // }
  
                  if(err_pass>0) {
                      $(this).addClass('err_inputs');
                        $("<span class='validate_error_message'>"+form_invalid_password+"<br></span>").insertAfter(this);
                  }
                  else{
                      $(this).removeClass('err_inputs');
  
                  }
              }
          });
  
          //ckeditor
          // $('.required_input').each(function(){
          // 	var type = $(this).attr("type");
          // 	var id = $(this).attr("id");
          // 	$(".cke_editor_" + id).css('border-color','#b8b8b8');
          // 	if(type == "ckeditor"){
          // 		var editor = CKEDITOR.instances[id].getData();
          // 		if(editor.trim().length == 0){
          // 			counter++;
          // 			$(".cke_editor_" + id).css('border-color','red');
          // 			$("<span class='validate_error_message'>"+form_empty_error+"<br></span>").insertAfter(".cke_editor_" + id);
          // 		}
          // 	}
          // });
  
          return counter;
      }
  }
  
  
    $(document).on('change', '.upload-file', function(){
      var FileUploadPath = this.value;
      var file_size = this.files[0].size;
      var Extension = FileUploadPath.substring(FileUploadPath.lastIndexOf('.') + 1).toLowerCase();
          if (Extension != "docx" && Extension != "doc" && Extension != "png" && Extension != "bmp"
            && Extension != "jpeg" && Extension != "jpg" && Extension != "xlsx" && Extension != "csv" && Extension != "pdf") {
              medsModal({message: 'Invalid File Format!', title: 'Error!', type: 'failed'});
              this.value = '';
          }
          else if(file_size > 1000000){
             medsModal({message: 'File is too big!', title: 'Error!', type: 'failed'});
             this.value = '';
           }
  
    });
  
  // IE9 SUPPORTED VALIDATIO
  //  function numbersOnly(evt)
  //       {
  //          var charCode = (evt.which) ? evt.which : event.keyCode
  //          if (charCode > 31 && (charCode < 48 || charCode > 57))
  //             return false;
  
  //          return true;
  //       }
  
  // 
  
  // var strict = {
  //     number: function (id) {
  //         $(id).keypress(function (event) {
  //             var charCode = event.keyCode;
  
  //             if ((charCode > 47 && charCode < 58) || charCode == 8) {
  //                 return true;
  //             }
  //             else {
  //                 return false;
  //             }
  //         });
  //     },
  //     letter: function (id) {
  //         $(id).keypress(function (event) {
  //             var charCode = event.keyCode;
  
  //             if ((charCode > 64 && charCode < 91) || (charCode > 96 && charCode < 123) || charCode == 8 || charCode == 32) {
  //                 return true;
  //             }
  //             else {
  //                 return false;
  //             }
  //         });
  //     },
  //     maxLength: function (id, limit) {
  //         var max = limit;
  //         $(id).keypress(function (event) {
  //             var charCode = event.keyCode;
  //             if (id.value.length < max || charCode == 8) {
  //                 return true;
  //             }
  //             else {
  //                 return false;
  //             }
  //         });
  //     },
  //     editor: {
  //         maxLength: function (id, limit) {
  //             CKEDITOR.instances[id].on('key', function (event) {
  //                 var keyCode = event.data.keyCode;
  //                 var deleteKey = 46;
  //                 var backspaceKey = 8;
  //                 if (keyCode === deleteKey || keyCode === backspaceKey || keyCode == 37 || keyCode == 38 || keyCode == 39 || keyCode == 40) {
  //                     return true;
  //                 } else {
  //                     var txt = CKEDITOR.instances[id].getData();
  //                     txt = $(txt).text();
  //                     if (txt.length >= limit) {
  //                         return false;
  //                     }
  //                 }
  //             });
  //         }
  //     }
  // }
  
  // var rule = {
  //     letter: function (elem, maxLength) {
  //         $(elem).on('input paste', function (index, value) {
  //             var self = $(this);
  //             var initVal = self.val(),
  //                 outputVal = initVal.replace(/[^A-Za-zñÑ\-' ]/g, "");
  //             if (maxLength != null) {
  //                 outputVal = outputVal.slice(0, maxLength);
  //             }
  //             if (initVal != outputVal) { self.val(outputVal); }
  //         });
  //     },
  //     number: function (elem, maxLength) {
  //         $(elem).on('input paste', function (index, value) {
  //             var self = $(this);
  //             var initVal = self.val(),
  //                 outputVal = initVal.replace(/[^0-9]/g, "");
  //             if (maxLength != null) {
  //                 outputVal = outputVal.slice(0, maxLength);
  //             }
  //             if (initVal != outputVal) { self.val(outputVal); }
  //         });
  //     },
  //     required: function(element){
  //         var counter = 0;
  //         var error_message = message.error.required();
  //         var error_email_format = message.error.email_format();
  //         var error_mobile = message.error.mobile_format();
  
  //         var email_pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
  //         var mobile_pattern = /^09\d{9}$/;
  
  //         $('.err-message').remove();
  //         $(element).each(function(){
  //             if($(this).val() != null){
  //                 var input = $(this).val().trim();
  //                 if(input.length == 0){
  //                     $(this).css('border-color','red');
  //                     $(error_message).insertAfter(this);
  //                     counter++;
  //                 }else if($(this).hasClass('email')){
  //                     if(email_pattern.test(input)){
  //                         $(this).css('border-color','#ccc');
  //                     }
  //                     else{
  //                         $(this).css('border-color','red');
  //                         $(error_email_format).insertAfter(this);
  //                         counter++;
  //                     }
  //                 }else if($(this).hasClass('mobile')){
  //                     input = input.replace(/\D/g,'');
  //                     input = input.replace(/\s+/g,''); // remove white space
  //                     if(mobile_pattern.test(input)){
  //                         $(this).css('border-color','#ccc');
  //                     }
  //                     else{
  //                         $(this).css('border-color','red');
  //                         $(error_mobile).insertAfter(this);
  //                         counter++;
  //                     }
  //                 }else{
  //                     if(input == 0 || input == "0"){
  //                         $(this).css('border-color','red');
  //                         $(error_message).insertAfter(this);
  //                         counter++;
  //                     } else {
  //                         $(this).css('border-color','#ccc');
  //                     }
  //                 }
  //             }else{
  //                 $(this).css('border-color','red');
  //                 $(error_message).insertAfter(this);
  //             }
  //         });
  //         return counter;
  //     },
  //     emailaddress : function(element){
  //         var email = $(element).val();
  //         var error_email_format = message.error.email_format();
  //         var pattern = /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
  //         $('.err-message').remove();
  //         $(err_message).insertAfter(element);
  //         return pattern.test(email);
  //     },
  //     max: function (elem, maxLength) {
  //         $(elem).on('input paste', function (index, value) {
  //             var self = $(this);
  //             var initVal = self.val();
  //             initVal = initVal.slice(0, maxLength);
  //             self.val(initVal);
  //         });
  //     }
  // }
  
  // var pattern = {
  //     image : function(){
  //         return /(\.jpg|\.jpeg|\.png)$/i;
  //     },
  //     email : function(){
  //         return /^([a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+(\.[a-z\d!#$%&'*+\-\/=?^_`{|}~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]+)*|"((([ \t]*\r\n)?[ \t]+)?([\x01-\x08\x0b\x0c\x0e-\x1f\x7f\x21\x23-\x5b\x5d-\x7e\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|\\[\x01-\x09\x0b\x0c\x0d-\x7f\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]))*(([ \t]*\r\n)?[ \t]+)?")@(([a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\d\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.)+([a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]|[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF][a-z\d\-._~\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF]*[a-z\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])\.?$/i;
  //     },
  //     mobile : function(){
  //         return /^09\d{9}$/;
  //     },
  //     video : function(){
  //         return /(\.mp4)$/i;
  //     },
  //     youtube : function(){
  //         return /^.*(youtu.be\/|v\/|u\/\w\/|embed\/|watch\?v=|\&v=|\?v=)([^#\&\?]*).*/;
  //     },
  //     document : function(){
  //         return /(\.pdf|\.docx)$/i;
  //     },
  //     url : function(){
  //         return (/(http(s)?:\/\/.)?(www\.)?[-a-zA-Z0-9@:%._\+~#=]{2,256}\.[a-z]{2,6}\b([-a-zA-Z0-9@:%_\+.~#?&//=]*)/g);
  //     }
  // }
  
  // function no_script(strCode) {
  //     var string = strCode.trim();
  //     string = string.replace('<script>', '');
  //     string = string.replace('</script>', '');
  //     string = string.replace('&lt;script&gt;', '');
  //     string = string.replace('&lt;/script&gt;', '');
  //     return string;
  // }
  
  
  /*//strip tags
      $(".no_html").each(function(){
        if(/<\/?[^>]*>/.test($(this).val().trim())){
          counter++;
          $(this).css('border-color','red');
          $("<span class='validate_error_message' style='color: red;'>"+form_nohtml+"<br></span>").insertAfter(this);
        }
      });
  
  if($(this).val().trim().includes("<?php")){
          counter++;
          $(this).css('border-color','red');
          $("<span class='validate_error_message' style='color: red;'>"+form_script+"<br></span>").insertAfter(this);
        }*/
  
  
  // $(document).bind('contextmenu', 'body', function(e){
  // return false;
  // });
  
  // $(document).on('keydown', function (event) {
  //     if (event.keyCode == 123) { // Prevent F12
  //         return false;
  //     } else if (event.ctrlKey && event.shiftKey && event.keyCode == 73) { // Prevent Ctrl+Shift+I        
  //         return false;
  //     }
  // });
  
  