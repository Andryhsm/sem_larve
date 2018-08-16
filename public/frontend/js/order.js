$(function () {
    $.fn.orderDetail = function () {
        $(".coupon-code").toggle();
        var order_detail_container = $(".order-detail-container");
        $(order_detail_container).find(".order-item-container").on('click', '.row', function (event) {
            $(order_detail_container).find(".row").removeClass('active');
            $(this).addClass('active');
        });
        $(order_detail_container).find(".notification-btn").on('click', 'a', function (event) {
            event.preventDefault();
            var url = base_url + language_code+ '/choose-seller/'+$(this).data('merchant');
            var item_id = $(this).data('item-id');
            var customer_id = $(this).data('customer');
            var merchant_id = $(this).data('merchant');
            var available_type = $(this).data('available_type');
            var available_time = $(this).data('available_time');
            var product_name = $(this).data('product_name');
            var product_link = $(this).data('product_link');
            $.ajax({
                type: 'POST',
                url: url,
                data: {'item_id': item_id, 'merchant': merchant_id, 'customer': customer_id,'available_type':available_type,'available_time':available_time,'product_name':product_name,'product_link':product_link},
                beforeSend: function () {
                    $.LoadingOverlay("show", {'size': "10%", 'zIndex': 9999});
                },
                success: function (response, status) {
                    $.LoadingOverlay("hide");
                    window.location.reload();
                }
            });
        });

        $(".response-to-customer").click(function (e) {
            var form = $("#product_search_form_".$(this).data('index'));
            $(form).submit();
        });

        $(".cancel_order").on('click',function (e) {
            e.preventDefault();
            var form = $("#product_booking_"+$(this).data('index'));
            var form_url = form.attr('action');
            var new_url = form_url.replace('booking-request','cancel-request');
            form.attr('action',new_url);
            $(form).submit();
        });

        $(".booking-request").click(function (e) {
            var form = $("#product_booking_".$(this).data('index'));
            $(form).submit();
        });

        $(".coupon-code-btn").click(function() {
            $(this).next().toggle();
        });

        $.each(function(index, el) {
            
        });
    }
})

