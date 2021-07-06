<?php
session_start();
include('header.php');
?>
<?php
$curPageName = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1,-4);
$preturi = [];
$ingred = [];
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if(isset($_POST["submit"])) {
        if(isset($_COOKIE["shopping_cart"]))
        {
            $cookie_data = stripslashes($_COOKIE['shopping_cart']);

            $cart_data = json_decode($cookie_data, true);
        }
        else
        {
            $cart_data = array();
        }
        $ckarr = $_POST["ingrediente"];
        if(isset($ckarr)){
            foreach ($ckarr as $item){
                $temp=explode(",",$item);
                array_push($preturi, $temp[0]);
                array_push($ingred, $temp[1]);

            }
            $descriere=implode(",",$ingred);
            $pret=getSum($preturi);
            $ghilimele="'";
            $date=date('d-m-y h:i:s');
            $var1=time();
            $var2=getmypid();
            $var3=$var2+$var1;
            $arr=array(
                "item_id"=>$var3,
                "nume"=>$ghilimele.$curPageName.$ghilimele,
                "pret"=>$pret,
                "imagine"=>"'./media/bg1.jpg'",
                "register"=>$ghilimele.$date.$ghilimele,
                "descriere"=>$ghilimele.$descriere.$ghilimele,
                "tip"=>"'personalizare'"
            );
            $result = $produs->insertIntoProdus($arr);
            $item_array=array(
                "item_id"=>$var3,
                "nume"=>$curPageName,
                "pret"=>$pret,
                "descriere"=>$descriere,
                'cantitate' => 1,
                "imagine"=>'./media/bg1.jpg'
            );
            print_r($item_array);
            $cart_data[]=$item_array;
            $item_data = json_encode($cart_data);
            setcookie('shopping_cart', $item_data, time() + 3600);

        }

    }
}
?>
<body>
<?php include('navbar.php');?>


<form class="form-class" method="post">

<?php
$xml=new DomDocument("1.0"."UTF-8");
$xml->load('personalizare.xml');
$produs=$xml->getElementsByTagName("produs");
foreach ($produs as $prod){
$nume_produs=$prod->getElementsByTagName('titlu')->item(0)->nodeValue;
  if($nume_produs==$curPageName){
?>
    <section id="section-title">
        <div class="container">
            <div class="form-row">
                <div class="col">
                    <h4 class="title-slick">
                    <?php
                            print_r($nume_produs);
                   ?>
                    </h4>
                </div>
            </div>
        </div>
    </section>
      <?php $ingredient=$prod->getElementsByTagName("ingredient");
      foreach ($ingredient as $ingred) {?>
    <section>
        <div class="container">
            <div class="form-row first-row">
                <div class="col text-right col-md-1 offset-md-2 col-sm-1 offset-sm-1 col-1 offset-0"><img class="customs-icon" src="assets/img/Icons/products/bread.svg"></div>
                <div class="col col-md-2 col-sm-3 col-10 padding-adjust">
                    <h5 class="slick-weight"><?php
                        print_r($ingred->getElementsByTagName('nume')->item(0)->nodeValue);
                        ?></h5>
                </div>

                <div class="col offset-sm-0 col-md-3 col-sm-3 offset-1 col-8">
                </div>
                <div class="col col-md-3 offset-md-0 price-customs">
                    <p></p>
                </div>
            </div>
          <?php
          $optiuni=$ingred->getElementsByTagName("optiuni");
          foreach($optiuni as $opt) {
          ?>
            <div class="form-row">
                <div class="col text-right col-md-1 offset-md-2 col-sm-1 offset-sm-1 col-1 offset-0">
                    <div></div>
                </div>
                <div class="col col-md-2 col-sm-3 col-10 padding-adjust">
                    <div></div>
                </div>
          <?php
              $denumire=$opt->getElementsByTagName("denumire");
              $pret=$opt->getElementsByTagName("pret");
              ?>
                <div class="col offset-sm-0 col-md-3 col-sm-3 offset-1 col-8">
                    <div class="form-check"><input class="form-check-input" type="checkbox" id="a2" name="ingrediente[]" value="<?php
                        $p=$pret->item(0)->nodeValue;
                        $d=$denumire->item(0)->nodeValue;
                        echo "$p".","."$d"; ?>" ><label class="form-check-label" for="a2"><?php print_r($denumire->item(0)->nodeValue); ?></label></div>
<!--                    onclick="sum+=this.value.split(',', 1)[0]; document.getElementById("spaced-span").innerHTML="newtext";"-->
                </div>
                <div class="col col-md-3 offset-md-0 price-customs">
                    <p> <?php echo "$p"; ?> Lei</p>
                </div>
            </div>
              <?php }?>
        </div>

    </section>
    <?php }}}?>
    <div class="d-flex justify-content-end align-items-center align-items-sm-center fixed-bottom overview-section">
        <div class="container d-flex justify-content-end align-items-center">
            <div class="text-center d-flex justify-content-center align-items-center">
                <!--                <p class="d-sm-flex total-amount">total<span class="spaced-span" >lei</span></p>-->
            </div><button name="submit" class="btn btn-primary add-to-cart" type="submit">add to cart</button>
        </div>
    </div>
</form>

<?php
    include('footer.php'); ?>