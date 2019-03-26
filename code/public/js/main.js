$( document ).ready(function() {

    jQuery.validator.addMethod("IBAN", function(value, element) {
        return /[a-zA-Z]{2}[0-9]{2}[a-zA-Z0-9]{4}[0-9]{7}([a-zA-Z0-9]?){0,16}/.test(value.replace(/\s/g, ''));
    }, $("#correctIBAN").val());

    jQuery.extend(jQuery.validator.messages, {
        required: $("#fieldMandatory").val()
    });
    
    $('.ibanform').validate({
        rules: {
            IBAN: {
                required: true,
                IBAN: true
            }
        },
        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.input-group').append(error);
        },
        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });


    $("#change_lang_us").click(function(){
        document.cookie = "locale=us; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        location.reload();
    });
    $("#change_lang_nl").click(function(){
        document.cookie = "locale=nl; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        location.reload();
    });
    $("#change_lang_de").click(function(){
        document.cookie = "locale=de; expires=Fri, 31 Dec 9999 23:59:59 GMT; path=/";
        location.reload();
    });

    function readURL(input) {

        if (input.files && input.files[0]) {
          var reader = new FileReader();
      
          reader.onload = function(e) {
            $('#image').attr('src', e.target.result);
          }
      
          reader.readAsDataURL(input.files[0]);
        }
      }
      
      $("#inputGroupFile01").change(function() {
        readURL(this);
      });

});