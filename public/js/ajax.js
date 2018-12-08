jQuery(document).ready(function () {
    jQuery('#ajaxAccept').click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });
        jQuery('.alert-danger').hide();
        jQuery('#ajaxAccept').hide();
        jQuery('#ajaxReject').hide();
        jQuery('#loading').show();
        jQuery.ajax({
            url: "{{ url('/merchantDashboard/action/{id}') }}",
            method: 'post',
            data: {
                status: 'accept'
            },
            success: function (result) {
                if (result.success){
                    jQuery('.alert-success').show();
                    jQuery('.alert-success').html(result.success);
                    jQuery('#loading').hide();
                }
                else
                {
                    jQuery('.alert-danger').show();
                    jQuery('.alert-danger').html(result.error);
                    jQuery('#ajaxAccept').show();
                    jQuery('#ajaxReject').show();
                    jQuery('#loading').hide();
                }
            }
        });
    });
});