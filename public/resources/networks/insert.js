'use strict';

$(function () {
	$.validator.addMethod("regex", function (value, element, regexp) {
		var re = new RegExp(regexp);
		return this.optional(element) || re.test(value);
	}, "Por favor, ingrese un valor válido.");

	$('#frmInsertNetwork').validate({
		rules: {
			ip: {
				required: true,
				regex: /^([0-9]{1,3}\.){3}[0-9]{1,3}$/
			},
			mask: {
				required: true,
				regex: /^([0-9]{1,3}\.){3}[0-9]{1,3}$/
			},
			gateway: {
				required: true,
				regex: /^([0-9]{1,3}\.){3}[0-9]{1,3}$/
			},
		},
		messages: {
			ip: {
				required: "Este campo es obligatorio.",
				regex: "Formato incorrecto. Ejemplo: [10.10.10.10]"
			},
			mask: {
				required: "Este campo es obligatorio.",
				regex: "Formato incorrecto. Ejemplo: [10.10.10.10]"
			},
			gateway: {
				required: "Este campo es obligatorio.",
				regex: "Formato incorrecto. Ejemplo: [10.10.10.10]"
			},
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
			$('#frmInsertNetwork')[0].submit();
		}
	});
});