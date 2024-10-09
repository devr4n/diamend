require('jquery');
require('@popperjs/core'); // Ensure this line is present

// Bootstrap
require('bootstrap/dist/js/bootstrap.bundle.min.js'); // Use the bundle version which includes Popper.js

// jQuery Easing
require('../../public/vendor/jquery-easing/jquery.easing.min.js');

// SB Admin 2
require('sb-admin-2/js/sb-admin-2.min.js');

// Select2
require('select2/dist/js/select2.min.js');
require('select2/dist/css/select2.min.css');

$(document).ready(function() {
    $('.select2').select2();
});
