<?php include 'header.php'; 

$stajyer = $db->prepare("SELECT * FROM stajyer_bilgileri WHERE stajyer_id=:stajyer_id");
$stajyer->execute(array(
    
    'stajyer_id' => @$_GET['stajyerid']

));

$stajyercek = $stajyer->fetch(PDO::FETCH_ASSOC);

?>


<div class="container">
<form class="row g-3" action="../baglanti/islem.php" method="POST">
<div class="col-md-12 mt-4 tex">
<div class="card-header">Stajyer Görsel</div>
                <div class="card-body text-center">
                <img src="../<?php echo $stajyercek['stajyer_resimyol']; ?>" alt="" width="50%">
                </div>
  </div>
 
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Stajyer İsim</label>
    <input type="text" name="stajyer_isim" class="form-control" id="inputEmail4" value="<?php echo $stajyercek['stajyer_isim'] ?>">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Stajyer Soy ismi</label>
    <input type="text" name="stajyer_soyisim" class="form-control" id="inputPassword4"  value="<?php echo $stajyercek['stajyer_soyisim'] ?>">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Stajyer Email</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $stajyercek['stajyer_email'] ?>"  disabled>
  </div>
 
  <div class="col-6">
    <label for="inputAddress" class="form-label">Stajyer Yetenekler</label>
    <input type="text" name="stajyer_yetenekler" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $stajyercek['stajyer_yetenekler'] ?>">
  </div>

  <div class="col-6">
    <label for="inputAddress" class="form-label">Stajyer Eğitim(lise)</label>
    <input type="text" name="stajyer_egitim_lise" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $stajyercek['stajyer_egitim_lise'] ?>" >
  </div>

  <div class="col-6">
    <label for="inputAddress" class="form-label">Stajyer Eğitim(üniversite)</label>
    <input type="text" name="stajyer_egitim_universite" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $stajyercek['stajyer_egitim_universite'] ?>" >
  </div>

  <div class="col-6">
    <label for="inputAddress" class="form-label">Stajyer Telefon</label>
    <input type="text" name="stajyer_telefon" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $stajyercek['stajyer_telefon'] ?>" >
  </div>

<input hidden type="text" name="stajyer_id" value="<?php echo $stajyercek['stajyer_id'] ?>">
  <div class="col-12 mt-4">
    <button type="submit" name="stajyerguncelle" class="btn btn-primary">Güncelle</button>
  </div>
</form>
</div>