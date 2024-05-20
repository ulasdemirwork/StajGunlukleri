<?php include 'header.php' ?>
<style>


.collapse ul li a{
    
    color: white;
}
.hover-overlay-container {
    position: relative;
    width: 300px;
}

.hover-overlay-container:hover .overlay-image {
    opacity: 0.7;
}

.hover-overlay-container:hover .overlay-btn-container {
    opacity: 1;
}

.hover-overlay-container .overlay-image {
    display: block;
    width: 100%;
    height: auto;
    opacity: 1;
    transition: .5s ease;
    backface-visibility: hidden;
}

.hover-overlay-container .overlay-btn-container {
    position: absolute;
    top: 50%;
    left: 20%;
    opacity: 0;
    transition: .5s ease;
    text-align: center;
    transform: translate(-50%, -50%);
}

.hover-overlay-container .overlay-btn-container .overlay-btn {
    color: #fff;
    font-size: 10px;
    padding: 5px 16px;
    background-color: cornflowerblue;
    text-decoration: none;
}

</style>
<div class="container-fluid p-5  bg-dark m-0">
  <div class="row text-center">
    <div class="col-md-12">
      <div class="jumbotron text-white  text-dark p-4">
        <?php if (@$_SESSION['giriskullanici_mail']) { ?>

          <h1 class="display-4"> Merhaba <?php echo @$_SESSION['giriskullanici_isim'] ?></h1>

        <?php } else { ?>

          <h1 class="display-4">Herkese Merhaba</h1>

        <?php } ?>
        <p class="lead">Staj yerimi arıyorsunuz yoksa işinize uygun stajyer mi ? hepsi burada stajgunlukleri.com'da</p>

        <!-- Giriş Yapılmazsa -->
        <?php if (@$_SESSION['giriskullanici_mail']) { ?>
          <!-- Giriş Yapılmazsa -->
        <?php } else { ?>
          <div class="container">
            <div class="row">
              <div class="col-md-6 d-flex justify-content-end">
                <a class="btn btn-light btn-sm w-100" href="kayit.php" role="button">Kayıt Ol</a>
              </div>
              <div class="col-md-6 d-flex justify-content-start">
                <a class="btn btn-outline-light btn-sm w-100" href="giris.php" role="button">Giriş Yap </a>
              </div>
            </div>
          </div>
        <?php } ?>
      </div>
    </div>
    <div class="col-md-12 d-flex justify-content-center mt-4">
      <div class="card border-0 bg-transparent text-white " style="width: 40rem;">
        <img class="card-img-top rounded bg-transparent" src="image/indir.png" alt="Card image cap">
        <div class="card-body">

          <p class="card-text">Öğrencilerin yaşadığı staj/iş bulma sorunlarının farkındayız,sizler için oluşturduğumuz stajgunlukleri.com platformunda, sorunlarınız çözüme kavuşacak.</p>
          <p><i class="fa fa-angle-down pr-4" aria-hidden="true">&nbsp;&nbsp;</i></p>
          <a href="#" class="btn btn-outline-light">Neleri Hedefliyoruz ? </a>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="container-fluid d-flex p-4 justify-content-center  text-white" style="background: blue;">
  <div class="col-md-5">
    <hr class="mt-4 text-dark p-2">
  </div>
  <div class="col-md-2 text-center">
    <h5>Stajyerlerimiz<br></h5>
    <h6>(Öncelikli üyeler gösterilir)</h6>
  </div>
  <div class="col-md-5">
    <hr class="mt-4 text-dark p-2">
  </div>
</div>

<div class="container">
  <div class="row">
    <?php $listele = $db->prepare("SELECT * FROM stajyer_bilgileri");
    $listele->execute();
    while ($listeleparcala = $listele->fetch(PDO::FETCH_ASSOC)) { ?>
      <div class="col-md-4  mt-4 d-flex justify-content-center stajyerprofil">
        <div class="hover-overlay-container">
          <img class="overlay-image" src="<?php echo $listeleparcala['stajyer_resimyol'] ?>" width="50%"  style="max-height: 100px; min-height:100px; max-width: 130px; min-witdh:130px;"/>
          <div class="overlay-btn-container">
            <a href="cvincele.php?cvid=<?php echo $listeleparcala['stajyer_id']; ?>" class="overlay-btn">Profili İncele</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>


<div class="container-fluid d-flex p-4 justify-content-center  text-white mt-4" style="background: 	blue;">
  <div class="col-md-5">
    <hr class="mt-4 text-dark p-2">
  </div>
  <div class="col-md-2 text-center">
    <h5>İş İlanlarımız<br></h5>
    <h6>(Öncelikli ilanlar gösterilir)</h6>
  </div>
  <div class="col-md-5">
    <hr class="mt-4 text-dark p-2">
  </div>
</div>

<div class="container mb-4">
  <div class="row">
    <?php $sirketlistele = $db->prepare("SELECT * FROM sirket_bilgileri");
    $sirketlistele->execute();
    while ($sirketparcala = $sirketlistele->fetch(PDO::FETCH_ASSOC)) { ?>
      <div class="col-md-4  mt-4 d-flex justify-content-center stajyerprofil">
        <div class="hover-overlay-container">
          <img class="overlay-image" src="<?php echo $sirketparcala['sirket_resimyol'] ?>" width="50%"  style="max-height: 100px; min-height:100px; max-width: 130px; min-witdh:130px;"/>
          <div class="overlay-btn-container">
            <a href="ilanincele.php?id=<?php echo $sirketparcala['sirket_id']; ?>" class="overlay-btn">Profili İncele</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>

<?php include 'footer.php'; ?>