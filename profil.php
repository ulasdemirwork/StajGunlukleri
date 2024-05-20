<?php include 'header.php' ?>

<?php $kullanicilistelee = $db->prepare("SELECT * FROM kullanici WHERE kullanici_email=:kullanici_email");

$kullanicilistelee->execute(array(

    'kullanici_email' => $_SESSION['giriskullanici_mail']
));

$profilcek = $kullanicilistelee->fetch(PDO::FETCH_ASSOC);






?>


<div class="container-xl px-4 mt-4 vh-100" >
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="#">Profil</a>

    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Profile Fotoğrafı</div>
                <div class="card-body text-center">
                    <!-- Profile picture image-->
                    <form method="post" action="baglanti/islem.php" enctype="multipart/form-data" name="form1" id="form1">
                        <img class="img-account-profile rounded-circle mb-2" src="<?php echo $profilcek['kullanici_resim'] ?>" alt="" width="100%">
                        <!-- Profile picture help block-->

                        <!-- Profile picture upload button-->

                        <div>
                            <input type="file" value="Fotoğraf Yükle" class="form-control" name="kullanici_resim">
                        </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Profil Detayları</div>
                <div class="card-body">
                    <!-- Form Group (username)-->
                    <?php if (isset($_GET['get']) == "Z3VuY2VsbGViYXNhcmlsaQ==") { ?>
                        <div class="alert alert-success">Güncelleme Başarılı</div>
                    <?php } ?>
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (first name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputFirstName">İsim Giriniz</label>
                            <input required class="form-control" id="inputFirstName" type="text" placeholder="İsim Giriniz" value="<?php echo $profilcek['kullanici_isim'] ?>" name="kullanici_isim">
                        </div>
                        <!-- Form Group (last name)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputLastName">Soyisim</label>
                            <input required class="form-control" id="inputLastName" type="text" placeholder="Soyisim Giriniz" value="<?php echo $profilcek['kullanici_soyad'] ?>" name="kullanici_soyad">
                        </div>
                    </div>
                    <!-- Form Row        -->

                    <!-- Form Group (email address)-->
                    <!-- Form Row-->
                    <div class="row gx-3 mb-3">
                        <!-- Form Group (phone number)-->
                        <div class="col-md-6">
                            <label class="small mb-1" for="inputPhone">Telefon Numarası</label>
                            <input required class="form-control" id="inputPhone" type="tel" placeholder="Telefon Numarası Giriniz" value="<?php echo $profilcek['kullanici_telefon'] ?>" name="kullanici_telefon">
                        </div>
                        <div><input hidden type="text" value="<?php echo $profilcek['kullanici_id'] ?>" name="kullanici_id"></div>
                        <!-- Form Group (birthday)-->
                    </div>
                    <!-- Save changes button-->
                    <button class="btn btn-primary" type="submit" name="profilguncelle">Profili Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
               
<?php include 'footer.php'; ?>