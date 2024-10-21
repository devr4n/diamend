require('./bootstrap');
import Swal from 'sweetalert2';
import toastr from 'toastr';
import 'toastr/build/toastr.min.css';

document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        title: 'Success!',
        text: 'Successfully',
        icon: 'success',
        confirmButtonText: 'OK'
    });
});

$(document).ready(function() {
    $('.select2').select2();
});
