<?php
require('assets/database/DBController.php');
require('assets/database/Product.php');
require('assets/database/Comenzi.php');
require('assets/database/Users.php');

$db=new DBController();
$con=$db->con;

$produs=new Product($db);
$produs_shuffle=$produs->getData();
$burger_shuffle=$produs->getBurgers();
$desert_shuffle=$produs->getDeserts();
$menu_shuffle=$produs->getProdMenFix();

$Comenzi=new Comenzi($db);
$orders_list=$Comenzi->getJoinData();
$history_list=$Comenzi->getJoinHistoryData();

$Users=new Users($db);

function getSum($arr){
    if(isset($arr)){
        $sum = 0;
        foreach ($arr as $item){
            $sum += intval($item);
        }
        return sprintf('%d' , $sum);
    }
}

function get_users_info($con, $email){
    $query = "SELECT username, email, token,gender,birthday FROM users WHERE email=?";
    $q = mysqli_stmt_init($con);

    mysqli_stmt_prepare($q, $query);

    // bind the statement
    //s vine de la string
    mysqli_stmt_bind_param($q, 's', $email);
    // execute sql statement
    mysqli_stmt_execute($q);

    $result = mysqli_stmt_get_result($q);
    $row = mysqli_fetch_array($result);
    return empty($row) ? false : $row;
}
