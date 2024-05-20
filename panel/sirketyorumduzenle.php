<?php include 'header.php'; 

$sirketyorumlar = $db->prepare("SELECT * FROM sirket_yorumlar WHERE sirket_yorum_id=:sirket_yorum_id");
$sirketyorumlar->execute(array(
    
    'sirket_yorum_id' => @$_GET['sirketyorumid']

));

$sirketyorumlarcek = $sirketyorumlar->fetch(PDO::FETCH_ASSOC);

?>


<div class="container">
<form class="row g-3" action="../baglanti/islem.php" method="POST">
<div class="col-md-12 mt-4 tex">
<div class="card-header">Yorumcu Görsel</div>
                <div class="card-body text-center">
                <img src="../<?php echo $sirketyorumlarcek['sirket_yorum_resim']; ?>" alt="" width="50%">
                </div>
  </div>
 
  <div class="col-md-6">
    <label for="inputEmail4" class="form-label">Sirket yorum</label>
    <input type="text" name="sirket_yorum_detay" class="form-control" id="inputEmail4" value="<?php echo $sirketyorumlarcek['sirket_yorum_detay'] ?>">
  </div>
  <div class="col-md-6">
    <label for="inputPassword4" class="form-label">Şirket Yorum Yapan Kullanıcı</label>
    <input type="text" name="sirket_yorum_isim" class="form-control" id="inputPassword4"  value="<?php echo $sirketyorumlarcek['sirket_yorum_isim'] ?>">
  </div>
  <div class="col-6">
    <label for="inputAddress" class="form-label">Şirket Yorum Email</label>
    <input type="text" class="form-control" id="inputAddress" placeholder="1234 Main St" value="<?php echo $sirketyorumlarcek['sirket_yorum_email'] ?>"  disabled>
  </div>
 

<input hidden type="text" name="sirket_yorum_id" value="<?php echo $sirketyorumlarcek['sirket_yorum_id'] ?>">
  <div class="col-12 mt-4">
    <button type="submit" name="sirketyorumguncelle" class="btn btn-primary">Güncelle</button>
  </div>
</form>
</div>