<?php
include 'baglanti.php';
session_start();

if (isset($_POST['kayitol'])) {

    $kayitbasarili = "kayitbasarili";
    $getsifrelikayit = base64_encode($kayitbasarili);

    $kayitbasarisiz = "kayitbasarisiz";
    $getkayitbasarisiz = base64_encode($kayitbasarisiz);

    $isim = $_POST['kullanici_isim'];
    $email = $_POST['kullanici_email'];
    $sifre = $_POST['kullanici_sifre'];
    $soyisim = $_POST['kullanici_soyisim'];
    $tur = $_POST['kullanici_tur'];
    $sifretekrar = $_POST['kullanici_sifretekrar'];

    $hashsifre = password_hash($sifre, PASSWORD_DEFAULT);

    $sorgula = $db->prepare("SELECT * FROM kullanici WHERE kullanici_email=:kullanici_email");
    $sorgula->execute(array(

        'kullanici_email' => $email

    ));


    if ($sorgula->rowCount() == 0) {

        if ($sifre == $sifretekrar) {

            if (strlen($sifre) >= 3) {
                $kayitol = $db->prepare("INSERT INTO kullanici SET
                    kullanici_isim=:kullanici_isim,
                    kullanici_soyad=:kullanici_soyad,
                    kullanici_tur=:kullanici_tur,
                    kullanici_email=:kullanici_email,
                    kullanici_sifre=:kullanici_sifre");

                $kaydet = $kayitol->execute(array(

                    'kullanici_isim' => $isim,
                    'kullanici_email' => $email,
                    'kullanici_soyad' => $soyisim,
                    'kullanici_tur' => $tur,
                    'kullanici_sifre' => $hashsifre
                ));
                if ($kaydet) {
                    header("location:../kayit.php?get=$getsifrelikayit");
                }
               
            } else {
                header("Location:../kayit.php?get=$getkayitbasarisiz");
            }
        }
    } else {
        header("Location:../kayit.php?get=$getkayitbasarisiz");
    }
}

if (isset($_POST['giris'])) {

    $getbasarili = "girisbasarili";
    $getsifrebasarili = base64_encode($getbasarili);

    $getbasarisiz = "girisbasarisiz";
    $getsifrebasarisiz = base64_encode($getbasarisiz);



    $getkullanicibulunamadı = "kullanicibulunamadi";
    $getsifrekullanici = base64_encode($getkullanicibulunamadı);

    $email = $_POST['kullanici_email'];
    $sifre = $_POST['kullanici_sifre'];

    $giris = $db->prepare("SELECT * FROM kullanici WHERE kullanici_email=:kullanici_email");
    $giris->execute(array(
        'kullanici_email' => $email
    ));

    if ($giris->rowCount() == 1) {

        $listeparcala = $giris->fetch(PDO::FETCH_ASSOC);
        if (password_verify($sifre, $listeparcala['kullanici_sifre'])) {
            $_SESSION['giriskullanici_isim'] = $listeparcala['kullanici_isim'];
            $_SESSION['giriskullanici_soyad'] = $listeparcala['kullanici_soyad'];

            $_SESSION['giriskullanici_mail'] = $listeparcala['kullanici_email'];
            header("Location:../index.php?get=$getsifrebasarili");
        } else {
            header("Location:../giris.php?get=$getsifrebasarisiz");
        }
    } else {
        header("Location:../giris.php?get=$getsifrekullanici");
    }
}

if (isset($_POST['profilguncelle'])) {

    $uploads_dir = '../resimler/profil';
    @$tmp_name = $_FILES['kullanici_resim']["tmp_name"];
    @$name = $_FILES['kullanici_resim']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2;
    $refimgyol = substr($uploads_dir, 3) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


    $get = "guncellebasarili";
    $sifreliget = base64_encode($get);

    $profilguncelle = $db->prepare("UPDATE kullanici SET
    
    kullanici_isim=:kullanici_isim,
    kullanici_soyad=:kullanici_soyad,
    kullanici_telefon=:kullanici_telefon,
    kullanici_resim=:kullanici_resim

    WHERE kullanici_id={$_POST['kullanici_id']}
    ");

    $profilguncelle->execute(array(

        'kullanici_isim' => $_POST['kullanici_isim'],
        'kullanici_soyad' => $_POST['kullanici_soyad'],
        'kullanici_telefon' => $_POST['kullanici_telefon'],
        'kullanici_resim' => $refimgyol

    ));

    if ($profilguncelle) {
        header("Location:../profil.php?get=$sifreliget");
    }
}

if (isset($_POST['cvgonder'])) {


    $uploads_dir = '../resimler/profil';
    @$tmp_name = $_FILES['stajyer_resimyol']["tmp_name"];
    @$name = $_FILES['stajyer_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2;
    $refimgyol = substr($uploads_dir, 3) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


    $tamam = "cvgonderildi";
    $gettamam = base64_encode($tamam);


    $cvvar = "cvvar";
    $getcvvar = base64_encode($cvvar);

    $sorgula = $db->prepare("SELECT * FROM stajyer_bilgileri WHERE stajyer_email=:stajyer_email");
    $sorgula->execute(array(

        'stajyer_email' => $_POST['giriskullanici_email']

    ));

    if ($sorgula->rowCount() == 0) {


        $cvgonder = $db->prepare("INSERT INTO stajyer_bilgileri SET  
        stajyer_isim=:stajyer_isim,
        stajyer_soyisim=:stajyer_soyisim,
        stajyer_yetenekler=:stajyer_yetenekler,
        stajyer_egitim_lise=:stajyer_egitim_lise,
        stajyer_egitim_universite=:stajyer_egitim_universite,
        stajyer_telefon=:stajyer_telefon,
        stajyer_email=:stajyer_email,
        stajyer_resimyol=:stajyer_resimyol

    ");
        $cvgonder->execute(array(
            'stajyer_isim' => $_POST['stajyer_isim'],
            'stajyer_soyisim' => $_POST['stajyer_soyisim'],
            'stajyer_yetenekler' => $_POST['stajyer_yetenekler'],
            'stajyer_egitim_lise' => $_POST['stajyer_egitim_lise'],
            'stajyer_egitim_universite' => $_POST['stajyer_egitim_universite'],
            'stajyer_telefon' => $_POST['stajyer_telefon'],
            'stajyer_email' => $_POST['giriskullanici_email'],
            'stajyer_resimyol' => $refimgyol

        ));
        if ($cvgonder) {
            header("Location:../ilan.php?get=$gettamam");
        }
    } else {
        header("Location:../ilan.php?get=$getcvvar");
    }
}



if (isset($_POST['ilangonder'])) {

    $adres = $_POST["adres"];
    $adres = str_replace(" ", "+", $adres);

    $uploads_dir = '../resimler/ilan';
    @$tmp_name = $_FILES['sirket_resimyol']["tmp_name"];
    @$name = $_FILES['sirket_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2;
    $refimgyol = substr($uploads_dir, 3) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $tamam = "ilangonderildi";
    $gettamam = base64_encode($tamam);


    $cvvar = "ilanvar";
    $getcvvar = base64_encode($cvvar);

    $sorgula = $db->prepare("SELECT * FROM sirket_bilgileri WHERE sirket_kullanici_email=:sirket_kullanici_email");
    $sorgula->execute(array(

        'sirket_kullanici_email' => $_SESSION['giriskullanici_mail']

    ));

    if ($sorgula->rowCount() == 0) {


        $cvgonder = $db->prepare("INSERT INTO sirket_bilgileri SET  
        sirket_isim=:sirket_isim,
        sirket_adres=:sirket_adres,
        sirket_telefon=:sirket_telefon,
        sirket_aciklama=:sirket_aciklama,
        sirket_unvan=:sirket_unvan,
        sirket_vizyon=:sirket_vizyon,
        sirket_misyon=:sirket_misyon,
        sirket_resimyol=:sirket_resimyol,
        sirket_email=:sirket_email,
        sirket_konum=:sirket_konum,
        sirket_kullanici_email=:sirket_kullanici_email

    ");
        $cvgonder->execute(array(
            'sirket_isim' => $_POST['sirket_isim'],
            'sirket_adres' => $_POST['sirket_adres'],
            'sirket_aciklama' => $_POST['sirket_aciklama'],
            'sirket_telefon' => $_POST['sirket_telefon'],
            'sirket_unvan' => $_POST['sirket_unvan'],
            'sirket_vizyon' => $_POST['sirket_vizyon'],
            'sirket_misyon' => $_POST['sirket_misyon'],
            'sirket_resimyol' => $refimgyol,
            'sirket_email' => $_POST['sirket_email'],
            'sirket_konum' => $_POST['sirket_konum'],
            'sirket_kullanici_email' => $_POST['sirket_kullanici_email']

        ));
        if ($cvgonder) {
            header("Location:../ilan.php?get=$gettamam");
        }
    } else {
        header("Location:../ilan.php?get=$getcvvar");
    }
}



if (isset($_POST['ilanguncelle'])) {

    $adres = $_POST["adres"];
    $adres = str_replace(" ", "+", $adres);

    $uploads_dir = '../resimler/ilan';
    @$tmp_name = $_FILES['sirket_resimyol']["tmp_name"];
    @$name = $_FILES['sirket_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2;
    $refimgyol = substr($uploads_dir, 3) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $tamam = "ilanguncellendi";
    $gettamam = base64_encode($tamam);


    $cvvar = "ilanguncellenemedi";
    $getcvvar = base64_encode($cvvar);

    $sorgula = $db->prepare("SELECT * FROM sirket_bilgileri WHERE sirket_kullanici_email=:sirket_kullanici_email");
    $sorgula->execute(array(

        'sirket_kullanici_email' => $_SESSION['giriskullanici_mail']

    ));

    if ($sorgula->rowCount() == 1) {


        $cvgonder = $db->prepare("UPDATE sirket_bilgileri SET  
        sirket_isim=:sirket_isim,
        sirket_adres=:sirket_adres,
        sirket_aciklama=:sirket_aciklama,
        sirket_telefon=:sirket_telefon,
        sirket_unvan=:sirket_unvan,
        sirket_vizyon=:sirket_vizyon,
        sirket_misyon=:sirket_misyon,
        sirket_resimyol=:sirket_resimyol,
        sirket_konum=:sirket_konum,
        sirket_email=:sirket_email
        WHERE sirket_kullanici_email=:sirket_kullanici_email

    ");
        $cvgonder->execute(array(
            'sirket_isim' => $_POST['sirket_isim'],
            'sirket_adres' => $_POST['sirket_adres'],
            'sirket_aciklama' => $_POST['sirket_aciklama'],
            'sirket_telefon' => $_POST['sirket_telefon'],
            'sirket_unvan' => $_POST['sirket_unvan'],
            'sirket_vizyon' => $_POST['sirket_vizyon'],
            'sirket_misyon' => $_POST['sirket_misyon'],
            'sirket_resimyol' => $refimgyol,
            'sirket_email' => $_POST['sirket_email'],
            'sirket_konum' => $_POST['sirket_konum'],
            'sirket_kullanici_email' => $_SESSION['giriskullanici_mail']

        ));
        if ($cvgonder) {
            header("Location:../ilan.php?get=$gettamam");
        }
    } else {
        header("Location:../ilan.php?get=$getcvvar");
    }
}



if (isset($_POST['cvguncelle'])) {


    $uploads_dir = '../resimler/profil';
    @$tmp_name = $_FILES['stajyer_resimyol']["tmp_name"];
    @$name = $_FILES['stajyer_resimyol']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2;
    $refimgyol = substr($uploads_dir, 3) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");


    $tamam = "cvguncellendi";
    $gettamam = base64_encode($tamam);


    $cvvar = "cvguncellenmedi";
    $getcvvar = base64_encode($cvvar);

    $sorgula = $db->prepare("SELECT * FROM stajyer_bilgileri WHERE stajyer_email=:stajyer_email");
    $sorgula->execute(array(

        'stajyer_email' => $_POST['giriskullanici_email']

    ));

    if ($sorgula->rowCount() == 1) {


        $cvgonder = $db->prepare("UPDATE stajyer_bilgileri SET  
        stajyer_isim=:stajyer_isim,
        stajyer_soyisim=:stajyer_soyisim,
        stajyer_yetenekler=:stajyer_yetenekler,
        stajyer_egitim_lise=:stajyer_egitim_lise,
        stajyer_egitim_universite=:stajyer_egitim_universite,
        stajyer_telefon=:stajyer_telefon,
        stajyer_email=:stajyer_email,
        stajyer_resimyol=:stajyer_resimyol
         WHERE stajyer_email=:stajyer_email

    ");
        $cvgonder->execute(array(
            'stajyer_isim' => $_POST['stajyer_isim'],
            'stajyer_soyisim' => $_POST['stajyer_soyisim'],
            'stajyer_yetenekler' => $_POST['stajyer_yetenekler'],
            'stajyer_egitim_lise' => $_POST['stajyer_egitim_lise'],
            'stajyer_egitim_universite' => $_POST['stajyer_egitim_universite'],
            'stajyer_telefon' => $_POST['stajyer_telefon'],
            'stajyer_email' => $_POST['giriskullanici_email'],
            'stajyer_resimyol' => $refimgyol
        ));
        if ($cvgonder) {
            header("Location:../ilan.php?get=$gettamam");
        }
    } else {
        header("Location:../ilan.php?get=$getcvvar");
    }
}

if (isset($_POST['sifreguncelle'])) {

    $sifre = $_POST['kullanici_sifre'];

    $hashsifre = password_hash($sifre, PASSWORD_DEFAULT);
    $sifreguncelle = $db->prepare("UPDATE kullanici SET kullanici_sifre=:kullanici_sifre WHERE kullanici_id=:kullanici_id");

    $sifreguncelle->execute(array(
        'kullanici_sifre' => $hashsifre,
        'kullanici_id' => $_POST['kullanici_id']
    ));

    if ($sifreguncelle) {
        header("Location:../sifredegis.php?get=ok");
    }
}
if (isset($_POST['yorumyap'])) {





    $listele = $db->prepare("SELECT * FROM kullanici WHERE kullanici_email=:kullanici_email");
    $listele->execute(array(

        'kullanici_email' => $_SESSION['giriskullanici_mail']

    ));

    $listeparcala = $listele->fetch(PDO::FETCH_ASSOC);

    $sirket_ilan_id = $_POST['sirket_ilan_id'];

    $yorumyap = $db->prepare("INSERT INTO sirket_yorumlar SET
     sirket_kullanici_id=:sirket_kullanici_id,
     sirket_yorum_detay=:sirket_yorum_detay,
     sirket_ilan_id=:sirket_ilan_id,
     sirket_yorum_email=:sirket_yorum_email,
     sirket_yorum_resim=:sirket_yorum_resim,
     sirket_yorum_isim=:sirket_yorum_isim
     
     ");
    $yorumyap->execute(array(

        'sirket_kullanici_id' => $listeparcala['kullanici_id'],
        'sirket_yorum_detay' => $_POST['sirket_yorum_detay'],
        'sirket_ilan_id' => $_POST['sirket_ilan_id'],
        'sirket_yorum_email' => $_POST['sirket_yorum_email'],
        'sirket_yorum_resim' => $_POST['sirket_yorum_resim'],
        'sirket_yorum_isim' => $listeparcala['kullanici_isim']

    ));
    if ($yorumyap) {
        header("Location:../ilanincele.php?id=$sirket_ilan_id");
    }
}

if (isset($_GET['yorumsil']) == "ok") {
    $ilanid = $_GET['ilanid'];
    $sil = $db->prepare("DELETE  FROM sirket_yorumlar where sirket_yorum_id=:sirket_yorum_id");
    $kontrol = $sil->execute(array(
        'sirket_yorum_id' => $_GET['yorumid']
    ));
    if ($kontrol) {
        header("Location:../ilanincele.php?id=$ilanid");
    } else {
        header("Location:../production.php?id=$ilanid");
    }
}

if (isset($_POST['cvyorumyap'])) {



    $listele = $db->prepare("SELECT * FROM kullanici WHERE kullanici_email=:kullanici_email");
    $listele->execute(array(

        'kullanici_email' => $_SESSION['giriskullanici_mail']

    ));

    $listeparcala = $listele->fetch(PDO::FETCH_ASSOC);

    $stajyer_cv_id = $_POST['stajyer_cv_id'];

    $yorumyap = $db->prepare("INSERT INTO stajyer_yorumlar SET
     stajyer_kullanici_id=:stajyer_kullanici_id,
     stajyer_yorum_detay=:stajyer_yorum_detay,
     stajyer_cv_id=:stajyer_cv_id,
     stajyer_yorum_email=:stajyer_yorum_email,
     stajyer_yorum_resim=:stajyer_yorum_resim,
     stajyer_yorum_isim=:stajyer_yorum_isim
     
     ");
    $yorumyap->execute(array(

        'stajyer_kullanici_id' => $listeparcala['kullanici_id'],
        'stajyer_yorum_detay' => $_POST['stajyer_yorum_detay'],
        'stajyer_cv_id' => $_POST['stajyer_cv_id'],
        'stajyer_yorum_email' => $_POST['stajyer_yorum_email'],
        'stajyer_yorum_resim' => $_POST['stajyer_yorum_resim'],
        'stajyer_yorum_isim' => $listeparcala['kullanici_isim']

    ));
    if ($yorumyap) {
        header("Location:../cvincele.php?cvid=$stajyer_cv_id");
    }
}

if (isset($_GET['cvyorumsil']) == "ok") {
    $cvid = $_GET['cvid'];
    $sil = $db->prepare("DELETE  FROM stajyer_yorumlar where stajyer_yorum_id=:stajyer_yorum_id");
    $kontrol = $sil->execute(array(
        'stajyer_yorum_id' => $_GET['yorumid']
    ));
    if ($kontrol) {
        header("Location:../cvincele.php?cvid=$cvid");
    } else {
        header("Location:../cvincele.php?cvid=$cvid");
    }
}



if (isset($_POST['puangonder'])) {

    $dahaonceverildi = "dahaonceverildi";
    $sifrelidahaonceverildi = base64_encode($dahaonceverildi);

    $puanverildi = "puanverildi";
    $sifrelipuanverildi = base64_encode($puanverildi);

    $sirketpuan = $_POST['sirketpuan'];
    $sirket_ilan_id = $_POST['sirket_ilan_id'];
    $sirket_kullanici_id = $_POST['sirket_kullanici_id'];
    $sirket_puan_email = $_POST['sirket_puan_email'];


    $listele = $db->prepare("SELECT * FROM sirket_puan WHERE sirket_ilan_id=:sirket_ilan_id and sirket_kullanici_id=:sirket_kullanici_id");
    $listele->execute(array(

        'sirket_ilan_id' => $sirket_ilan_id,
        'sirket_kullanici_id' => $sirket_kullanici_id

    ));


    if ($listele->rowCount() == 0) {
        $puanekle = $db->prepare("INSERT INTO sirket_puan SET 
        puan=:puan,
        sirket_ilan_id=:sirket_ilan_id,
        sirket_kullanici_id=:sirket_kullanici_id,
        sirket_puan_email=:sirket_puan_email

        ");

        $puanekle->execute(array(

            'puan' => $sirketpuan,
            'sirket_ilan_id' => $sirket_ilan_id,
            'sirket_kullanici_id' => $sirket_kullanici_id,
            'sirket_puan_email' => $sirket_puan_email

        ));

        $puanguncelle = $db->prepare("UPDATE sirket_bilgileri SET sirket_puani=sirket_puani + $sirketpuan WHERE sirket_id=:sirket_id");
        $puanguncelle->execute(array(
            'sirket_id' => $sirket_ilan_id
        ));

        if ($puanekle) {
            header("Location:../ilanincele.php?id=$sirket_ilan_id&get=$sifrelipuanverildi");
        }
    } else {
        header("Location:../ilanincele.php?id=$sirket_ilan_id&get=$sifrelidahaonceverildi");
    }
}
if(isset($_POST['projegonder'])){

    $uploads_dir = '../resimler/proje';
    @$tmp_name = $_FILES['proje1_resim']["tmp_name"];
    @$name = $_FILES['proje1_resim']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2;
    $refimgyol1 = substr($uploads_dir, 3) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $uploads_dir = '../resimler/proje';
    @$tmp_name = $_FILES['proje2_resim']["tmp_name"];
    @$name = $_FILES['proje2_resim']["name"];
    //resmin isminin benzersiz olması
    $benzersizsayi1 = rand(20000, 32000);
    $benzersizsayi2 = rand(20000, 32000);
    $benzersizad = $benzersizsayi1 . $benzersizsayi2;
    $refimgyol2 = substr($uploads_dir, 3) . "/" . $benzersizad . $name;
    @move_uploaded_file($tmp_name, "$uploads_dir/$benzersizad$name");

    $get = "cvgonder";
    $sifreliget = base64_encode($get);

    $cvolustu = "cvgonderildimi";
    $sifrelicvolustu = base64_encode($cvolustu);

    $sor = $db->prepare("SELECT * FROM stajyer_bilgileri where stajyer_email=:stajyer_email");
    $sor->execute(array(

        'stajyer_email' => $_SESSION['giriskullanici_mail']
    ));
    
    if($sor->rowCount() == 1){

    $projegonder = $db->prepare("UPDATE stajyer_bilgileri SET
    
    stajyer_facebook=:stajyer_facebook,
    stajyer_instagram=:stajyer_instagram,
    stajyer_linkedin=:stajyer_linkedin,
    stajyer_youtube=:stajyer_youtube,
    stajyer_github=:stajyer_github,
    stajyer_hakkimda=:stajyer_hakkimda,
    proje1_link=:proje1_link,
    proje2_link=:proje2_link,
    proje1_resim=:proje1_resim,
    proje2_resim=:proje2_resim
    WHERE stajyer_email=:stajyer_email
    
    ");

    $projegonder->execute(array(

        'stajyer_facebook' => $_POST['stajyer_facebook'],
        'stajyer_instagram' => $_POST['stajyer_instagram'],
        'stajyer_linkedin' => $_POST['stajyer_linkedin'],
        'stajyer_youtube' => $_POST['stajyer_youtube'],
        'stajyer_github' => $_POST['stajyer_github'],
        'stajyer_hakkimda' => $_POST['stajyer_hakkimda'],
        'proje1_link' => $_POST['proje1_link'],
        'proje2_link' => $_POST['proje2_link'],
        'proje1_resim' => $refimgyol1,
        'proje2_resim' => $refimgyol2,
        'stajyer_email' => $_SESSION['giriskullanici_mail']
        ));

    if($projegonder){
        header("Location:../ilan.php?get=$sifrelicvolustu");
    }
    }else{
        header("Location:../ilan.php?get=$sifreliget");
    }
}
if(isset($_POST['kullaniciguncelle'])){

    $kullanici_id =$_POST['kullanici_id'];
    $kullaniciguncelle = $db->prepare("UPDATE kullanici SET
    
    kullanici_isim=:kullanici_isim,
    kullanici_soyad=:kullanici_soyad,
    kullanici_telefon=:kullanici_telefon,
    kullanici_tur=:kullanici_tur
    WHERE kullanici_id=:kullanici_id
    ");

    $kullaniciguncelle->execute(array(


        'kullanici_isim' => $_POST['kullanici_isim'],
        'kullanici_soyad' => $_POST['kullanici_soyad'],
        'kullanici_telefon' => $_POST['kullanici_telefon'],
        'kullanici_tur' => $_POST['kullanici_tur'],
        'kullanici_id' => $_POST['kullanici_id']
    ));

    if($kullaniciguncelle){
        header("Location:../panel/kullaniciduzenle.php?get=guncellemebasarili&getid=$kullanici_id");
    }



}

if(isset($_POST['sirketguncelle'])){

    $sirket_id =$_POST['sirket_id'];
    $sirketguncelle = $db->prepare("UPDATE sirket_bilgileri SET
    
    sirket_isim=:sirket_isim,
    sirket_adres=:sirket_adres,
    sirket_vizyon=:sirket_vizyon,
    sirket_misyon=:sirket_misyon,
    sirket_aciklama=:sirket_aciklama,
    sirket_unvan=:sirket_unvan,
    sirket_puani=:sirket_puani,
    sirket_telefon=:sirket_telefon
    WHERE sirket_id=:sirket_id
    ");

    $sirketguncelle->execute(array(


        'sirket_isim' => $_POST['sirket_isim'],
        'sirket_adres' => $_POST['sirket_adres'],
        'sirket_vizyon' => $_POST['sirket_vizyon'],
        'sirket_misyon' => $_POST['sirket_misyon'],
        'sirket_aciklama' => $_POST['sirket_aciklama'],
        'sirket_unvan' => $_POST['sirket_unvan'],
        'sirket_puani' => $_POST['sirket_puani'],
        'sirket_telefon' => $_POST['sirket_telefon'],
        'sirket_id' => $_POST['sirket_id']
    ));

    if($sirketguncelle){
        header("Location:../panel/sirketduzenle.php?get=guncellemebasarili&sirketid=$sirket_id");
    }
}

if(isset($_POST['stajyerguncelle'])){

    $stajyer_id =$_POST['stajyer_id'];
    $sirketguncelle = $db->prepare("UPDATE stajyer_bilgileri SET
    
    stajyer_isim=:stajyer_isim,
    stajyer_soyisim=:stajyer_soyisim,
    stajyer_yetenekler=:stajyer_yetenekler,
    stajyer_egitim_universite=:stajyer_egitim_universite,
    stajyer_egitim_lise=:stajyer_egitim_lise,
    stajyer_telefon=:stajyer_telefon
    WHERE stajyer_id=:stajyer_id
    ");

    $sirketguncelle->execute(array(


        'stajyer_isim' => $_POST['stajyer_isim'],
        'stajyer_soyisim' => $_POST['stajyer_soyisim'],
        'stajyer_yetenekler' => $_POST['stajyer_yetenekler'],
        'stajyer_egitim_universite' => $_POST['stajyer_egitim_universite'],
        'stajyer_egitim_lise' => $_POST['stajyer_egitim_lise'],
        'stajyer_telefon' => $_POST['stajyer_telefon'],
        'stajyer_id' => $_POST['stajyer_id']
    ));

    if($sirketguncelle){
        header("Location:../panel/stajyerduzenle.php?get=guncellemebasarili&stajyerid=$stajyer_id");
    }
}
if(isset($_POST['sirketyorumguncelle'])){

    $sirket_yorum_id =$_POST['sirket_yorum_id'];
    $sirketyorumguncelle = $db->prepare("UPDATE sirket_yorumlar SET
    
    sirket_yorum_detay=:sirket_yorum_detay,
    sirket_yorum_isim=:sirket_yorum_isim
    WHERE sirket_yorum_id=:sirket_yorum_id
    ");

    $sirketyorumguncelle->execute(array(


        'sirket_yorum_detay' => $_POST['sirket_yorum_detay'],
        'sirket_yorum_isim' => $_POST['sirket_yorum_isim'],
        'sirket_yorum_id' => $_POST['sirket_yorum_id']
    ));

    if($sirketyorumguncelle){
        header("Location:../panel/sirketyorumduzenle.php?get=guncellemebasarili&sirketyorumid=$sirket_yorum_id");
    }
}

if(isset($_POST['stajyeryorumguncelle'])){

    $stajyer_yorum_id =$_POST['stajyer_yorum_id'];
    $stajyeryorumguncelle = $db->prepare("UPDATE stajyer_yorumlar SET
    
    stajyer_yorum_detay=:stajyer_yorum_detay,
    stajyer_yorum_isim=:stajyer_yorum_isim
    WHERE stajyer_yorum_id=:stajyer_yorum_id
    ");

    $stajyeryorumguncelle->execute(array(


        'stajyer_yorum_detay' => $_POST['stajyer_yorum_detay'],
        'stajyer_yorum_isim' => $_POST['stajyer_yorum_isim'],
        'stajyer_yorum_id' => $_POST['stajyer_yorum_id']
    ));

    if($stajyeryorumguncelle){
        header("Location:../panel/stajyeryorumduzenle.php?get=guncellemebasarili&stajyeryorumid=$stajyer_yorum_id");
    }
}

if (isset($_GET['kullanicisil']) == "tamam") {
    $kullanicid = $_GET['kullaniciid'];
    $sil = $db->prepare("DELETE  FROM kullanici where kullanici_id=:kullanici_id");
    $kontrol = $sil->execute(array(
        'kullanici_id' => $_GET['kullaniciid']
    ));
    if ($kontrol) {
        header("Location:../panel/kullanici.php?kullanicisil=ok");
    } else {
        header("Location:../panel/kullanici.php?kullanicisil=hayir");
    }
}

if (isset($_GET['sirketsil']) == "tamam") {
    $sirketid = $_GET['sirketid'];
    $sil = $db->prepare("DELETE  FROM sirket_bilgileri where sirket_id=:sirket_id");
    $kontrol = $sil->execute(array(
        'sirket_id' => $_GET['sirketid']
    ));
    if ($kontrol) {
        header("Location:../panel/sirket.php?sirketsil=ok");
    } else {
        header("Location:../panel/sirket.php?sirketsil=hayir");
    }
}

if (isset($_GET['stajyersil']) == "tamam") {
    $stajyerid = $_GET['stajyerid'];
    $sil = $db->prepare("DELETE  FROM stajyer_bilgileri where stajyer_id=:stajyer_id");
    $kontrol = $sil->execute(array(
        'stajyer_id' => $_GET['stajyerid']
    ));
    if ($kontrol) {
        header("Location:../panel/stajyer.php?stajyersil=ok");
    } else {
        header("Location:../panel/stajyer.php?stajyersil=hayir");
    }
}

if (isset($_GET['sirketyorumsil']) == "tamam") {
    $sirketyorumid = $_GET['sirketyorumid'];
    $sil = $db->prepare("DELETE  FROM sirket_yorumlar where sirket_yorum_id=:sirket_yorum_id");
    $kontrol = $sil->execute(array(
        'sirket_yorum_id' => $_GET['sirketyorumid']
    ));
    if ($kontrol) {
        header("Location:../panel/sirketyorum.php?sirketyorumsil=ok");
    } else {
        header("Location:../panel/sirketyorum.php?sirketyorumsil=hayir");
    }
}

if (isset($_GET['stajyeryorumsil']) == "tamam") {
    $stajyeryorumid = $_GET['stajyeryorumid'];
    $sil = $db->prepare("DELETE  FROM stajyer_yorumlar where stajyer_yorum_id=:stajyer_yorum_id");
    $kontrol = $sil->execute(array(
        'stajyer_yorum_id' => $_GET['stajyeryorumid']
    ));
    if ($kontrol) {
        header("Location:../panel/stajyeryorum.php?stajyeryorumsil=ok");
    } else {
        header("Location:../panel/stajyeryorum.php?stajyeryorumsil=hayir");
    }
}

if(isset($_POST['panelgiris'])){

    $sifre = $_POST['kullanici_sifre'];
    $email = $_POST['kullanici_email'];
    $giris = $db->prepare("SELECT * FROM kullanici WHERE kullanici_email=:kullanici_email and kullanici_tur=:kullanici_tur");
    $giris->execute(array(
        'kullanici_email' => $email,
        'kullanici_tur' => 3
    ));

    if ($giris->rowCount() == 1) {
        $listeparcala = $giris->fetch(PDO::FETCH_ASSOC);
        if (password_verify($sifre, $listeparcala['kullanici_sifre'])) {
            $_SESSION['admingiriskullanici_isim'] = $listeparcala['kullanici_isim'];
            $_SESSION['admingiriskullanici_soyad'] = $listeparcala['kullanici_soyad'];

            $_SESSION['admingiriskullanici_mail'] = $listeparcala['kullanici_email'];

            header("Location:../panel/index.php?get=ok");
        } else {
            header("Location:../panel/login.php?get=no");
        }
   
    }
}