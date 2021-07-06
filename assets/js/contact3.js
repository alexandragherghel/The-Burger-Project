$('form input').keydown(function (e) {
    if (e.keyCode == 13) {
        e.preventDefault();
        return false;
    }
});

var firebaseConfig = {
    apiKey: "AIzaSyDN1sESAjx4G8Wpa0uCX3V6oYzJskz8hAw",
    authDomain: "fir-login-f2b0c.firebaseapp.com",
    databaseURL: "https://fir-login-f2b0c-default-rtdb.firebaseio.com",
    projectId: "fir-login-f2b0c",
    storageBucket: "fir-login-f2b0c.appspot.com",
    messagingSenderId: "966449102111",
    appId: "1:966449102111:web:7585884da2b610c07f442a",
    measurementId: "G-NNCL357CFQ"
};
// Initialize Firebase
firebase.initializeApp(firebaseConfig);
var refMesaje=firebase.database().ref('reviews');

document.getElementById('formular_review').addEventListener('submit',trimiteFormular);
function trimiteFormular(e) {
    e.preventDefault();
    var nume = getInputVal('name');
    console.log(nume);
    var email = getInputVal('email');
    console.log(email);
    var mesaj = getInputVal('message');
    console.log(mesaj);
    saveMessage(nume,email,mesaj);
    document.querySelector('.alert').style.display='block';
    setTimeout(function (){
        document.querySelector('.alert').style.display='none';
    },3000);

    document.getElementById('formular_review').reset();
}

function getInputVal(id){
    return document.getElementById(id).value;
}

function saveMessage(nume,email,mesaj){
    var newMessageRef=refMesaje.push();
    newMessageRef.set({
        name:nume,
        contact:email,
        message:mesaj
    })
}
