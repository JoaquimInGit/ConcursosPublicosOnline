'use strict';

// Class definition
var ImageInput = function () {
	// Private functions
	var init= function () {


		// Example 4
		var avatar4 = new KTImageInput('kt_image_4');

		avatar4.on('cancel', function(imageInput) {
			swal.fire({
                title: 'Image successfully canceled !',
                icon: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
		});

		avatar4.on('change', function(imageInput) {
			swal.fire({
                title: 'Image successfully changed !',
                icon: 'success',
                buttonsStyling: false,
                confirmButtonText: 'Awesome!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
		});

		avatar4.on('remove', function(imageInput) {
			swal.fire({
                title: 'Image successfully removed !',
                icon: 'error',
                buttonsStyling: false,
                confirmButtonText: 'Got it!',
                confirmButtonClass: 'btn btn-primary font-weight-bold'
            });
		});


	}

	return {
		// public functions
		init: function() {
			init();
		}
	};
}();

KTUtil.ready(function() {
    ImageInput.init();
});
