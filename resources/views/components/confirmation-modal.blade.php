<!-- resources/views/components/confirmation-modal.blade.php -->
<div class="modal fade" id="{{ $modalId }}" tabindex="-1" role="dialog" aria-labelledby="{{ $modalId }}Label" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $modalId }}Label">{{ $title }}</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                {{ $message }} 
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">{{__('No')}}</button>
                <button type="button" class="btn btn-primary" id="{{ $modalId }}ConfirmButton">{{__('Yes')}}</button>
            </div>
        </div>
    </div>
</div>
<script>
    let formToSubmit;

    function showConfirmModal(event, modalId,message='') {
        event.preventDefault(); // Prevent the form from submitting immediately
        formToSubmit = event.target.closest('form'); // Save the form reference
        $('.modal-body').append(message+' ?')
        $('#' + modalId).modal('show'); // Show the modal
    }

    $(document).on('click', '[id$="ConfirmButton"]', function() {
        const modalId = $(this).closest('.modal').attr('id');
        $('#' + modalId).modal('hide'); // Hide the modal
        if (formToSubmit) {
            formToSubmit.submit(); // Submit the form if confirmed
        }
    });
</script>
