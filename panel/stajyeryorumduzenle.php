<?php include 'header.php'; 

$stajyeryorumlar = $db->prepare("SELECT * FROM stajyer_yorumlar WHERE stajyer_yorum_id=:stajyer_yorum_id");
$stajyeryorumlar->execute(array(
    
    'stajyer_yorum_id' => @$_GET['stajyeryorumid']

));

$stajyeryorumlarcek = $stajyeryorumlar->fetch(PDO::FETCH_ASSOC);

?>


<div class="container">
<form class="row g-3" action="../baglanti/islem.php" method="POST">
<div class="col-md-12 mt-4 tex">
<div class="card-header">Yorumcu Görsel</div>
                <div class="card-body text-center">
                <img src="../<?php echo $stajyeryorumlarcek['stajyer_yorum_resim']; ?>" alt="" width="50%">
                </div>
  </div>
 
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Stajyer yorum</label>
    <input type="text" name="stajyer_yorum_detay" class="form-control" id="inputEmail4" value="<?php echo $stajyeryorumlarcek['stajyer_yorum_detay'] ?>">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Stajyer Yorum Yapan Kullanıcı</label>
    <input type="text" name="stajyer_yorum_isim" class="form-control" id="inputPassword4"  value="<?php echo $stajyeryorumlarcek['stajyer_yorum_isim'] ?>">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Stajyer Yorum Email</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $stajyeryorumlarcek['stajyer_yorum_email'] ?>"  disabled>
  </div>
 

<input hidden type="text" name="stajyer_yorum_id" value="<?php echo $stajyeryorumlarcek['stajyer_yorum_id'] ?>">
  <div class="col-12 mt-4">
    <button type="submit" name="stajyeryorumguncelle" class="btn btn-primary">Güncelle</button>
  </div>
</form>
</div>