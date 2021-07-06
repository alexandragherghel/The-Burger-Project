<?php
if (isset($_POST['proceed-to-buy'])) {
    if($_POST['noTable']!=""){
        if($cart_data!=null){
            foreach($cart_data as $keys=>$values){
                $Comenzi->addToComenzi($_POST['noTable'], $values['item_id'],$values['cantitate'], $email,$values['pret']);
            }}
        setcookie("shopping_cart", "", time() - 3600);
    }else{?>
        <script>
            alert("Introduceti numarul mesei!");
        </script>
        <?php
    }
}
?>
<div class="modal fade modal right fade" role="dialog" tabindex="-1" id="cart-modal">
    <div class="modal-dialog modal-dialog-slideout" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Your Cart&nbsp; &nbsp;&nbsp;</h4><svg xmlns="http://www.w3.org/2000/svg" width="1em" height="1em" viewBox="0 0 16 16" fill="currentColor" class="bi bi-x d-flex" id="modal-exit" type="button" data-dismiss="modal" aria-label="Close">
                    <path fill-rule="evenodd" d="M4.646 4.646a.5.5 0 0 1 .708 0L8 7.293l2.646-2.647a.5.5 0 0 1 .708.708L8.707 8l2.647 2.646a.5.5 0 0 1-.708.708L8 8.707l-2.646 2.647a.5.5 0 0 1-.708-.708L7.293 8 4.646 5.354a.5.5 0 0 1 0-.708z"></path>
                </svg><button type="button" class="close" data-dismiss="modal" aria-label="Close" id="delete-this-button" style="height:0px;width:0px;"><span aria-hidden="false">×</span></button>
            </div>
            <div class="modal-body" style="padding-bottom: 40px;">
                <?php if($cart_data!=null){
                foreach($cart_data as $keys=>$values) {?>
                <div class="container modal-cont-prod">
                    <div class="d-flex product-flex">
                        <div class="modal-product-pic menu-icon-cat icon-dessert"></div>
                        <div class="mod-product-description">
                            <h6 class="modal-product-name"><?php echo $values['nume']?></h6>
                            <p class="price modal-product-price"><?php echo $values['pret']?></p>
                            <form method="post">
                                <input type="hidden" value="<?php echo $values['item_id']??0 ?>" name="item_id">
                                <button class="btn btn-primary remove-btn" type="submit" name="delete-cart-submit">Remove</button>
                            </form>
                        </div>
                        <div><input class="form-control-lg input-quantity" type="number" style="width: 75px;border-radius: 0;" value=<?php echo $values['cantitate']?> disabled></div>
                    </div>
                </div>
                    <?php
                    $total=$total+$values['pret']*$values['cantitate'];
                    $count=$count+$values['cantitate'];
                    $total2=$total;
                    if(isset($_SESSION['email'])){
                        $total=$total*0.9;
                    }
                }}
                ?>
            </div>
            <div class="modal-footer">
                <form method="post">
                    <div class="d-flex justify-content-between" id="modal-footer-text">
                        <div class="d-flex justify-content-between modal-footer-row">
                            <p>Initial price</p>
                            <p class="price initial-price"><?php echo isset($total)? $total:0?> lei</p>
                        </div>
                        <div class="d-flex justify-content-between modal-footer-row">
                            <p>Subtotal</p>
                            <p id="discounted-price" class="price"><?php echo isset($total)? $total:0?> lei</p>
                        </div>
                        <div class="d-flex justify-content-between align-items-start modal-footer-row">
                            <p>Table number</p><input type="number" name="noTable" class="modal-input-quantity" style="margin-right: 0;">
                        </div>
                    </div>

                    <div>
                        <button class="btn btn-dark add-to-cart" id="proceed-buy-btn" type="submit" name="proceed-to-buy">proceed to buy</button>
                    </div>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<nav class="navbar navbar-light navbar-expand-lg fixed-top navigation-clean">
    <div class="container-fluid">
        <div class="container d-flex justify-content-start" id="nav-main" style="max-width: 1100px;">
            <a class="navbar-brand mr-auto" ><i class="fas fa-hamburger"></i>&nbsp;TBG</a><button class="btn btn-dark text-uppercase" id="nav-cart-button" type="button" data-toggle="modal" data-target="#cart-modal">Cart <?php echo isset($count)? $count:0;?></button><button data-toggle="collapse" class="navbar-toggler" data-target="#navcol-1"><span class="sr-only">Toggle navigation</span><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navcol-1">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item"><a class="nav-link" href="index.php">Home</a></li>
                    <li class="nav-item"><a class="nav-link" href="menu.php">Menu</a></li>
                    <li class="nav-item dropdown"><a class="dropdown-toggle nav-link" aria-expanded="false" data-toggle="dropdown" href="#">Customs</a>
                        <?php
                        $xml=new DomDocument("1.0"."UTF-8");
                        $xml->load('meniu.xml');
                        $buton=$xml->getElementsByTagName("buton");?>
                        <div class="dropdown-menu dropdown-menu-left">
                            <?php
                            foreach ($buton as $buton){
                            $pag_name=$buton->nodeValue;?>
                            <a class="dropdown-item nav-dropdown" href="<?php echo "$pag_name".".php";?>"><?php print_r($pag_name)?></a>
                            <?php }?></div>
                    </li>
                    <li class="nav-item"><a class="nav-link" href="contact.php" style="margin-right: 1px;">Contact</a></li>
                    <?php if(isset($_SESSION['email'])){
                        echo '  <li class="nav-item"><a class="nav-link" href="profile.php">Account</a></li>';
                    }else{
                        echo '  <li class="nav-item"><a class="nav-link" href="register.php">Register</a></li>';
                    }?>

                </ul>
            </div>
        </div>
    </div>
</nav>