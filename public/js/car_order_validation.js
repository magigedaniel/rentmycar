jQuery(document).ready(function () {
    //Change function of enddate
    jQuery("#endDate").change(function () {

        var startDate = jQuery('#startDate').val();
        var endDate = jQuery('#endDate').val();
        var price_per_day=jQuery('#price_per_day').val();
        var today = new Date();
        y = today.getFullYear();
        m = today.getMonth() + 1;
        d = today.getDate();
        var today_date=y + "-" + m + "-" + d;
//alert(price_per_day);
        if(startDate<today_date){
            jQuery('.alert-danger').show();
            jQuery('.alert-danger').html('Start date cannot be less than today date');
            return
        }

        if(startDate>endDate){
            jQuery('.alert-danger').show();
            jQuery('.alert-danger').html('Start date cannot be more than End date');
            return;
        }

        var oneDay = 24 * 60 * 60 * 1000; // hours*minutes*seconds*milliseconds
        var firstDate = new Date(startDate);
        var secondDate = new Date(endDate);

        var diffDays = Math.round(Math.abs((firstDate.getTime() - secondDate.getTime()) / (oneDay)));
        //var num_of_day=endDate-startDate;
        jQuery('#NumberOfDay').val(diffDays);
        var total_cost=price_per_day *diffDays;
        jQuery('#TotalAmount').val(total_cost);
       // alert(total_cost);

    });

    jQuery('#ajaxSubmit').click(function (e) {
        e.preventDefault();
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
            }
        });

        //Js Field validation
        var mpesaphone = jQuery('#mpesaMobilePhone').val();
        var location = jQuery('#location').val();

        if (startDate > endDate) {
            alert(startDate);
            return;
        }
        if (mpesaphone == '') {
            jQuery('.alert-danger').show();
            jQuery('.alert-danger').html('Fill all required field *');
            //alert('M-pesa Mobile Phone');
            return
        }


        jQuery.ajax({
            url: "{{ url('/car/order') }}",
            method: 'post',
            data: {
                startDate: jQuery('#startDate').val(),
                mpesaMobilePhone: jQuery('#mpesaMobilePhone').val(),
                endDate: jQuery('#endDate').val(),
                DepositAmount: jQuery('#DepositAmount').val(),
                TotalAmount: jQuery('#TotalAmount').val(),
                NumberOfDay: jQuery('#NumberOfDay').val()
            },
            success: function (result) {
                if (result.success){
                jQuery('.alert').show();
                jQuery('.alert').html(result.success);
                }
                else
                {
                    jQuery('.alert').show();
                    jQuery('.alert').html(result.error);
                }
            }
        });
    });
});