$("#confirm").on("click", function (e) {
    e.preventDefault();

    var amount = $('#amount');
    var timestamp = Date.now();

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "https://api.gbprimepay.com/gbp/gateway/qrcode/text",
        data: {
            token: 'ZCVuJ2lfjPetZUxU+bduBCdusvD+FGzzZkRp+W2h9wRQAvAGCHvRB0BXGWptoOR4Ji1dxjYisjhwQPuvYbhU5OyR8QcXXD2fthKuW8YNsZnsUOrDYs/uF5A7cPDLZ29ezYYxNooWEosTM/qzvYX3IJu5SqY7FCup3l4lSjlKxvWUF21A',
            referenceNo: timestamp.toString(),
            backgroundUrl: 'http://order.chapayom.com:3000/payment-status',
            amount: amount.val(),
            payType: 'F'
        },
        success: function(e) {
            if(e.resultCode === '00') {
                $.ajax({
                    type: "POST",
                    url: "https://order.chapayom.com/pay-qr/invoice",
                    data: {
                        payment_id: e.referenceNo,
                        gbp_id: e.gbpReferenceNo,
                        qrcode: e.qrcode,
                    },
                    success: function(e) {
                        alert('สำเร็จ')
                    },
                    error: function(e) {
                        alert('ไม่สามารถดำเนินการให้สำเร็จได้.')
                    }
                });
            }
            else {
                alert('Serivce unavailable.');
            }
        },
        error: function(e) {
            alert('Serivce unavailable.')
        }
    });

});
