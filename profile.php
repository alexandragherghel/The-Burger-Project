<?php
session_start();
include('header.php');
$user = array();
if(isset($_SESSION['email'])) {
    $user = get_users_info($con, $_SESSION['email']);
    $ghilimele = "'";
    $email = $ghilimele . $user['email'] . $ghilimele;
    $lista_comenzi_user = $Comenzi->getUserData("$email");


    if ($_SERVER['REQUEST_METHOD'] == "POST") {
        if (isset($_POST["logout"])) {
            echo "s-a apsat logout";
            session_unset();
            session_destroy();
            session_write_close();
            setcookie(session_name(), '', 0, '/');
            session_regenerate_id(true);
            header('location: login.php');
        }
    }
}
?>
<body>
<?php
if($_SESSION['email']=="administrator@givmail.com") {
    include('navbar_admin.php');
}else if(substr($_SESSION['email'],-19)=="chelner@givmail.com") {
    include('navbar_waiter.php');
}else{
    include('navbar.php');
}
?>
<div class="container" id="profile-details">
    <form method="post">
    <div class="row text-center header-padding">
        <div class="col d-flex justify-content-md-center align-items-md-center col-sm-4 order-sm-2 offset-sm-4 order-1 col-8">
            <h4 class="profile-heading" style="margin-bottom: 3px;">account details</h4>
        </div>
        <div class="col d-flex justify-content-sm-end justify-content-xl-end order-md-3 order-3 col-md-4 col-4" style="padding-right: 0px;"><a class="btn btn-primary d-flex justify-content-center align-items-center justify-content-xl-center btn-custom2" role="button" href="editProfile.php">edit</a></div>
    </div>
    <div class="row contact-div" style="margin-top: -10px;">
        <div class="col col-sm-4 col-4 offset-sm-2"><span class="profile-span-label">Name</span></div>
        <div class="col col-sm-4 col-8"><span class="profile-span"><?php echo isset($user['username']) ? $user['username'] : ''; ?></span></div>
    </div>
    <div class="row contact-div">
        <div class="col col-sm-4 col-4 offset-sm-2"><span class="profile-span-label">Gender</span></div>
        <div class="col col-sm-4 col-8"><span class="profile-span"><?php echo isset($user['gender']) ? $user['gender'] : 'nespecificat'; ?></span></div>
    </div>
    <div class="row contact-div">
        <div class="col col-sm-4 col-4 offset-sm-2"><span class="profile-span-label">Date of Birth</span></div>
        <div class="col col-sm-4 col-8"><span class="profile-span"><?php echo isset($user['birthday']) ? $user['birthday'] : 'nespecificat'; ?></span></div>
    </div>
    <div class="row contact-div" style="padding-bottom: 35px;">
        <div class="col col-sm-4 col-4 offset-sm-2"><span class="profile-span-label">Contact</span></div>
        <div class="col col-sm-4 col-8"><span class="text-break profile-span"><?php echo isset($user['email']) ? $user['email'] : ''; ?></span></div>
    </div>
    <div class="row">
        <div class="col d-flex justify-content-center align-items-center"><button name="logout" class="btn btn-primary d-flex justify-content-center align-items-center btn-custom" type="submit"">log out</button></div>
    </div>
    </form>
</div>
<?php
if($_SESSION['email']!="administrator@givmail.com" && substr($_SESSION['email'],-19)!="chelner@givmail.com") {
?>
    <div class="container" id="profile-history">
    <h3 class="profile-heading" style="margin-bottom: 35px;">history</h3>
    <div class="row header-row">
        <div class="col col-sm-2 order-1 order-sm-1 col-2">
            <p>date</p>
        </div>
        <div class="col col-sm-3 order-2 order-sm-2 col-5">
            <p>product name</p>
        </div>
        <div class="col col-sm-4 col-10 order-5 order-sm-3 offset-sm-0 offset-2">
            <p>details</p>
        </div>
        <div class="col text-right col-sm-2 order-4 order-sm-3 col-3 history-price">
            <p>price</p>
        </div>
        <div class="col col-sm-1 order-4 order-sm-5 col-2 qt">
            <p>qt</p>
        </div>
    </div>
    <?php foreach ($lista_comenzi_user as $item) {?>
    <div class="row">
        <div class="col col-sm-2 order-1 order-sm-1 col-2">
            <p><?php echo $item['data']?></p>
        </div>
        <div class="col text-uppercase col-sm-3 order-2 order-sm-2 col-5">
            <p><?php echo $item['nume']?></p>
        </div>
        <div class="col col-sm-4 col-9 order-5 order-sm-3 offset-sm-0 offset-2">
            <p><?php echo $item['descriere']?><br></p>
        </div>
        <div class="col text-right col-sm-2 order-4 order-sm-3 col-3 history-price">
            <p><?php echo $item['pret']?> lei</p>
        </div>
        <div class="col col-sm-1 order-4 order-sm-5 col-2 qt">
            <p><?php echo $item['cantitate']?></p>
        </div>
    </div>
    <?php }?>
</div>
<?php } ?>
<?php
include('footer.php');?>