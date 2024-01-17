'use strict';

$(function () {
	$('.select2').select2({
		language:
		{
			noResults: function()
			{
				return "No se encontraron resultados.";
			},
			searching: function()
			{
				return "Buscando...";
			},
			inputTooShort: function()
			{
				return 'Por favor ingrese 3 o más caracteres';
			}
		},
		placeholder: 'Buscar...'
	});

	$.validator.addMethod("regex", function (value, element, regexp) {
		var re = new RegExp(regexp);
		return this.optional(element) || re.test(value);
	}, "Por favor, ingrese un valor válido.");

	$('#frmEditOffice').validate({
		rules: {
			dni: {
				required: true,
				regex: /^[0-9]{8}$/
			},
			fullname: {
				required: true
			},
			charge: {
				required: true
			},
			officeId: {
				required: true
			},
		},
		messages: {
			name: {
				required: "Este campo es obligatorio.",
				regex: "Por favor, ingrese un DNI válido."
			},
			fullname: {
				required: "Este campo es obligatorio."
			},
			charge: {
				required: "Este campo es obligatorio."
			},
			officeId: {
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