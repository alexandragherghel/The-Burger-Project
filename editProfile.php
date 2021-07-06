<?php
session_start();
include('header.php');
?>

<body>
<?php
$user = array();

if(isset($_SESSION['email'])) {
    $user = get_users_info($con, $_SESSION['email']);
    $ghilimele = "'";
    $email = $ghilimele . $user['email'] . $ghilimele;
    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST["salveaza_profil"])) {
            $ghilimele = "'";
            $nume = $ghilimele . $_POST['nume_profil'] . $ghilimele;
            $data = $ghilimele . $_POST['data_profil'] . $ghilimele;

            if ($_POST['nume_profil'] != "") {
                $Users->updateUsersName("$email", "$nume");
            }else{
                echo "nume profil gol";
            }
            if ($_POST['data_profil'] != "") {
                $Users->updateUsersBirthday("$email", "$data");
            }
            if (isset($_POST['gen'])) {
                $gen = $ghilimele . $_POST["gen"] . $ghilimele;
                $Users->updateUsersGender("$email", "$gen");
            }
        }
    }
}
?>
<?php
if($_SESSION['email']=="administrator@givmail.com") {
    include('navbar_admin.php');
}else if(substr($_SESSION['email'],-19)=="chelner@givmail.com") {
    include('navbar_waiter.php');
}else{
    include('navbar.php');
}
?>
<form method="post">
<div id="holder">
    <div class="container wrapper-fix">
        <div class="row text-center">
            <div class="col" style="padding: 10px;padding-bottom: 20px;">
                <h4 class="profile-heading">edit details</h4>
            </div>
        </div>
        <div class="row contact-div">
            <div class="col-4 col-md-2 offset-md-3 col-sm-2 offset-sm-2"><span class="profile-span-label">Name</span></div>
            <div class="col col-sm-6 col-6 profile-span"><input type="text" class="login-clean form-control profile-span" name="nume_profil"></div>
        </div>
        <div class="row contact-div">
            <div class="col-4 col-md-2 offset-md-3 col-sm-2 offset-sm-2"><span class="profile-span-label">Gender</span></div>
            <div class="col col-sm-4 col-6 profile-span">
                <div class="form-check profile-span"><input class="form-check-input" type="radio" id="formCheck-2" name="gen" value="M"><label class="form-check-label" for="formCheck-2">Male</label></div>
                <div class="form-check profile-span"><input class="form-check-input" type="radio" id="formCheck-1" name="gen" value="F"><label class="form-check-label" for="formCheck-1">Female</label></div>
            </div>
        </div>
        <div class="row contact-div">
            <div class="col-4 col-md-2 offset-md-3 col-sm-2 offset-sm-2"><span class="profile-span-label">Date of Birth</span></div>
            <div class="col col-sm-6 col-6 profile-span"><input class="login-clean form-control" type="date" name="data_profil"></div>
        </div>
    </div>
    <div class="d-flex justify-content-center fixed-row-bottomv3"></div>
</div>
<div class="container">
    <div class="d-flex justify-content-center align-items-center"><button class="btn btn-primary d-flex justify-content-center align-items-center btn-custom" type="submit"  name="salveaza_profil">save</button></div>
</div>
</form>
<?php
include('footer.php');?>