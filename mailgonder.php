<?php
include 'baglanti/baglanti.php';

include 'PHPMailer/src/SMTP.php';
include 'PHPMailer/src/PHPMailer.php';
include 'PHPMailer/src/Exception.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$kullanici_email = $_POST['kullanici_email'];

$sorgula = $db->prepare("SELECT * FROM kullanici WHERE kullanici_email=:kullanici_email");
$sorgula->execute(array(

    'kullanici_email' => $kullanici_email

));

if ($sorgula->rowCount()) {

    $row = $sorgula->fetch(PDO::FETCH_ASSOC);



    $sifirlamakodu = uniqid("stajgunlukleri");
    $sifirlamalinki = "http://localhost/stajgunlukleri.com/sifremisifirla.php?kod=" . $sifirlamakodu;

    $sifirlamakodunuekle = $db->prepare("UPDATE kullanici SET unuttum_kod=:unuttum_kod WHERE kullanici_email=:kullanici_email");
    $sifirlamakodunuekle->execute(array(

        'unuttum_kod' => $sifirlamakodu,
        'kullanici_email' => $kullanici_email
    ));

    $mail = new PHPMailer();
    $mail->Host = "smtp.outlook.com";
    $mail->Username = 'stajgunlukleri@outlook.com';
    $mail->Password = 'deneme123';
    $mail->Port = 587;
    $mail->SMTPsecure = 'tls';
    $mail->isSMTP();
    $mail->SMTPAuth = true;
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8";
    $mail->setLanguage('tr', 'PHPMailer/language//');
    $mail->setFrom('stajgunlukleri@outlook.com', "Staj Günlükleri");
    $mail->addAddress($kullanici_email);
    $mail->Subject = "Şifremi Unuttum";

    $icerik = "<div style='font-size:20px'> Sayın : " . $row['kullanici_isim'] . "<br> Şifre değiştirme bağlantınız : " . $sifirlamalinki . "</div>";

    $mail->MsgHTML($icerik);
    $mail_gonder = $mail->send();
    if ($mail_gonder) {
        header("Location:sifremiunuttum.php?get=mailgonderildi");
    } else {
        header("Location:sifremiunuttum.php?get=mailgonderilmedi");
    }
} else {
    header("Location:sifremiunuttum.php?get=kullaniciyok");
}
