var line_id = 'undefined';

window.onload = function() {
    const defaultLiffId = "1653603515-dM2LVvkZ"; // change the default LIFF value if you are not using a node server

    let myLiffId = "1653603515-dM2LVvkZ";

    myLiffId = defaultLiffId;
    initializeLiffOrDie(myLiffId);

};

function setMessageByElement(element, message) {
    return document.getElementById(element).innerHTML = message;
}

function initializeLiffOrDie(myLiffId) {
    if (!myLiffId) {
        setMessageByElement('app', 'Service is unavailable. Please check your LIFF ID.');
    } else {
        initializeLiff(myLiffId);
        console.log('OK!');
    }
}

function initializeLiff(myLiffId) {

    liff.init({
            liffId: myLiffId
        })
        .then(() => {
            initializeApp();
        })
        .catch((e) => {
            console.log(e);
        });
}

function initializeApp() {

    liff.getProfile().then(function(profile) {
        $('#uimg').attr('src', profile.pictureUrl);
    }).catch(function(e) {
        console.log(e);
    });

}

$("#name").on("touchmove", function (e) {
  e.preventDefault();
});

$("#branch").on("touchmove", function (e) {
  e.preventDefault();
});

$("#phone").on("touchmove", function (e) {
  e.preventDefault();
});

$("#phone").on("keypress keyup blur",function (event) {
    $(this).val($(this).val().replace(/[^\d].+/, ""));
    if ((event.which < 48 || event.which > 57)) {
        event.preventDefault();
    }
});

$("#back").on("click", function (e) {
    window.location.replace('/');
});

$("#save").on("click", function (e) {
    e.preventDefault();

    var save = $('#save');
    var name = $('#name');
    var branch = $('#branch');
    var phone_number = $('#phone');

    save.addClass('is-loading');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/profile/edit",
        data: {
            name: name.val(),
            branch: branch.val(),
            phone_number: phone_number.val()
        },
        success: function(e) {
            save.removeClass('is-loading');
            if(e == 'success') {
                toastr.success("แก้ไขข้อมูลเรียบร้อยแล้ว", {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-bottom-center",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            }
            else {
                toastr.warning("ข้อมูลไม่ถูกต้อง", {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": true,
                    "positionClass": "toast-bottom-center",
                    "preventDuplicates": false,
                    "onclick": null,
                    "showDuration": "300",
                    "hideDuration": "1000",
                    "timeOut": "5000",
                    "extendedTimeOut": "1000",
                    "showEasing": "swing",
                    "hideEasing": "linear",
                    "showMethod": "fadeIn",
                    "hideMethod": "fadeOut"
                });
            }
        },
        error: function(e) {
            save.removeClass('is-loading');
            toastr.error("บริการเกิดข้อขัดข้อง", {
                "closeButton": true,
                "debug": false,
                "newestOnTop": false,
                "progressBar": true,
                "positionClass": "toast-bottom-center",
                "preventDuplicates": false,
                "onclick": null,
                "showDuration": "300",
                "hideDuration": "1000",
                "timeOut": "5000",
                "extendedTimeOut": "1000",
                "showEasing": "swing",
                "hideEasing": "linear",
                "showMethod": "fadeIn",
                "hideMethod": "fadeOut"
            });
        }
    });

});
