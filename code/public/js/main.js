$( document ).ready(function() {

    jQuery.validator.addMethod("IBAN", function(value, element) {
        return /[a-zA-Z]{2}[0-9]{2}[a-zA-Z0-9]{4}[0-9]{7}([a-zA-Z0-9]?){0,16}/.test(value.replace(/\s/g, ''));
    }, "Voer een correct IBAN nummer in.");
      
    
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
        },
        messages: {
            required: "Dit veld is verplicht."
        }
    });

});