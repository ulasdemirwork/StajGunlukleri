<?php include 'header.php' ?>

<?php $kullanicilistelee = $db->prepare("SELECT * FROM kullanici WHERE kullanici_email=:kullanici_email");

$kullanicilistelee->execute(array(

    'kullanici_email' => $_SESSION['giriskullanici_mail']
));

$profilcek = $kullanicilistelee->fetch(PDO::FETCH_ASSOC);




?>


<div class="container-xl px-4 mt-4 vh-100">
    <!-- Account page navigation-->
    <nav class="nav nav-borders">
        <a class="nav-link active ms-0" href="#">Şifre</a>

    </nav>
    <hr class="mt-0 mb-4">
    <div class="row">
        <div class="col-xl-4">
            <!-- Profile picture card-->

        </div>
        <div class="col-xl-12">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Şifre Değiştir</div>
                <div class="card-body">
                    <form method="post" action="baglanti/islem.php">
                        <!-- Form Group (username)-->
                        <?php if (isset($_GET['get']) == "Z3VuY2VsbGViYXNhcmlsaQ==") { ?>
                            <div class="alert alert-success">Güncelleme Başarılı</div>
                        <?php } ?>
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">Şifre Giriniz</label>
                                <input required class="form-control" id="inputFirstName" type="password" placeholder="Şifrenizi Giriniz" name="kullanici_sifre">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Şifrenizi Tekrar Giriniz</label>
                                <input required class="form-control" id="inputLastName" type="password" placeholder="Şifrenizi Tekrar Giriniz" name="kullanici_sifre">
                            </div>
                        </div>
                        <!-- Form Row        -->

                        <!-- Form Group (email address)-->
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->

                            <div><input hidden type="text" value="<?php echo $profilcek['kullanici_id'] ?>" name="kullanici_id"></div>
                            <!-- Form Group (birthday)-->

                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" name="sifreguncelle">Şifre Güncelle</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php'; ?>