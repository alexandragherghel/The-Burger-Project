<?php
    session_start();
include('header.php');
$pozitie_random=array_rand($burger_shuffle,3);
$pozitie_random2=array_rand($desert_shuffle,3);


if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['burgeri-submit'])){
        if(isset($_COOKIE["shopping_cart"]))
        {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);

            $cart_data = json_decode($cookie_data, true);
        }
        else
        {
            $cart_data = array();
        }

        $item_array = array(
            'item_id' => $_POST['hidden_id'],
            'nume' => $_POST['hidden_name'],
            'pret' =>$_POST['hidden_price'],
            'descriere' =>$_POST['hidden_description'],
            'cantitate' => 1,
            'imagine' =>$_POST['hidden_img']
        );
        $nr=0;
        foreach($cart_data as $keys=>$values)
        {
            if($values['item_id']==$_POST['hidden_id']){
                $nr++;
            }
        }
        if($nr==0)
        {
            $cart_data[]=$item_array;
        } else {
            foreach($cart_data as $keys=>$values)
            {
                if($cart_data[$keys]['item_id'] == $_POST['hidden_id']){
                    $cart_data[$keys]['cantitate'] ++;
                }
            }
        }
        $item_data = json_encode($cart_data);
        setcookie('shopping_cart', $item_data, time() + 3600);
    }
    if (isset($_POST['desert-submit'])){
        if(isset($_COOKIE["shopping_cart"]))
        {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);

            $cart_data = json_decode($cookie_data, true);
        }
        else
        {
            $cart_data = array();
        }
        $item_array = array(
            'item_id' => $_POST['hidden_id'],
            'nume' => $_POST['hidden_name'],
            'pret' =>$_POST['hidden_price'],
            'descriere' =>" ",
            'cantitate' => 1,
            'imagine' =>$_POST['hidden_img']
        );
        $nr=0;
        foreach($cart_data as $keys=>$values)
        {
            if($values['item_id']==$_POST['hidden_id']){
                $nr++;
            }
        }
        if($nr==0)
        {
            $cart_data[]=$item_array;
        } else {
            foreach($cart_data as $keys=>$values)
            {
                if($cart_data[$keys]['item_id'] == $_POST['hidden_id']){
                    $cart_data[$keys]['cantitate'] ++;
                }
            }
        }
        $item_data = json_encode($cart_data);
        setcookie('shopping_cart', $item_data, time() + 3600);
    }
}
    ?>
    <body>
    <?php include('navbar.php');?>
    <?php $xmlmodif=new DomDocument("1.0"."UTF-8");
        $xmlmodif->load('modificarihome.xml');
        $heroExistent = $xmlmodif->getElementsByTagName("imghero");
        foreach ($heroExistent as $heroExistent){
        ?>
    <?php
    $url=$heroExistent->nodeValue;} ?>
<div data-bss-parallax-bg="true" id="hero-parallax" style=" background: linear-gradient(-156deg, rgba(255,255,255,0.69) 0%, rgba(0,0,0,0.68) 100%), url('<?php echo $url;?>') center / cover;">
    <div class="container text-center d-flex justify-content-center align-items-center" id="hero-container">
        <div class="hero-div">
            <h1 id="hero-heading">The Burger Project</h1>
            <p id="hero-p">The greatest Burger ever, ready in 5 minutes</p>
            <button class="btn btn-light text-uppercase place-order" id="hero-button" type="button" style="padding: 15px 30px;" onclick="location.href='menu.php';">Place Order</button>
        </div>
    </div>
</div>
<section id="welcome-text">
    <div class="container">
        <div class="row">
            <div class="col">
                <?php
                $xmlmodif=new DomDocument("1.0"."UTF-8");
                $xmlmodif->load('modificarihome.xml');
                $titlu= $xmlmodif->getElementsByTagName("titlu");
                $continut= $xmlmodif->getElementsByTagName("continut");?>
                <h1 style="padding-bottom: 10px;font-weight: 300;"><?php    foreach ($titlu as $titlu){echo $titlu->nodeValue;} ?></h1>
                <div class="divider"></div>
            </div>
        </div>
        <div class="row">
            <div class="col" style="margin-top: 18px;">
                <p style="text-align: justify;"><?php    foreach ($continut as $continut){echo $continut->nodeValue;} ?></p>
            </div>
        </div>
    </div>
