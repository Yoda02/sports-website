<?php
require('connect.php');

function pech($value)
{
    echo '<pre>';
    print_r($value);
    echo '</pre>';
}
// проверка на ошибки
function examination($query){
    $errInfo=$query->errorInfo();
    if($errInfo[0]!==PDO::ERR_NONE)
    {
        echo $errInfo[2];
        exit();
    }
}

function selectAll($table, $params=[])
{
    global $pdo;
    $sql="SELECT*FROM";
    $query=$pdo->prepare($sql);
    $query->execute();
    examination($query);
  return $query->fetchAll();

}

function insert($table, $params){
    global $pdo;
    $i = 0;
    $coll = '';
    $mask = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $coll = $coll . "$key";
            $mask = $mask . "'" ."$value" . "'";
        }else {
            $coll = $coll . ", $key";
            $mask = $mask . ", '" . "$value" . "'";
        }
        $i++;
    }

$sql="INSERT INTO $table ($coll) VALUES ($mask)";
$query=$pdo->prepare($sql);
$query->execute($params);
examination($query);
return $pdo->lastInsertId();
}

function update($table, $id, $params){
    global $pdo;
    $i = 0;
    $str = '';
    foreach ($params as $key => $value) {
        if ($i === 0){
            $str = $str . $key . " = '" . $value . "'";
        }else {
            $str = $str .", " . $key . " = '" . $value . "'";
        }
        $i++;
    }

    $sql = "UPDATE $table SET $str WHERE id = $id";
    $query = $pdo->prepare($sql);
    $query->execute($params);
    examination($query);

}
function delete($table, $id){
    global $pdo;
    //DELETE FROM `topics` WHERE id = 3
    $sql = "DELETE FROM $table WHERE id =". $id;
    $query = $pdo->prepare($sql);
    $query->execute();
    examination($query);

}