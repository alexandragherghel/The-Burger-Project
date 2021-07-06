<?php
session_start();
include('header.php');?>
<body>

<section class="login-clean">
    <form class="text-center form-div" method="post">
        <h2 class="sr-only">Login Form</h2>
        <div class="illustration">
            <h1 style="font-size: 22px;margin-bottom: 18px;">LOGIN</h1>
            <p class="login-parag">Welcome back to the Project Club.</p>
            <p class="login-parag">If you don't have an account, register <a href="register.php">here.</a></p>
        </div>
<!--        <button class="btn facebook-btn social-btn" type="submit" id="facebooklogin"><span><i class="fab fa-facebook-f"></i> Sign in with Facebook</span> </button>-->
        <button class="btn google-btn social-btn" type="submit" id="googleLogin"><span><i class="fab fa-google-plus-g"></i> Sign in with Google+</span> </button>
        <div class="form-group"><input id="email" class="form-control" type="email" name="email" placeholder="Email" style="margin-top: 36px;"></div>
        <div class="form-group"><input id="password" class="form-control" type="password" name="password" placeholder="Password"></div><a class="forgot" href="#">Forgot your email or password?</a>
        <div class="form-group d-flex justify-content-center"><button class="btn btn-primary btn-block" id="loginbtn" type="submit">Log In</button></div>
        <div class="form-group d-flex justify-content-center">OR</div>
        <input type="text" id="inputPhone" class="form-control" placeholder="Phone" required="" autofocus="">
        <div id="recaptcha-container"></div>
        <div class="form-group d-flex justify-content-center"><button class="btn btn-primary btn-block" type="button" id="phoneloginbtn"><i class="fas fa-sign-in-alt"></i> Send code</button></div>
        <input type="otp" id="inputOtp" class="form-control" placeholder="Code" required="">
        <div class="form-group d-flex justify-content-center"><button class="btn btn-primary btn-block" type="button" id="verifyotp"><i class="fas fa-sign-in-alt"></i> Verify code</button></div>


    </form>
</section>
    <script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-analytics.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.4.3/firebase-auth.js"></script>
    <script>
        // Your web app's Firebase configuration
        // For Firebase JS SDK v7.20.0 and later, measurementId is optional
        var firebaseConfig = {
            apiKey: "AIzaSyDN1sESAjx4G8Wpa0uCX3V6oYzJskz8hAw",
            authDomain: "fir-login-f2b0c.firebaseapp.com",
            projectId: "fir-login-f2b0c",
            storageBucket: "fir-login-f2b0c.appspot.com",
            messagingSenderId: "966449102111",
            appId: "1:966449102111:web:7585884da2b610c07f442a",
            measurementId: "G-NNCL357CFQ"
        };
        // Initialize Firebase
        firebase.initializeApp(firebaseConfig);
        firebase.analytics();
        var googleLogin=document.getElementById("googleLogin");
        console.log(googleLogin);

        googleLogin.onclick=function(){
            var provider=new firebase.auth.GoogleAuthProvider();

            firebase.auth().signInWithPopup(provider).then(function(response){
                var userobj=response.user;
                var token=userobj.za;
                var provider="Google";
                var email=userobj.email;
                if(token!=null && token!=undefined && token!=""){
                    sendDatatoServerPhp(email,provider,token,userobj.displayName);
                }

                console.log(response);
            })
                .catch(function(error){
                    console.log(error);
                })


        }

        var facebooklogin=document.getElementById("facebooklogin");
        console.log(facebooklogin);
        facebooklogin.onclick=function(){
            var provider=new firebase.auth.FacebookAuthProvider();

            firebase.auth().signInWithPopup(provider).then(function(response){
                var userobj=response.user;
                var token=userobj.za;
                var provider="facebook";
                var email=userobj.email;
                if(token!=null && token!=undefined && token!=""){
                    sendDatatoServerPhp(email,provider,token,userobj.displayName);
                }

                console.log(response);
            })
                .catch(function(error){
                    console.log(error);
                })


        }



        var loginemail=document.getElementById("email");
        var loginpassword=document.getElementById("password");
        var loginbtn=document.getElementById("loginbtn");

        loginbtn.onclick=function (){
            loginbtn.disabled=true;
            loginbtn.textContent="Logging In Please Wait...";
            firebase.auth().signInWithEmailAndPassword(loginemail.value, loginpassword.value).then(function (response){
                console.log(response);
                loginbtn.disabled=false;
                loginbtn.textContent="Log In";
                var userobj=response.user;
                var token=userobj.za;
                var provider="email";
                var email=loginemail.value;
                if(token!=null && token!=undefined && token!=""){
                    sendDatatoServerPhp(email,provider,token,email);
                }

            })
                .catch(function(error){
                    console.log(error);
                    loginbtn.disabled=false;
                    loginbtn.textContent="Log In";
                })
        }

        function sendDatatoServerPhp(email,provider,token,username){
            var xhr = new XMLHttpRequest();

            xhr.addEventListener("readystatechange", function() {
                if(this.readyState === 4) {
                    console.log(this.responseText);
                    if(this.responseText=="Login Successfull" || this.responseText=="User Created"){
                        alert("Login Successfull");
                        location='profile.php';
                    }
                    else if(this.responseText=="Please Verify your Email to Login"){
                        alert("Please Verify Your Email to Login")
                    }
                    else{
                        alert("Error in Login");
                    }
                }
            });

            xhr.open("POST", "http://localhost:8080/TheBurgerProject/loginfb.php?email="+email+"&provider="+provider+"&username="+username+"&token="+token);
            xhr.send();
        }

        var loginphone=document.getElementById("phoneloginbtn");
        var phoneinput=document.getElementById("inputPhone");
        var otpinput=document.getElementById("inputOtp");
        var verifyotp=document.getElementById("verifyotp");

        loginphone.onclick=function (){
            window.recaptchaVerifier = new firebase.auth.RecaptchaVerifier('recaptcha-container', {
                'size': 'normal',
                'callback': (response) => {
                    // reCAPTCHA solved, allow signInWithPhoneNumber.
                    // ...
                },
                'expired-callback': () => {
                    // Response expired. Ask user to solve reCAPTCHA again.
                    // ...
                }
            });

            var cverify=window.recaptchaVerifier;
            firebase.auth().signInWithPhoneNumber(phoneinput.value,cverify).then(function (response){
                console.log(response);
                window.confirmationResult=response;
            }).catch(function (error){
                console.log(error);
            })
        }

        verifyotp.onclick=function (){
            confirmationResult.confirm(otpinput.value).then(function(response){
                console.log(response);
                var userobj=response.user;
                var token=userobj.za;
                var provider="phone";
                var email=phoneinput.value;
                if(token!=null && token!=undefined && token!=""){
                    sendDatatoServerPhp(email,provider,token,email);
                }
            })
                .catch(function (error){
                    console.log(error);
                })
        }




    </script>
<?php
include('footer.php');?>