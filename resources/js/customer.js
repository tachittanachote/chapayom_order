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

        line_id = profile.userId;

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

$("#save").on('click', function(e) {
    e.preventDefault();

    $("#save").addClass("is-loading")

    var name = $("#name");
    var branch = $("#branch");
    var phone = $("#phone");
    var code = $("#code");

    if(!name.val() || !branch.val() || !phone.val()) {
      $("#save").removeClass("is-loading")
      return toastr.warning("กรุณาระบุข้อมูลให้ครบถ้วน", {
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

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    $.ajax({
        type: "POST",
        url: "/customer/save",
        data: {
            line_id: line_id,
            username: name.val(),
            branch: branch.val(),
            phone_number: phone.val(),
            code: code.val(),
        },
        dataType: "json",
        success: function(e) {
            if(e == 'error')  {
                name.addClass("is-danger");
                branch.addClass("is-danger");
                phone.addClass("is-danger");
            }
          if(e == 'incorrect')  {
              code.addClass("is-danger");
          }
          if(e == 'success') {
            window.location.replace("/")
          } else {
            $("#save").removeClass("is-loading")
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
          $("#save").removeClass("is-loading")
          toastr.error("มีบางอย่างผิดปกติ กรุณาลองใหม่อีกครั้ง", {
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
