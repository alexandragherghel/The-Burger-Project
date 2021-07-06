<?php
session_start();
include('header.php'); ?>

<?php
    $xmltip=new DomDocument("1.0"."UTF-8");
    $xmltip->load('tipProdus.xml');
    $max=0;
    foreach ($menu_shuffle as $m){
        if($m['item_id']>$max){
             $max=$m['item_id'];
    }
}

if(isset($_POST['adauga_tip'])){
    $tipnou=$_POST["tip_nou"];
    if($tipnou != "") {
        $radacina = $xmltip->getElementsByTagName("produs")->item(0);
        $tagTip = $xmltip->createElement("tip", $tipnou);
        $radacina->appendChild($tagTip);
        $xmltip->save('tipProdus.xml');
    }
}

if(isset($_POST['sterge_tip'])){
    $tipsters=$_POST['tip_sters'];
    if(isset($tipsters)) {
        $radacina = $xmltip->getElementsByTagName("produs")->item(0);
        $tagTip =  $radacina->getElementsByTagName("tip");
        foreach( $tagTip as $tagTip ) {
            $numetag = $tagTip->nodeValue;
            if ($numetag == $tipsters) {
                $tagTip->parentNode->removeChild($tagTip);
            }
        }
    }
    $xmltip->save('tipProdus.xml');
}

if(isset($_POST['delete'])){
    $nume=$_POST['nume'];
    $produs->deleteProdus($nume);
}

if(isset($_POST['submit'])){
    $ghilimele="'";
    $date=date('d-m-y h:i:s');
    $nume=$_POST['nume'];
    $descriere=$_POST['descriere'];
    $pret=$_POST['pret'];
    $tip=$_POST['tip'];
    $arr=array(
        "item_id"=>$max+1,
        "nume"=>$ghilimele.$nume.$ghilimele,
        "pret"=>$pret,
        //"imagine"=>"'./media/bg1.jpg'",
        "register"=>$ghilimele.$date.$ghilimele,
        "descriere"=>$ghilimele.$descriere.$ghilimele,
        "tip"=>$ghilimele.$tip.$ghilimele
    );
    $result = $produs->insertIntoProdus($arr);
}

?>

<body>

<?php
include('navbar_admin.php');?>

<section>
    <div class="container">
        <div class="row form-row-edit">
            <div class="col col-md-4 col-12">
                <h5 class="title-of-the-page">Modify Menu</h5>
            </div>
        </div>
        <form method="post">
            <div class="form-row form-row-edit new-section">
                <div class="col col-md-3 col-12 section-margin">
                    <h6 class="title-section-padding">Change Category</h6>
                </div>
                <div class="col col-md-2 col-sm-3 col-12"><label class="col-form-label modified-label">Category add</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" name="tip_nou" placeholder="Category name"></div>
                <div class="col col-md-3 col-4"><button class="btn btn-primary add-to-cart" type="submit" name="adauga_tip" value="adauga_tip">Add</button></div>
            </div>
        </form>
        <form method="post">
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-3 col-sm-3 col-12"><label class="col-form-label modified-label">Category delete</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="Category name" name="tip_sters"></div>
                <div class="col col-md-3 col-sm-3 col-4"><button class="btn btn-primary add-to-cart" type="submit" name="sterge_tip" value="sterge_tip">Delete</button></div>
            </div>
        </form>
        <form method="post">
            <div class="form-row form-row-edit new-section2">
                <div class="col col-md-3 col-12 section-margin">
                    <h6 class="title-section-padding">Add Menu Item</h6>
                </div>
                <div class="col col-md-2 col-sm-3 col-12"><label class="col-form-label modified-label">Name</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="Item name" name="nume"></div>
            </div>
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-3 col-sm-3 col-12"><label class="col-form-label modified-label">Price</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="Item price" name="pret"></div>
            </div>
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-3 col-sm-3 col-12"><label class="col-form-label modified-label">Description</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="Item description" name="descriere"></div>
            </div>
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-3 col-sm-3 col-12"><label class="col-form-label modified-label">Category</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="Item category" name="tip"></div>
                <div class="col col-md-3 col-sm-3 col-4"><button class="btn btn-primary add-to-cart" type="submit" name="submit" value="Add product">add</button></div>
            </div>
        </form>
        <form method="post">
            <div class="form-row form-row-edit new-section2 last-row" style="padding-bottom: 50px;">
                <div class="col col-md-3 col-12 section-margin">
                    <h6 class="title-section-padding">Delete Menu Item</h6>
                </div>
                <div class="col col-md-2 col-sm-3 col-12"><label class="col-form-label modified-label">Menu Item</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="Category name" name="nume"></div>
                <div class="col col-md-3 col-sm-3 col-4"><button class="btn btn-primary add-to-cart" type="submit" name="delete" value="Delete product">Delete</button></div>
            </div>
        </form>
    </div>
</section>

<?php
include('footer.php');?>
