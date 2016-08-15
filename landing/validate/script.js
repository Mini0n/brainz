$(document).ready(function(){


		$('#registration-form').validate({
	    rules: {
		       nombre: {
		        required: true,
		       	required: true,
		       	minlength: 3,
		      },
		  
				apellido: {
			       minlength: 3,
			       required: true
			    },
		  
			  cumple: {
				required: true,
				date: true,
				maxDate: true
				},

		      email: {
		        required: true,
		        email: true
		      },

			   genero: {
		        required: true
		      },
		  
		  agree: "required"
		  
	    },
			highlight: function(element) {
				$(element).closest('.control-group').removeClass('success').addClass('error');
			},
			success: function(element) {
				element
				.text('OK!').addClass('valid')
				.closest('.control-group').removeClass('error').addClass('success');
			}
	  });

}); // end document.ready