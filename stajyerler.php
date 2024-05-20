<?php include 'header.php'; ?>
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

<div class="container-fluid d-flex p-4 justify-content-center  text-white" style="background: 	blue;">
  <div class="col-md-5">
    <hr class="mt-4 text-dark p-2">
  </div>
  <div class="col-md-2 text-center">
    <h4 class="mt-3">Stajyerlerimiz<br></h4>

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
          <img class="overlay-image" src="<?php echo $listeleparcala['stajyer_resimyol'] ?>" width="50%"  style="min-height: 200px; max-height:200px;" />
          <div class="overlay-btn-container">
            <a href="cvincele.php?cvid=<?php echo $listeleparcala['stajyer_id']; ?>" class="overlay-btn">Profili İncele</a>
          </div>
        </div>
      </div>
    <?php } ?>
  </div>
</div>