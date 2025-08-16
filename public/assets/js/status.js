$(document).on('click', '.change-status', function() 
{
    let button = $(this);
    let url = button.data('url');
    let status = button.data('status');
    let tableId = button.closest('table').attr('id');

    $.ajax({
        url: url,
        type: 'POST',
        data: {
            _token: $('meta[name="csrf-token"]').attr('content'),
            status: status
        },
        success: function(response) {
            axiosToast('success',response.message || 'Status updated successfully');
            if (tableId) {
                $('#' + tableId).DataTable().ajax.reload(null, false);
            }
        },
        error: function() {
            axiosToast('error', "Failed to update status");
        }
    });
});
