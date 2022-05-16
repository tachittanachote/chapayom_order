var username_line = 'undefined';
var ele_check = $("#checking");
var ele_name = $("#nickname");
var ele_location = $("#location");
var ele_phone = $("#phone_number");
var app = $("#app");

window.onload = function() {
    const defaultLiffId = "1653603515-dM2LVvkZ"; // change the default LIFF value if you are not using a node server

    let myLiffId = "1653603515-dM2LVvkZ";

    myLiffId = defaultLiffId;
    initializeLiffOrDie(myLiffId);

    app.css("display", "none");
    if (!liff.isInClient()) {
        app.empty();
    }
    ele_check.css('display', 'block');
    ele_check.css('background-image', 'url(https://chapayom.com/wp-content/uploads/2017/09/CPYLOADS.gif)');
    ele_check.css('background-position', 'center center');
    ele_check.css('background-repeat', 'no-repeat');
    ele_check.css('background-attachment', 'fixed');
    ele_check.css('background-size', '40vh 40vh');

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

    console.log("Initializing LIFF V2.");

    liff.init({
            liffId: myLiffId
        })
        .then(() => {
            initializeApp();
            console.log("Initialize finised.");
        })
        .catch((e) => {
          console.log("Initialize failed.");
        });
}

function initializeApp() {

    var _username = null;
    var _location =  null;
    var _phone_number = null;

    console.log("Getting user infomation ...");

    liff.getProfile().then(function(profile) {

        username_line = profile.displayName;

        setMessageByElement('userName', profile.displayName);
        document.getElementById('userImg').src = profile.pictureUrl;

        var line_id = profile.userId;

        //alert(line_id)

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/customer",
            data: {
                user_id: line_id
            },
            success: function(e) {
              if(e == 'null') {
                window.location.replace("/customer")
              }else{
                  app.css("display", "block");
                  ele_check.css('display', 'none');
                  ele_check.css('background-image', '');
                  ele_check.css('background-position', '');
                  ele_check.css('background-repeat', '');
                  ele_check.css('background-attachment', '');
                  ele_check.css('background-size', '');

                  $.ajax({
                      type: "POST",
                      url: "/profile/login",
                      data: {
                          line_id: line_id
                      },
                      success: function(e) {
                          if(e == 'success'){

                              $.ajax({
                                  type: "GET",
                                  url: "/customer/get",
                                  success: function(e) {
                                      if(e != 'null') {
                                          ele_name.text(e['name'])
                                          ele_location.text(e['branch'])
                                          ele_phone.text(e['phone_number'])

                                          _username = e['name'];
                                          _location = e['branch'];
                                          _phone_number = e['phone_number'];
                                      }
                                  }
                              });

                              /*toastr.success("เข้าสู่ระบบเรียบร้อย", {
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
                              });*/
                              console.log('User Authenticated.')
                          }
                          if(e == 'log'){
                              /*toastr.success("ยืนยันตัวตนเรียบร้อย", {
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
                              });*/

                              $.ajax({
                                  type: "GET",
                                  url: "/customer/get",
                                  success: function(e) {
                                      if(e != 'null') {
                                          ele_name.text(e['name'])
                                          ele_location.text(e['branch'])
                                          ele_phone.text(e['phone_number'])

                                          _username = e['name'];
                                          _location = e['branch'];
                                          _phone_number = e['phone_number'];
                                      }
                                  }
                              });

                              console.log('User Authenticated.')
                          }
                      },
                      error: function(e) {
                          alert("บริการเกิดข้อขัดข้อง")
                      }
                  });


              }
            }
        });

    }).catch(function(e) {
        alert("บริการเกิดข้อขัดข้อง")
    });

}
