!function(e){var n={};function t(o){if(n[o])return n[o].exports;var a=n[o]={i:o,l:!1,exports:{}};return e[o].call(a.exports,a,a.exports,t),a.l=!0,a.exports}t.m=e,t.c=n,t.d=function(e,n,o){t.o(e,n)||Object.defineProperty(e,n,{enumerable:!0,get:o})},t.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},t.t=function(e,n){if(1&n&&(e=t(e)),8&n)return e;if(4&n&&"object"==typeof e&&e&&e.__esModule)return e;var o=Object.create(null);if(t.r(o),Object.defineProperty(o,"default",{enumerable:!0,value:e}),2&n&&"string"!=typeof e)for(var a in e)t.d(o,a,function(n){return e[n]}.bind(null,a));return o},t.n=function(e){var n=e&&e.__esModule?function(){return e.default}:function(){return e};return t.d(n,"a",n),n},t.o=function(e,n){return Object.prototype.hasOwnProperty.call(e,n)},t.p="/",t(t.s=3)}({3:function(e,n,t){e.exports=t("hhIK")},hhIK:function(e,n){var t="undefined";window.onload=function(){(function(e){e?(!function(e){liff.init({liffId:e}).then((function(){liff.getProfile().then((function(e){t=e.userId})).catch((function(e){console.log(e)}))})).catch((function(e){console.log(e)}))}(e),console.log("OK!")):(n="app",o="Service is unavailable. Please check your LIFF ID.",document.getElementById(n).innerHTML=o);var n,o})("1653603515-dM2LVvkZ")},$("#name").on("touchmove",(function(e){e.preventDefault()})),$("#branch").on("touchmove",(function(e){e.preventDefault()})),$("#phone").on("touchmove",(function(e){e.preventDefault()})),$("#phone").on("keypress keyup blur",(function(e){$(this).val($(this).val().replace(/[^\d].+/,"")),(e.which<48||e.which>57)&&e.preventDefault()})),$("#save").on("click",(function(e){e.preventDefault(),$("#save").addClass("is-loading");var n=$("#name"),o=$("#branch"),a=$("#phone"),r=$("#code");if(!n.val()||!o.val()||!a.val())return $("#save").removeClass("is-loading"),toastr.warning("กรุณาระบุข้อมูลให้ครบถ้วน",{closeButton:!0,debug:!1,newestOnTop:!1,progressBar:!0,positionClass:"toast-bottom-center",preventDuplicates:!1,onclick:null,showDuration:"300",hideDuration:"1000",timeOut:"5000",extendedTimeOut:"1000",showEasing:"swing",hideEasing:"linear",showMethod:"fadeIn",hideMethod:"fadeOut"});$.ajaxSetup({headers:{"X-CSRF-TOKEN":$('meta[name="csrf-token"]').attr("content")}}),$.ajax({type:"POST",url:"/customer/save",data:{line_id:t,username:n.val(),branch:o.val(),phone_number:a.val(),code:r.val()},dataType:"json",success:function(e){"error"==e&&(n.addClass("is-danger"),o.addClass("is-danger"),a.addClass("is-danger")),"incorrect"==e&&r.addClass("is-danger"),"success"==e?window.location.replace("/"):($("#save").removeClass("is-loading"),toastr.warning("ข้อมูลไม่ถูกต้อง",{closeButton:!0,debug:!1,newestOnTop:!1,progressBar:!0,positionClass:"toast-bottom-center",preventDuplicates:!1,onclick:null,showDuration:"300",hideDuration:"1000",timeOut:"5000",extendedTimeOut:"1000",showEasing:"swing",hideEasing:"linear",showMethod:"fadeIn",hideMethod:"fadeOut"}))},error:function(e){$("#save").removeClass("is-loading"),toastr.error("มีบางอย่างผิดปกติ กรุณาลองใหม่อีกครั้ง",{closeButton:!0,debug:!1,newestOnTop:!1,progressBar:!0,positionClass:"toast-bottom-center",preventDuplicates:!1,onclick:null,showDuration:"300",hideDuration:"1000",timeOut:"5000",extendedTimeOut:"1000",showEasing:"swing",hideEasing:"linear",showMethod:"fadeIn",hideMethod:"fadeOut"})}})}))}});