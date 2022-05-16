(function($) {
    $.fn.inputFilter = function(inputFilter) {
        return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
            if (inputFilter(this.value)) {
                this.oldValue = this.value;
                this.oldSelectionStart = this.selectionStart;
                this.oldSelectionEnd = this.selectionEnd;
            } else if (this.hasOwnProperty("oldValue")) {
                this.value = this.oldValue;
                this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
            } else {
                this.value = "";
            }
        });
    };
}(jQuery));

function Robot() {
    return this.name = Robot.makeId();
}

Robot.nums = Array.from({
    length: 10
}, (_, i) => i);
Robot.chars = Array.from({
    length: 26
}, (_, i) => String.fromCharCode(65 + i));
Robot.idmap = {};
Robot.makeId = function() {
    var text = Array.from({
            length: 2
        }, _ => Robot.chars[~~(Math.random() * 26)]).join("") +
        Array.from({
            length: 3
        }, _ => Robot.nums[~~(Math.random() * 10)]).join("");
    return !Robot.idmap[text] ? (Robot.idmap[text] = true, text) : Robot.makeId();
};

var genOrderNumber = Robot();

$("#order_id").text(genOrderNumber);

$("[id^=item-]").inputFilter(function(value) {
    return /^\d*$/.test(value);
});

$('[id^=item-]').on('input propertychange paste', function(e) {
    var reg = /^0+/gi;
    if (this.value.match(reg)) {
        this.value = this.value.replace(reg, '');
    }
});

function getCost(n) {
    return Number(parseFloat(n)).toLocaleString('en');
}

function getLastDigits(s) {
    return s.match(/\d+$/)[0];
}

function whichAnimationEvent() {
    var t,
        el = document.createElement("fakeelement");

    var animations = {
        "animation": "animationend",
        "OAnimation": "oAnimationEnd",
        "MozAnimation": "animationend",
        "WebkitAnimation": "webkitAnimationEnd"
    }

    for (t in animations) {
        if (el.style[t] !== undefined) {
            return animations[t];
        }
    }
}

var animationEvent = whichAnimationEvent();

