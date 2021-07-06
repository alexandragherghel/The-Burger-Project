<?php
session_start();
include('header.php');
if (isset($_POST['burgeri-meniu-submit'])){
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
?>
<body class="text-dark">
<?php include('navbar.php');?>
<nav class="navbar navbar-light navbar-expand fixed-top justify-content-center align-items-center align-items-md-center navbar-pills-menu">
    <div class="container-fluid">
        <div id="myBtnContainer" class="nav-nice-scrollbar">
        <?php
        $xmltip=new DomDocument("1.0"."UTF-8");
        $xmltip->load('tipProdus.xml');
        $tip=$xmltip->getElementsByTagName("tip");
        foreach ($tip as $tip){
            $filter_name=$tip->nodeValue;?>
            <button class="btn btn-menu-tab" type="button" onclick="filterSelection('<?php echo "$filter_name";?>')"><?php echo "$filter_name";?></button> <?php }?>
        </div>
    </div>
</nav>
<div class="nav-balance" style="height: 140px;"></div>
<div class="container-all" style="padding-bottom: 40px;">
<?php foreach ($menu_shuffle as $item) {?>
    <div class="container menu-item-contain filterDiv <?php echo $item['tip'];?>">
        <div class="menu-item">
            <div class="align-self-start menu-icon-container">
                <div class="menu-icon-cat icon-burger"></div>
            </div>
            <div class="menu-item-details" style="padding-right: 15px;">
                <h1 class="menu-product-name"><?php echo $item['nume']?></h1>
                <div class="d-flex">
                    <p class="menu-item-ingredients" style="max-width: 600px;"><?php echo $item['descriere'] ?></p>
                </div>
            </div>
            <div class="menu-item-price">
                <p class="price menu-price"><?php echo $item['pret'];?> lei</p>
            </div>
            <div class="menu-add-div">
                <div class="d-flex justify-content-center justify-content-sm-center">
                    <form method="POST">
                        <input type="hidden" name="hidden_img" value="<?php echo $item['imagine'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_id" value="<?php echo $item['item_id'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_name" value="<?php echo $item['nume'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_price" value="<?php echo $item['pret'] ?? '0'; ?>">
                        <input type="hidden" name="hidden_description" value="<?php echo $item['descriere'] ?? '0'; ?>">
                        <button name="burgeri-meniu-submit" class="btn btn-primary d-xl-flex justify-content-xl-center add-to-cart add-t-c" type="submit">Add to cart</button>
                    </form>
                </div>
                </div>
            </div>
        </div>

<?php } ?>

</div>
<?php
include('footer.php');
?>