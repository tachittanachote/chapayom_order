var username_line = 'undefined';

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

        username_line = profile.displayName;

    }).catch(function(e) {
        console.log(e);
    });
}

function closeApp() {
  liff.closeWindow();
}

function countDown(i, callback) {
    callback = callback || function(){};
    var int = setInterval(function() {
        document.getElementById("timeout").innerHTML = i;
        i-- || (clearInterval(int), callback());
    }, 1000);
}

$('#close, #close_k, #close_p').on('click', function(e) {
  e.preventDefault();
  liff.closeWindow();
});

document.querySelectorAll('.modal-button').forEach(function(el) {
  el.addEventListener('click', function() {
    var target = document.querySelector(el.getAttribute('data-target'));

    target.classList.add('is-active');

    target.querySelector('.modal-close').addEventListener('click',   function() {
        target.classList.remove('is-active');
     });
  });
});
