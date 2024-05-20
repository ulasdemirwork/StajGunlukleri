<?php include 'baglanti/baglanti.php';
session_start();
$kullanicilistele = $db->prepare("SELECT * FROM kullanici WHERE kullanici_email=:kullanici_email");
$kullanicilistele->execute(array(
  'kullanici_email' => @$_SESSION['giriskullanici_mail']
));


$sirketlistele = $db->prepare("SELECT * FROM sirket_bilgileri WHERE sirket_kullanici_email=:sirket_kullanici_email");
$sirketlistele->execute(array(
  'sirket_kullanici_email' => @$_SESSION['giriskullanici_mail']
));
$sirketparcala = $sirketlistele->fetch(PDO::FETCH_ASSOC);

$kullaniciparcala = $kullanicilistele->fetch(PDO::FETCH_ASSOC);
?>
<!DOCTYPE html>
<lang="en">

  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css" integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>


    <title>Staj Günlükleri</title>
    <style>
      .hesap li a {
        font-size: 15px;
      }
    </style>
  </head>
  <nav class="navbar navbar-expand-lg bg-dark">
    <div class="container-fluid">
      <a class="navbar-brand text-danger" style="font-size: 14px;" href="index.php">Staj Günlükleri</a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse" id="navbarNav">
        <ul class="navbar-nav text-center hesap">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Anasayfa</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="stajyerler.php">Stajyerler</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="ilanlar.php">İlanlar</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="hakkimizda.php">Hakkımızda</a>
          </li>
        </ul>
      </div>
      <div class="container d-flex justify-content-end">
        <?php if (@$_SESSION['giriskullanici_mail']) { ?>
          <ul class="navbar-nav">
            <li class="nav-item dropdown text-white">
              <a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Hesabımı Yönet
              </a>
              <ul class="dropdown-menu bg-white text-center" aria-labelledby="navbarDropdown">
                <li><a class="dropdown-item" href="#"> Hoşgeldin <?php echo @$_SESSION['giriskullanici_isim'] ?></a></li>
                <li><a class="dropdown-item" href="profil.php">Profilim</a></li>
                <?php if ($kullaniciparcala['kullanici_tur'] == 1) { ?>
                  <li><a class="dropdown-item" href="ilan.php">Cv Ekle</a></li>
                <?php } ?>
                
                <?php if ($kullaniciparcala['kullanici_tur'] == 2) { ?>
                  <li><a class="dropdown-item" href="ilan.php">İş İlanı Ekle</a></li>
                <?php } ?>

                <?php if($sirketlistele->rowCount() == 1){
                
                if($sirketparcala['sirket_puani'] >= 6 && $kullaniciparcala['kullanici_tur']){ ?>
                 <li><a class="dropdown-item" href="basaribelgesi.php">Online Başarı Belgesi</a></li>
                  
                <?php } }?>
             

                <li><a class="dropdown-item" href="sifredegis.php">Şifre Değiştir</a></li>
                <?php if ($kullaniciparcala['kullanici_tur'] == 3) { ?> <li><a class="dropdown-item" href="panel/login.php">Admin Panel </a></li><?php } ?>
                <li><a href="cikis.php" class="dropdown-item">Çıkış Yap</a></li>
              </ul>
            </li>
          </ul>
        <?php } else {  ?>
          <li><a href="kayit.php"><button class="btn btn-sm  text-white">Kayıt Ol</button></a></li>
          <li><a href="giris.php"><button class="btn btn-sm btn-outline-primary">Giriş Yap</button></a></li>
        <?php } ?>
      </div>


    </div>
    </div>

  </nav>