<?php
session_start();
include('header.php');?>
<body>
<?php include('navbar.php');?>
<section class="contact-clean">
     <form method="post" id="formular_review" action="contact.php">
        <h2 class="text-center" style="font-family: Montserrat, sans-serif;font-weight: 300;margin-bottom: 33px;">Contact us</h2>
         <p class="text-center">For inquiries, reviews, complaints, wishes and questions, we would love to hear from you and will answer promptly.</p>
         <div class="form-group d-flex justify-content-center">
             <input class="form-control" type="text" name="name" placeholder="Name" id="name"></div>
         <div class="form-group">
             <input id="email" class="form-control is-invalid" type="email" name="email" placeholder="Email" style="margin: 0 auto;">
             <small class="form-text text-danger" style="padding-left: 52px;">Please enter a correct email address.</small>
         </div>
         <div class="form-group d-flex justify-content-center">
             <textarea id="message" class="form-control" name="message" placeholder="Message" rows="14"></textarea></div>
         <div class="form-group text-center">
<!--             <button class="btn btn-dark send-btn" id="send-message" type="submit" style="color: black;">send </button>-->
             <button class="btn btn-dark send-btn" id="send-message" type="submit" name="submit" style="color: black;">send</button></div>
         <div class="alert alert-success text-center" role="alert" id="success-sent" style="display: none;transition: width 3s;transition-timing-function: ease-in-out;"><span>Message sent successfully. Thank you!</span></div>
    </form>
</section>
    <script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-app.js"></script>
    <script src="https://www.gstatic.com/firebasejs/8.5.0/firebase-database.js"></script>
    <script src="assets/js/contact3.js"></script>
<?php
include('footer.php'); ?>