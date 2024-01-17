'use strict';

$(function () {
	$.validator.addMethod("regex", function (value, element, regexp) {
		var re = new RegExp(regexp);
		return this.optional(element) || re.test(value);
	}, "Por favor, ingrese un valor válido.");

	$('#frmEditOffice').validate({
		rules: {
			name: {
				required: true,
			},
			area: {
				required: true
			}
		},
		messages: {
			name: {
				required: "Este campo es obligatorio."
			},
			area: {
				required: "Este campo es obligatorio."
			}
		},
		errorElement: 'span',
		errorPlacement: function (error, element) {
			error.addClass('invalid-feedback');
			element.closest('.form-group').append(error);
		},
		highlight: function (element, errorClass, validClass) {
			$(element).addClass('is-invalid');
			$(element).removeClass('is-valid');
		},
		unhighlight: function (element, errorClass, validClass) {
			$(element).removeClass('is-invalid');
			$(element).addClass('is-valid');
		},
		success: function (label, element) {
			label.addClass("is-valid");
		},
		submitHandler: function (form) {
			$('#modalLoading').show();
			$('#frmEditOffice')[0].submit();
		}
	});
});