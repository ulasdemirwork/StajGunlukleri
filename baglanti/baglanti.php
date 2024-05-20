<?php 
try {
    $db = new PDO("mysql:host=localhost;dbname=stajgunlukleri;charset=utf8",'root','');
    }
catch(PDOException $e)
    {
    echo "Bağlantı hatası: ";
    }
?>