require('./bootstrap');

import toastr from 'toastr';
import 'toastr/build/toastr.min.css';
window.toastr = toastr;

import Swal from 'sweetalert2';
window.Swal = Swal;

document.addEventListener('DOMContentLoaded', function () {
    Swal.fire({
        title: 'Success!',
        text: 'Successfully',
        icon: 'success',
        confirmButtonText: 'OK'
    });


    document.querySelectorAll('.delete-button').forEach(function (button) {
        button.addEventListener('click', function (event) {
            event.preventDefault();

            const form = this.closest('form');

            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit(); // Kullanıcı onay verirse formu gönder
                }
            });
        });
    });
});

$(document).ready(function() {
    $('.select2').select2();
});
