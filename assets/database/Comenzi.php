<?php


class Comenzi
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function getData($table='comenzi'){
        $result=$this->db->con->query("SELECT * FROM {$table}");

        $resultArray=array();

        while($item=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $resultArray[]=$item;
        }
        return $resultArray;
    }

    public function getUserData($email){
        $table1='comenzi';
        $table2='produs';
        $result=$this->db->con->query("SELECT {$table1}.id_comanda, {$table2}.nume, {$table2}.descriere, {$table1}.pret,{$table1}.cantitate, {$table1}.user,{$table1}.data
        FROM {$table1} INNER JOIN {$table2} ON {$table1}.item_id={$table2}.item_id
        WHERE {$table1}.user={$email}");

        $resultArray=array();

        while($item=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $resultArray[]=$item;
        }
        return $resultArray;
    }

    public function getJoinData(){
        $table1='comenzi';
        $table2='produs';
        $result=$this->db->con->query("SELECT {$table1}.id_comanda, {$table2}.nume, {$table2}.descriere, {$table1}.pret,{$table1}.cantitate, {$table1}.table_id
        FROM {$table1} INNER JOIN {$table2} ON {$table1}.item_id={$table2}.item_id
        WHERE {$table1}.platita=0
        ORDER BY table_id");

        $resultArray=array();

        while($item=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $resultArray[]=$item;
        }
        return $resultArray;
    }

    public function getJoinHistoryData(){
        $table1='comenzi';
        $table2='produs';
        $result=$this->db->con->query("SELECT {$table1}.id_comanda, {$table2}.nume, {$table2}.descriere, {$table1}.pret,{$table1}.cantitate, {$table1}.table_id
        FROM {$table1} INNER JOIN {$table2} ON {$table1}.item_id={$table2}.item_id
        WHERE {$table1}.platita=1");

        $resultArray=array();

        while($item=mysqli_fetch_array($result,MYSQLI_ASSOC)){
            $resultArray[]=$item;
        }
        return $resultArray;
    }

    public  function insertIntoComenzi($params = null, $table = "comenzi"){
        if ($this->db->con != null){
            if ($params != null){
                $columns = implode(',', array_keys($params));

                $values = implode(',' , array_values($params));


                $query_string = sprintf("INSERT INTO %s(%s) VALUES(%s)", $table, $columns, $values);
                $result = $this->db->con->query($query_string);
                return $result;
            }
        }
    }

    public function addToComenzi($table_id,$itemid,$cantitate,$email,$pret){
        if(!isset($email)) {
            $email="0";
            $discount=1;
        }else{
            $discount=0.9;
        }

        if(isset($itemid)){
            $params=array(
                "table_id"=>$table_id,
                "item_id"=>$itemid,
                "user"=>$email,
                "cantitate"=>$cantitate,
                "platita"=>0,
                "pret"=>$pret*$discount,
                "data"=>"NOW()"
            );
            $result = $this->insertIntoComenzi($params);
            if ($result){
                header("Location: " . $_SERVER['PHP_SELF']);
            }
        }
    }

    public function updateStatus($id_comanda = null, $table = 'comenzi'){
        if($id_comanda != null){
            $result = $this->db->con->query(" UPDATE {$table} SET platita = 1
                WHERE id_comanda={$id_comanda};");
            print_r($result);
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

    public function undo($id_comanda = null, $table = 'comenzi'){
        if($id_comanda != null){
            $result = $this->db->con->query(" UPDATE {$table} SET platita = 0
                WHERE id_comanda={$id_comanda};");
            print_r($result);
            if($result){
                header("Location:" . $_SERVER['PHP_SELF']);
            }
            return $result;
        }
    }

}