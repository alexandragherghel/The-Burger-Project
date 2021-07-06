<?php
session_start();
include('header.php');
$xml=new DomDocument("1.0"."UTF-8");
$xml->load('personalizare.xml');
$xml_menu=new DomDocument("1.0"."UTF-8");
$xml_menu->load('meniu.xml');

if(isset($_POST['insert'])){

    $nume=$_POST['nume'];
    $denumire=$_POST['denumire'];
    $pret=$_POST['pret'];
    $produs=$_POST['produs'];

    $rootTag=$xml->getElementsByTagName("personalizare")->item(0);
    $nameTag=$xml->createElement("nume",$nume);
    $optTag=$xml->createElement("optiuni");
    $titleTag=$xml->createElement("titlu",$produs);
    $ingTag=$xml->createElement("ingredient");
    $prodTag=$xml->createElement("produs");
    $denTag=$xml->createElement("denumire",$denumire);
    $priceTag=$xml->createElement("pret",$pret);
    $searchNode=$xml->getElementsByTagName("produs");

    $optTag->appendChild($denTag);
    $optTag->appendChild($priceTag);

    foreach( $searchNode as $searchNode )
    {
        $xmlDate = $searchNode->getElementsByTagName("titlu");
        if(!(is_null($xmlDate))){
            $valueDate = $xmlDate->item(0)->nodeValue;
            if($valueDate==$produs) {
                $searchIng=$searchNode->getElementsByTagName("ingredient");
                $nr=0;
                foreach($searchIng as $searchIng){
                    $xmlDate2 = $searchIng->getElementsByTagName("nume");
                    if(!(is_null($xmlDate2))){
                        $valueDate2 = $xmlDate2->item(0)->nodeValue;

                        if($valueDate2==$nume) {
                            $searchIng->appendChild($optTag);
                            $searchNode->appendChild($searchIng);
                            $rootTag->appendChild($searchNode);
                            $nr++;
                        }
                    }
                }
                if($nr==0){
                    $ingTag->appendChild($nameTag);
                    $ingTag->appendChild($optTag);
                    $searchNode->appendChild($ingTag);
                    $rootTag->appendChild($searchNode);
                }


            }
        }

        $xml->save('personalizare.xml');
    }
}
if(isset($_POST['delete'])){
    $nume=$_POST['categorie'];
    $produs=$_POST['produs'];
    $rootTag=$xml->getElementsByTagName("personalizare")->item(0);
    $searchNode=$xml->getElementsByTagName("produs");
    foreach( $searchNode as $searchNode )
    {
        $xmlDate = $searchNode->getElementsByTagName( "titlu" );
        if(!is_null($xmlDate)){
            $valueDate = $xmlDate->item(0)->nodeValue;
            if($valueDate==$produs) {
                $ingredient = $searchNode->getElementsByTagName("ingredient");
                foreach( $ingredient as $ingredient ){
                    $categorie=$ingredient->getElementsByTagName("nume");
                    if($categorie!=null){
                        $valueDateNume = $categorie->item(0)->nodeValue;
                        if($valueDateNume==$nume) {
                            $ingredient->parentNode->removeChild($ingredient);
                        }
                    }
                }
            }
        }
    }
    $xml->save('personalizare.xml');
}

    if(isset($_POST['create'])) {
        $nume_pag = $_POST['nume_pag'];
        if (isset($nume_pag)) {
            $file = "$nume_pag" . ".php";
            $text = file_get_contents('template.php', true);
            file_put_contents($file, $text);
        }
        $rootTag_menu = $xml_menu->getElementsByTagName("meniu")->item(0);
        $btnTag = $xml_menu->createElement("buton", $nume_pag);
        $rootTag_menu->appendChild($btnTag);
        $xml_menu->save('meniu.xml');
    }

    if(isset($_POST['deletefile'])) {
        $nume_pag = $_POST['nume_pag'];
        if (isset($nume_pag)) {
            $rootTag_menu = $xml_menu->getElementsByTagName("meniu")->item(0);
            $buton = $rootTag_menu->getElementsByTagName("buton");
            foreach ($buton as $buton) {
                $numebuton = $buton->nodeValue;
                if ($numebuton == $nume_pag) {
                    $buton->parentNode->removeChild($buton);
                }
            }
        }
        $xml_menu->save('meniu.xml');
        $file = "$nume_pag" . ".php";
        unlink($file);
    }