</section>
<section id="fav-cards">
    <div class="container" id="fav-container">
        <h1 class="text-center main-section-title">Choose your favorite</h1>
        <div class="card-columns">
        <?php foreach ($pozitie_random as $poz) {?>
            <div class="card card-thumb" style="border-width: 0;">
                <div class="div-fav-image" style="background: url(<?php echo $burger_shuffle[$poz]['imagine']?>) center / cover no-repeat;min-height: 252px;"></div>
                <div class="card-body">
                    <h2 class="card-title"><?php echo $burger_shuffle[$poz]['nume']; ?><br></h2>
                    <p class="price"><?php echo $burger_shuffle[$poz]['pret']; echo " LEI"?></p>
                    <p class="card-text card-p"><?php echo $burger_shuffle[$poz]['descriere']?><br></p>
                    <form method="POST">
                        <input type="hidden" name="hidden_img" value="<?php echo $burger_shuffle[$poz]['imagine'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_id" value="<?php echo $burger_shuffle[$poz]['item_id'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_name" value="<?php echo $burger_shuffle[$poz]['nume'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $burger_shuffle[$poz]['pret'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_description" value="<?php echo $burger_shuffle[$poz]['descriere'] ?? '0'; ?>">
                        <button name="burgeri-submit" type="submit" class="btn btn-dark add-to-cart" >add to cart</button>
                    </form>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</section>
<?php
$dayExistent = $xmlmodif->getElementsByTagName("imgDay");
foreach ($dayExistent as $dayExistent){
    $url=$dayExistent->nodeValue;} ?>
<section id="our-recomm" class="fixed-bg" style="background: linear-gradient(-16deg, rgba(0,0,0,0.91) 1%, rgba(109,109,109,0.4) 100%), url('<?php echo $url;?>') center / cover no-repeat fixed;">
    <div class="container">
        <h1 class="recomm-heading">Our Recommendation</h1>
        <h1>Double</h1>
        <p style="margin-bottom: 18px;text-transform: uppercase;">48 lei</p>
        <p style="margin-bottom: 19px;">Ingrediente:&nbsp; chifla clasica, carne de vita, rosii, castraveti murati, ceapa, salata, branza cheddar, sos burger<br><br></p><button class="btn btn-light place-order" type="submit" style="margin-bottom: 30px;">add to cart</button>
    </div>
</section>
<section id="fav-cards-2">
    <div class="container" id="fav-container-1">
        <h1 class="text-center main-section-title" style="margin-top: 50px;">Sweet treats for you</h1>
        <div class="card-columns">
        <?php foreach ($pozitie_random2 as $poz) {?>
            <div class="card card-thumb" style="border-width: 0;">
                <div class="div-fav-image" style="background: url('<?php echo $desert_shuffle[$poz]['imagine']?>') center / cover no-repeat;min-height: 252px;"></div>
                <div class="card-body">
                    <h2 class="card-title"><?php echo $desert_shuffle[$poz]['nume']; ?><br></h2>
                    <p class="price"><?php echo $desert_shuffle[$poz]['pret']?> lei</p>
                    <p class="card-text card-p"><?php echo $desert_shuffle[$poz]['descriere']?><br></p>
                    <form method="POST">
                        <input type="hidden" name="hidden_img" value="<?php echo $desert_shuffle[$poz]['imagine'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_id" value="<?php echo $desert_shuffle[$poz]['item_id'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_name" value="<?php echo $desert_shuffle[$poz]['nume'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $desert_shuffle[$poz]['pret'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_description" value="<?php echo $desert_shuffle[$poz]['descriere'] ?? '0'; ?>">
                        <button name="desert-submit" type="submit" class="btn btn-dark add-to-cart" >add to cart</button>
                    </form>
                </div>
            </div>
        <?php } ?>
        </div>
    </div>
</section>
<section class="newsletter-subscribe">
    <div class="container">
        <div class="intro">
            <h2 class="text-center">Join the Project Club</h2>
            <p class="text-center">Sign up to receive updates from our restaurant, including new prices, surprise discounts and invitations for upcoming events.</p>
        </div>
        <form class="form-inline" method="post">
            <div class="form-group" href="register.html"><a class="btn btn-dark" role="button" href="register.php" style="border-radius: 0px; background-color: black">register</a></div>
        </form>
    </div>
</section>
<footer class="footer-clean">
    <div class="container">
        <div class="row justify-content-center" style="padding-bottom: 30px;">
            <div class="col-sm-4 col-md-3 item">
                <h3>Index</h3>
                <ul>
                    <li><a href="#">Home</a></li>
                    <li><a href="#">About</a></li>
                    <li><a href="#">Contact</a></li>
                    <li><a href="#">Blog</a></li>
                </ul>
            </div>
            <div class="col-sm-4 col-md-3 item">
                <h3>Categories</h3>
                <ul>
                    <li><a href="#">Menu</a></li>
                    <li><a href="#">Customs</a></li>
                    <li><a href="#">Legacy</a></li>
                </ul>
            </div>
            <div class="col-sm-4 col-md-3 item">
                <h3>Help</h3>
                <ul>
                    <li><a href="#">FAQ</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms and Conditions</a></li>
                </ul>
            </div>
        </div>
    </div>
    <p class="text-center copyright" style="padding-left: 56px;padding-right: 0px;">The Burger Project © 2021</p>
</footer>
<?php
include('footer.php');
?>