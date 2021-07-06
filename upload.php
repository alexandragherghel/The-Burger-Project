<?php
$xmlmodif=new DomDocument("1.0"."UTF-8");
$xmlmodif->load('modificarihome.xml');

$target_dir = "assets/img/Home/";

    $target_file = $target_dir . basename($_FILES["resetHero"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));

    $target_file2 = $target_dir . basename($_FILES["resetDay"]["name"]);
    $uploadOk2 = 1;
    $imageFileType2 = strtolower(pathinfo($target_file2,PATHINFO_EXTENSION));

    if(isset($_POST["changeText"])) {
        if($_FILES["resetDay"]["tmp_name"]) {
            $check2 = getimagesize($_FILES["resetDay"]["tmp_name"]);
            if ($check2 == false) {
                $uploadOk2 = 0;
            }
            if ($uploadOk2 == 1) {
                move_uploaded_file($_FILES["resetDay"]["tmp_name"], $target_file2);
                $dayExistent = $xmlmodif->getElementsByTagName("imgDay");
                foreach ($dayExistent as $dayExistent) {
                    $dayExistent->parentNode->removeChild($dayExistent);
                }
                $xmlmodif->save('modificarihome.xml');
                $rootTag_modif = $xmlmodif->getElementsByTagName("modificari")->item(0);
                $tagDay = $xmlmodif->createElement("imgDay", $target_file2);
                $rootTag_modif->appendChild($tagDay);
                $xmlmodif->save('modificarihome.xml');
            }
        }

        if(isset($_POST["textTitle"])){
            $titlu=$_POST["textTitle"];
            if($titlu != "") {
                $titluExistent = $xmlmodif->getElementsByTagName("titlu");
                foreach ($titluExistent as $titluExistent) {
                    $titluExistent->parentNode->removeChild($titluExistent);
                }
                $xmlmodif->save('modificarihome.xml');
                $rootTag_modif = $xmlmodif->getElementsByTagName("modificari")->item(0);
                $tagTitlu = $xmlmodif->createElement("titlu", $titlu);
                $rootTag_modif->appendChild($tagTitlu);
                $xmlmodif->save('modificarihome.xml');
            }
        }

        if(isset($_POST["mainText"])){
            $continut=$_POST['mainText'];
            if($continut != "") {
                $continutExistent = $xmlmodif->getElementsByTagName("continut");
                foreach ($continutExistent as $continutExistent) {
                    $continutExistent->parentNode->removeChild($continutExistent);
                }
                $xmlmodif->save('modificarihome.xml');
                $rootTag_modif = $xmlmodif->getElementsByTagName("modificari")->item(0);
                $tagContinut = $xmlmodif->createElement("continut", $continut);
                $rootTag_modif->appendChild($tagContinut);
                $xmlmodif->save('modificarihome.xml');
            }
        }
        if($_FILES["resetHero"]["tmp_name"]) {
            $check = getimagesize($_FILES["resetHero"]["tmp_name"]);
            if ($check == false) {
                $uploadOk = 0;
            }
            if ($uploadOk == 1) {
                move_uploaded_file($_FILES["resetHero"]["tmp_name"], $target_file);
                $heroExistent = $xmlmodif->getElementsByTagName("imghero");
                foreach ($heroExistent as $heroExistent) {
                    $heroExistent->parentNode->removeChild($heroExistent);
                }
                $xmlmodif->save('modificarihome.xml');
                $rootTag_modif = $xmlmodif->getElementsByTagName("modificari")->item(0);
                $tagHero = $xmlmodif->createElement("imghero", $target_file);
                $rootTag_modif->appendChild($tagHero);
                $xmlmodif->save('modificarihome.xml');
            }

        }
    header("location:index.php");

    }