//if(isset($_POST['deletefile'])) {
//    $nume_pag = $_POST['nume_pag'];
//    if (isset($nume_pag)) {
//        $file = "$nume_pag" . ".php";
//        unlink($file);
//    }
//    $rootTag_menu = $xml_menu->getElementsByTagName("meniu")->item(0);
//    $buton = $rootTag_menu->getElementsByTagName("buton");
//    foreach ($buton as $buton) {
//        $numebuton = $buton->nodeValue;
//        if ($numebuton == $nume_pag) {
//            $buton->parentNode->removeChild($buton);
//        }
//    }
//    $xml_menu->save('meniu.xml');
//}

?>

<body>
<?php
include('navbar_admin.php');?>
<section>
    <div class="container">
        <div class="row form-row-edit">
            <div class="col col-md-4 col-12">
                <h5 class="title-of-the-page">Modify Customs</h5>
            </div>
        </div>
        <form method="post" action="modify_customs.php">
            <div class="form-row form-row-edit new-section">
                <div class="col col-md-3 col-12 section-margin">
                    <h6 class="title-section-padding">Add item</h6>
                </div>
                <div class="col col-md-2 col-sm-3 col-12"><label class="col-form-label modified-label">Add item</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" name="produs" placeholder="e.g. Burger"></div>
            </div>
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-3 col-sm-3 col-12"><label class="col-form-label modified-label">Add ingredient</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="e.g. Bread" name="nume"></div>
            </div>
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-3 col-sm-3 col-12"><label class="col-form-label modified-label">Add option</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="e.g. Malted Rye" name="denumire"></div>
            </div>
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-3 col-sm-3 col-12"><label class="col-form-label modified-label">Price</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="LEI" name="pret"></div>
                <div class="col col-md-3 col-sm-3 col-4"><button class="btn btn-primary add-to-cart" type="submit" name="insert" value="adauga produs">add</button></div>
            </div>
        </form>
        <form method="post" action="modify_customs.php">
            <div class="form-row form-row-edit new-section2">
                <div class="col col-md-3 col-12 section-margin">
                    <h6 class="title-section-padding">delete Item</h6>
                </div>
                <div class="col col-md-2 col-sm-3 col-12"><label class="col-form-label modified-label">Item name</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="e.g. Burger" name="produs"></div>
            </div>
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-3 col-sm-3 col-12"><label class="col-form-label modified-label">Category</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="Item category" name="categorie"></div>
                <div class="col col-md-3 col-sm-3 col-4"><button class="btn btn-primary add-to-cart" type="submit" name="delete" value="sterge produs">delete</button></div>
            </div>
        </form>
        <form method="post" action="modify_customs.php">
            <div class="form-row form-row-edit new-section2">
                <div class="col col-md-3 col-12 section-margin">
                    <h6 class="title-section-padding">Modify page</h6>
                </div>
                <div class="col col-md-2 col-sm-3 col-12"><label class="col-form-label modified-label">Add page</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="Page name" name="nume_pag"></div>
                <div class="col col-md-3 col-sm-3 col-4"><button class="btn btn-primary add-to-cart" type="submit" name="create">add</button></div>
            </div>
        </form>
        <form method="post" action="modify_customs.php">
            <div class="form-row form-row-edit">
                <div class="col col-md-2 offset-md-3 col-sm-3 col-12"><label class="col-form-label modified-label">Delete page</label></div>
                <div class="col d-flex align-items-center col-md-3 col-sm-5 col-8"><input class="form-control form-2" type="text" placeholder="Page name" name="nume_pag"></div>
                <div class="col col-md-3 col-sm-3 col-4"><button class="btn btn-primary add-to-cart" type="submit" name="deletefile" value="sterge pagina">delete</button></div>
            </div>
        </form>
    </div>
</section>
<?php
include('footer.php');?>