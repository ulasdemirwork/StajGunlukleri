<?php include 'header.php'; 

$kullanici = $db->prepare("SELECT * FROM kullanici WHERE kullanici_id=:kullanici_id");
$kullanici->execute(array(
    
    'kullanici_id' => @$_GET['getid']

));

$kullanicicek = $kullanici->fetch(PDO::FETCH_ASSOC);

?>


<div class="container">
<form class="row g-3" action="../baglanti/islem.php" method="POST">
<div class="col-md-12 mt-4 tex">
<div class="card-header">Kullanıcı Görsel</div>
                <div class="card-body text-center">
                <img src="../<?php echo $kullanicicek['kullanici_resim']; ?>" alt="" width="50%">
                </div>
  </div>
  
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Kullanici İsim</label>
    <input type="text" name="kullanici_isim" class="form-control" id="inputEmail4" value="<?php echo $kullanicicek['kullanici_isim'] ?>">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Kullanici Soyad</label>
    <input type="text" name="kullanici_soyad" class="form-control" id="inputPassword4"  value="<?php echo $kullanicicek['kullanici_soyad'] ?>">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Kullanici email</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $kullanicicek['kullanici_email'] ?>"  disabled>
  </div>
 
  <div class="col-md-6">
    <label for="inputCity" class="form-label">Kullanici Tür</label>
    <select name="kullanici_tur" id="" class="form-control">
        <option value="1" <?php if($kullanicicek['kullanici_tur'] == 1){ ?> selected <?php }?>>Stajyer</option> 
        <option value="2" <?php if($kullanicicek['kullanici_tur'] == 2){ ?> selected <?php }?>>İş Veren</option>
        <option value="3" <?php if($kullanicicek['kullanici_tur'] == 3){ ?> selected <?php }?>>Admin</option>
    </select>
  </div>
  <div class="col-6">
    <label for="inputAddress2" class="form-label">Kullanıcı Telefon</label>
    <input type="text" name="kullanici_telefon" class="form-control" id="inputAddress2" value="<?php echo $kullanicicek['kullanici_telefon']; ?>">
  </div>
<input hidden type="text" name="kullanici_id" value="<?php echo $kullanicicek['kullanici_id'] ?>">
  <div class="col-12 mt-4">
    <button type="submit" name="kullaniciguncelle" class="btn btn-primary">Güncelle</button>
  </div>
</form>
</div>