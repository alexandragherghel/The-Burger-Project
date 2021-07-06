<?php
session_start();
include('header.php');
if($_SERVER['REQUEST_METHOD'] == "POST"){
    if (isset($_POST['chelner'])){
        $Comenzi->undo($_POST['hidden_id']);
    }
}?>

<body>
<?php
include('navbar_waiter.php');
?>

<div style="height: 79px;"></div>
<section class="table-section">
    <div class="container">
        <div class="row item-to-deliver" id="itd-header">
            <div class="col col-md-2 col-sm-3 col-3 order-md-1 order-1 order-product-name">
                <p class="text-break opnh">Product_name</p>
            </div>
            <div class="col col-md-4 col-sm-7 col-7 offset-md-0 offset-3 order-md-2 order-6">
                <p>Description</p>
            </div>
            <div class="col col-md-2 col-sm-3 col-3 order-md-3 order-2 order-price-header">
                <p>price</p>
            </div>
            <div class="col col-md-1 col-sm-2 col-1 order-md-4 order-3">
                <p>Qt.</p>
            </div>
            <div class="col col-md-1 col-sm-2 col-2 order-md-5 order-4">
                <p>Table</p>
            </div>
        </div>
        <?php foreach ($history_list as $item) {?>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
            <div class="row item-to-deliver">
                <div class="col col-md-2 col-sm-3 col-3 order-md-1 order-1 order-product-name">
                    <p class="text-break opnh"><?php echo $item['nume']?></p>
                </div>
                <div class="col col-md-4 col-sm-7 col-6 offset-md-0 offset-3 order-md-2 order-6">
                    <p><?php echo $item['descriere']?></p>
                </div>
                <div class="col col-md-2 col-sm-3 col-3 order-md-3 order-2 order-price">
                    <p><?php echo $item['pret']?> lei</p>
                </div>
                <div class="col col-md-1 col-sm-2 col-1 order-md-4 order-3">
                    <p><?php echo $item['cantitate']?></p>
                </div>
                <div class="col col-md-1 col-sm-2 col-2 order-md-5 order-4 no-table-order">
                    <p><?php echo $item['table_id']?></p>
                </div>
                    <input type="hidden" name="hidden_id" value="<?php echo $item['id_comanda']?>">
                <div class="col col-md-2 col-sm-2 col-2 order-md-6 order-5"><button class="btn btn-primary order-add-to-cart" type="submit" name="chelner">undo</button></div>
                </form>
            </div>
        <?php }?>

    </div>
</section>
<?php
include('footer.php');?>