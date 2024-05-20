<?php include 'header.php'; 

$sirket = $db->prepare("SELECT * FROM sirket_bilgileri WHERE sirket_id=:sirket_id");
$sirket->execute(array(
    
    'sirket_id' => @$_GET['sirketid']

));

$sirketcek = $sirket->fetch(PDO::FETCH_ASSOC);

?>


<div class="container">
<form class="row g-3" action="../baglanti/islem.php" method="POST">
<div class="col-md-6 mt-4 tex">
<div class="card-header">Şirket Görsel</div>
                <div class="card-body text-center">
                <img src="../<?php echo $sirketcek['sirket_resimyol']; ?>" alt="" width="100%">
                </div>
  </div>
  <div class="col-md-6 mt-4 tex">
  <div class="card-header">Şirket Konum</div>
                <div class="card-body text-center">
                    <iframe width="100%" height="300" src="https://maps.google.com/maps?q=<?php echo $sirketcek['sirket_konum']; ?>&output=embed"></iframe>
                </div>
  </div>
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Şirket İsim</label>
    <input type="text" name="sirket_isim" class="form-control" id="inputEmail4" value="<?php echo $sirketcek['sirket_isim'] ?>">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Şirket Adres</label>
    <input type="text" name="sirket_adres" class="form-control" id="inputPassword4"  value="<?php echo $sirketcek['sirket_adres'] ?>">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Şirket email</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $sirketcek['sirket_email'] ?>"  disabled>
  </div>
 
  <div class="col-6">
    <label for="inputAddress" class="form-label">Şirket Ünvan</label>
    <input type="text" name="sirket_unvan" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $sirketcek['sirket_unvan'] ?>">
  </div>

  <div class="col-6">
    <label for="inputAddress" class="form-label">Şirket Misyon</label>
    <input type="text" name="sirket_misyon" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $sirketcek['sirket_misyon'] ?>" >
  </div>

  <div class="col-6">
    <label for="inputAddress" class="form-label">Şirket Vizyon</label>
    <input type="text" name="sirket_vizyon" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $sirketcek['sirket_vizyon'] ?>" >
  </div>

  <div class="col-6">
    <label for="inputAddress" class="form-label">Şirket Açıklama</label>
    <input type="text" name="sirket_aciklama" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $sirketcek['sirket_aciklama'] ?>" >
  </div>

  <div class="col-6">
    <label for="inputAddress" class="form-label">Şirket Puanı</label>
    <input type="text" name="sirket_puani" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $sirketcek['sirket_puani'] ?>" >
  </div>

  <div class="col-6">
    <label for="inputAddress2" class="form-label">Şirket Telefon</label>
    <input type="text" name="sirket_telefon" class="form-control" id="inputAddress2" value="<?php echo $sirketcek['sirket_telefon']; ?>">
  </div>
<input hidden type="text" name="sirket_id" value="<?php echo $sirketcek['sirket_id'] ?>">
  <div class="col-12 mt-4">
    <button type="submit" name="sirketguncelle" class="btn btn-primary">Güncelle</button>
  </div>
</form>
</div>