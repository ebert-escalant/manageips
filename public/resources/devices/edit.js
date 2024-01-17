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

	$('#frmEditDevice').validate({
		rules: {
			mac: {
				required: true
			},
			brand: {
				required: true
			},
			model: {
				required: false
			},
			type: {
				required: false
			},
			description: {
				required: false
			},
			staffId: {
				required: true
			},
			officeId: {
				required: true
			},
			networkId: {
				required: true
			}
		},
		messages: {
			mac: {
				required: "Este campo es obligatorio."
			},
			brand: {
				required: "Este campo es obligatorio."
			},
			staffId: {
				required: "Este campo es obligatorio."
			},
			officeId: {
				required: "Este campo es obligatorio."
			},
			networdId: {
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
			$('#frmEditDevice')[0].submit();
		}
	});
});