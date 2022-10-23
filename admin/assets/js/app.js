/* Category Validation */
$(document).ready(function () {
    $('#category_form').validate({
        rules: {
            "name": "required",
        },

        messages: {
            "name": "Please Fill Category Name Field",
        },

        errorElement: 'span',
        errorPlacement: function (error, element) {
            error.addClass('invalid-feedback');
            element.closest('.form-group').append(error);
        },

        highlight: function (element, errorClass, validClass) {
            $(element).addClass('is-invalid');
        },
        
        unhighlight: function (element, errorClass, validClass) {
            $(element).removeClass('is-invalid');
        }
    });
});