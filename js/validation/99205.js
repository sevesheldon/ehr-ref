		$(document).ready(function() {
			$("#HPIform").validate({
				rules: {
					HPIname: {
						required: true
					}
				},
				messages: {
				},
				errorClass: "alert-danger",
				errorPlacement: function(error,element) {
					return true;
				}
			});
			
			$("#PFSHform").validate({
				rules: {
					PFSHmedical: {
						required: true
					}
				},
				messages: {
				},
				errorPlacement: function(error,element) {
					return true;
				},
				highlight: function( element, errorClass, validClass ) {
					if ( element.type === "radio" ) {
						this.findByName( element.name ).addClass( errorClass ).removeClass( validClass );
					} else if ( element.type === "checkbox" ) {
						$( element ).parent().parent().addClass( errorClass ).removeClass( validClass );
					} else {
						$( element ).addClass( errorClass ).removeClass( validClass );
					}
				},
				unhighlight: function( element, errorClass, validClass ) {
					if ( element.type === "radio" ) {
						this.findByName( element.name ).removeClass( errorClass ).addClass( validClass );
					} else if ( element.type === "checkbox" ) {
						$( element ).parent().parent().removeClass( errorClass ).addClass( validClass );
					} else {
						$( element ).removeClass( errorClass ).addClass( validClass );
					}
				},
				errorClass: "alert-danger"
			});
			
			$.validator.addClassRules({
				HPIElement: { require_xof_elements: [4, ".HPIElement"] },
				PFSHFamilyElement: { require_xof_elements: [1, ".PFSHFamilyElement"] },
				PFSHSocialElement: { require_xof_elements: [1, ".PFSHSocialElement"] }
			});
			
			$.validator.addMethod(
				"require_xof_elements",
				$.validator.methods.require_from_group,
				""
			);
		});