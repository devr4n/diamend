{{--Image Preview Modal--}}
<div id="imagePreviewModal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="imagePreviewModalLabel"
     aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title font-weight-bold" id="imagePreviewModalLabel"></h5>
                <button type="button" class="close" data-dismiss="modal">
                    <i class="fa-solid fa-xmark fa-lg" title="Close Preview"></i>
                </button>
            </div>
            <div class="modal-body">
                <div class="d-flex justify-content-center">
                    <img id="imagePreview" src="" class="img-fluid" style="max-width: 100%; max-height: 80vh;">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" title="Close Preview">Close
                </button>
            </div>
        </div>
    </div>
</div>
{{--End of Image Preview Modal--}}

<script>

    // Show image preview modal
    function showImagePreview(src, customerName) {
        $('#imagePreview').attr('src', src);
        $('#imagePreviewModal .modal-title').text(customerName);
        $('#imagePreviewModal').modal('show');
    }

</script>
