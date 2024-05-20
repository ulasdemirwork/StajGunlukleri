<?php include 'header.php'; 

$kullanicilistelee = $db->prepare("SELECT * FROM kullanici WHERE kullanici_email=:kullanici_email");

$kullanicilistelee->execute(array(

    'kullanici_email' => $_SESSION['giriskullanici_mail']
));

$profilcek = $kullanicilistelee->fetch(PDO::FETCH_ASSOC);


?>

    <div class="container-fluid mt-4">
        <div class="row">
            <div class="col-md-4 d-flex justify-content-center align-items-center">
            <i class="fa-solid fa-file-circle-check" style="font-size: 500px;"></i>
            </div>
            <div class="col-md-4">
            <p class="text-center h2 text-primary">ONLİNE BAŞARI BELGESİ</p>
            <div class="card" style="width: 100%;">
            <img class="card-img-top" src="image/pixlr-bg-result.png" alt="Card image cap">
            <div class="card-body text-center">
                <h5 class="card-title"><span>Sayın <?php echo $profilcek['kullanici_isim']; echo" ".$profilcek['kullanici_soyad'] ?></span></h5>
                <p class="card-text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Officiis ducimus alias rerum aut eos nam dolores sapiente similique, odio incidunt repellat quia ipsum eius dolore ab, sequi maiores saepe aliquid dolorem ea. Porro provident temporibus magni unde, eum voluptate vel, dolores accusantium ipsum molestiae dolorum nisi velit eaque repellat repudiandae.</p>
                <a href="#" class="btn btn-primary">Go somewhere</a>
            </div>
            </div>
        </div>
        <div class="col-md-4 d-flex justify-content-center align-items-center">
            <i class="fa-solid fa-clipboard-check " style="font-size: 500px;"></i>
        </div>
   
</div>
    </div>

<?php include 'footer.php'; ?>