<?php

$pdo=new PDO('mysql:host=localhost;port=3306;dbname=school','root','');
$pdo->setAttribute(PDO::ATTR_ERRMODE,PDO::ERRMODE_EXCEPTION);


$id=$_POST['id'] ?? null;

if(!$id){
    header('Location: index.php');
    exit;
}

$statment=$pdo->prepare('DELETE FROM school_one WHERE id=:id');
$statment->bindValue(':id',$id);
$statment->execute();
header('Location: index.php')

 






?>