$(document).ready(function() {

    var t = [];
    var map = new Map();

    $("[id^=item-]").each(function() {

        var clicked_btn = $(this).attr('id');
        var item_id = getLastDigits(clicked_btn);

        t[item_id] = 0;


    });

    $("#profile").on('click', function(e) {
        window.location.replace('/profile');
    });

    $("#confirm").on('click', function(e) {
        e.preventDefault();

        var pay_option = $("input[name='payoption']:checked").val();
        var comment = $.trim($("#comment").val());

        if (pay_option) {
            next_();

        } else {
            toastr.error("กรุณาเลือกช่องทางการชำระเงิน", {
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

        function next_() {

            $("#loading").css('display', 'block');
            $("#e_total_price").css('display', 'none');
            $("#e_confirm").css('display', 'none');

            var summary = [];

            map.forEach( (value, key, map) => {

              var fields = value.split('|');

              var list = {
                item_name: key,
                total_price: fields[0],
                total_order: fields[1],
              }

              summary.push(list)

            });

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type: "POST",
                url: "/confirm?order_id=" + $("#order_id").text(),
                data: {
                  order_list: JSON.stringify(summary),
                  order_comment: comment,
                  order_payoption: pay_option
                },
                success: function(e) {
                    $("#loading").css('display', 'none');
                    window.location.replace(e + "?order_id=" + $("#order_id").text());
                },
                error: function(e) {
                    $("#e_total_price").css('display', 'block');
                    $("#e_confirm").css('display', 'block');
                    $("#loading").css('display', 'none');

                    toastr.error("เกิดข้อผิดพลาด กรุณาลองใหม่อีกครั้ง.", {
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
        }

    });

    $("#back").on('click', function(e) {
        var prod_list = $('#prod_list');
        var summary_bar = $('#summary-bar');
        var confirm_bar = $('#confirm-bar');
        var nav_bar_s = $('#sa-s');
        var nav_bar_c = $('#sa-c');
        var purchase_list = $('#purchase_list');

        nav_bar_c.addClass("animated fadeOutDown fast");
        nav_bar_c.one(animationEvent,
            function(event) {
                summary_bar.css("display", "block");
                prod_list.css("display", "block");
                confirm_bar.css("display", "none");
                nav_bar_c.removeClass("animated fadeOutDown fast");

                nav_bar_s.addClass("animated fadeInUp fast");
                nav_bar_s.one(animationEvent,
                    function(event) {
                        nav_bar_s.removeClass("animated fadeInUp fast");
                    }
                );

            }
        );

        purchase_list.css("display", "none");

    });

    $("#cart").on('click', function(e) {
        e.preventDefault();

        var prod_list = $('#prod_list');
        var nav_bar_s = $('#sa-s');
        var nav_bar_c = $('#sa-c');
        var confirm_bar = $('#confirm-bar');
        var summary_bar = $('#summary-bar');
        var purchase_list = $('#purchase_list');

        prod_list.addClass("animated fadeOutUp fast");

        prod_list.one(animationEvent,
            function(event) {
                prod_list.css("display", "none");
                prod_list.removeClass("animated fadeOutUp fast");
                confirm_bar.css("display", "block");
            }
        );

        nav_bar_s.addClass("animated fadeOutDown fast");
        nav_bar_s.one(animationEvent,
            function(event) {
                summary_bar.css("display", "none");
                nav_bar_s.removeClass("animated fadeOutDown fast");
            }
        );

        nav_bar_c.addClass("animated fadeInUp fast");
        nav_bar_c.one(animationEvent,
            function(event) {
                nav_bar_c.removeClass("animated fadeInUp fast");
            }
        );

        purchase_list.css("display", "block");
        $('html, body').animate({
            scrollTop: 0
        }, 'slow');


        var summary = [];

        map.forEach((value, key, map) => {

            var fields = value.split('|');

            var list = {
                item_name: key,
                total_price: fields[0],
                total_order: fields[1],
            }

            summary.push(list)

        });

        $('#purchase_list_t tbody').empty();
        var total_price = 0;

        for (var i = 0; i < summary.length; i++) {
            total_price = Number(total_price) + Number(summary[i].total_price)
            $('#purchase_list_t > tbody:last-child').append('<tr>' + '<td><center>' + summary[i].total_order + '</center></td>' + '<td>' + summary[i].item_name + '</td>' + '<td>' + getCost(summary[i].total_price) + '.-</td>' + '</tr>');
        }

        $("#total_price").text(getCost(total_price));

        //console.log(JSON.stringify(summary))

        /*$.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            type: "POST",
            url: "/cart",
            data: JSON.stringify(summary),
            contentType: "application/json",
            success: function(e) {
                alert(e);
            },
            error: function(e) {
                alert(e);
            }
        });*/

    });

    $("[id^=dis-item-]").on('click', function() {
        var clicked_btn = $(this).attr('id');
        var item_id = getLastDigits(clicked_btn);
        var get_price = $("#price-item-" + item_id).text();

        if ($("#item-" + item_id).val() == 1 || $("#item-" + item_id).val() == "" || $("#item-" + item_id).val() == 0) {

            t[item_id] = 0;
            if (t[item_id] == 0) {
                map.delete($("#item-" + item_id).attr("data-name"))
            }

            $("#item-" + item_id).val(0).trigger('input');

        } else {

            $("#item-" + item_id).val($("#item-" + item_id).val() - 1).trigger('input');

            var get_value = $("#item-" + item_id).val();

            var tempt_v = 1 * parseInt(get_price);
            t[item_id] = t[item_id] - parseInt(tempt_v);

            map.set($("#item-" + item_id).attr("data-name"), t[item_id] + "|" + get_value);
        }

    });

    $("[id^=add-item-]").on('click', function() {

        var clicked_btn = $(this).attr('id');
        var item_id = getLastDigits(clicked_btn);
        var get_price = $("#price-item-" + item_id).text();

        var tempt_v = 1 * parseInt(get_price);
        var get_value = $("#item-" + item_id).val();
        get_value++;

        t[item_id] = t[item_id] + parseInt(tempt_v);
        map.set($("#item-" + item_id).attr("data-name"), t[item_id] + "|" + get_value);

        $("#item-" + item_id).val(get_value).trigger('input');

    });

    $("[id^=item-]").on('input', function(e) {

        if (!e.isTrigger) {

            var clicked_btn = $(this).attr('id');
            var item_id = getLastDigits(clicked_btn);
            var get_price = $("#price-item-" + item_id).text();

            var item_input = this.value * parseInt(get_price);
            t[item_id] = parseInt(item_input);

            map.set($(this).attr("data-name"), t[item_id] + "|" + this.value);

        }

        var arr = [];
        var item = 0;

        var count = 0;

        $("[id^=item-]").each(function() {

            if ($(this).val() > 0) {
                var get_item_amount = $(this).val();
                count = parseInt(count) + parseInt(get_item_amount)
            }

            arr.push(this.value)

            for (var i = 0; i < arr.length; i++) {
                if (arr[i] > 0) {
                    item++
                }
            }
        });

        if (item > 0) {
            $("#summary-bar").css("display", "block").queue(function() {
                $("#sa-s").addClass("animated fadeInUp fast");
                $("#sa-s").one(animationEvent,
                    function(event) {
                        $("#sa-s").removeClass("animated fadeInUp fast");
                    }
                );
            });
        } else {
            $("#summary-bar").css("display", "none");
        }

        var total = 0;

        for (var i = 0; i < t.length; i++) {
            if (t[i] != undefined) {
                total = Number(total) + Number(t[i])
            }
        }

        sum = Number(total);

        $("#count").text(count);
        $("#price").text(getCost(sum));

    });

});
