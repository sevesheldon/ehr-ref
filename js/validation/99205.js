		$(document).ready(function() {
			$("#HPIform").validate({
				rules: {
					HPIname: {
						required: true
					}
				},
				messages: {
				},
				errorClass: "alert alert-danger",
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
				errorClass: "alert alert-danger",
				errorPlacement: function(error,element) {
					return true;
				}
			});
			
			$.validator.addClassRules({
				HPIElement: { require_xof_elements: [4, ".HPIElement"] },
				PFSHFamilyElement: { require_xof_elements: [1, ".PFSHFamilyElement"] },
				PFSHSocialElement: { require_xof_elements: [1, ".PFSHSocialElement"] }
			});
			
			$.validator.addMethod(
				"require_xof_elements",
				$.validator.methods.require_from_group,
				"Please fill out at least {0} HPI elements"
			);
		});