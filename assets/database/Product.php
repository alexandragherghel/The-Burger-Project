<?php


class Product
{
    public $db = null;

    public function __construct(DBController $db)
    {
        if (!isset($db->con)) return null;
        $this->db = $db;
    }

    public function getData($table = 'produs')
    {
        $result = $this->db->con->query("SELECT * FROM {$table}");

        $resultArray = array();

        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function getProdus($item_id=null,$table='produs'){
        if(isset($item_id)){
            $result=$this->db->con->query("SELECT * FROM {$table} WHERE item_id={$item_id}");
            $resultArray = array();

            while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)){
                $resultArray[] = $item;
            }

            return $resultArray;
        }
    }

    public function getBurgers($table = 'produs')
    {
        $result = $this->db->con->query("SELECT * FROM {$table} WHERE tip='burgers'");

        $resultArray = array();

        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function getProdMenFix($table = 'produs')
    {
        $result = $this->db->con->query("SELECT * FROM {$table} WHERE tip!='personalizare'");

        $resultArray = array();

        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function getDeserts($table = 'produs')
    {
        $result = $this->db->con->query("SELECT * FROM {$table} WHERE tip='desserts'");

        $resultArray = array();

        while ($item = mysqli_fetch_array($result, MYSQLI_ASSOC)) {
            $resultArray[] = $item;
        }
        return $resultArray;
    }

    public function deleteProdus($nume=null,$table='produs'){
        if(isset($nume)){
            $result=$this->db->con->query("DELETE FROM {$table} WHERE nume='{$nume}'");
            return $result;
        }
    }

    public  function insertIntoProdus($params = null, $table = "produs"){
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

}