<?php include 'header.php';

$cvlistele = $db->prepare("SELECT * FROM stajyer_bilgileri WHERE stajyer_email=:stajyer_email");
$cvlistele->execute(array(
    'stajyer_email' => @$_SESSION['giriskullanici_mail']
));
$cvparcala = $cvlistele->fetch(PDO::FETCH_ASSOC);


$sirketlistele = $db->prepare("SELECT * FROM sirket_bilgileri WHERE sirket_kullanici_email=:sirket_kullanici_email");
$sirketlistele->execute(array(
    'sirket_kullanici_email' => @$_SESSION['giriskullanici_mail']
));
$sirketparcala = $sirketlistele->fetch(PDO::FETCH_ASSOC);

$stajyerbilgileri = $db->prepare("SELECT * FROM stajyer_bilgileri WHERE stajyer_email=:stajyer_email");

$stajyerbilgileri->execute(array(

    'stajyer_email' => $_SESSION['giriskullanici_mail']
));

$stajyerbilgilericek = $stajyerbilgileri->fetch(PDO::FETCH_ASSOC);

?>



<?php if ($kullaniciparcala['kullanici_tur'] == 1) { ?>


    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="#">Cv</a>

        </nav>
        <hr class="mt-0 mb-4">
        <div class="row">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Profil Fotoğrafı</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <form method="post" action="baglanti/islem.php" enctype="multipart/form-data">
                            <img class="img-account-profile rounded-circle mb-2" src="<?php echo $cvparcala['stajyer_resimyol'] ?>" alt="" width="100%">
                            <!-- Profile picture help block-->

                            <!-- Profile picture upload button-->
                            <div>
                                <input required type="file" class="form-control" name="stajyer_resimyol">
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">Cv Detayları</div>
                    <div class="card-body">

                        <!-- Form Group (username)-->
                        <?php if (@$_GET['get'] == "Y3Z2YXI=") { ?>
                            <div class="alert alert-danger">Daha önce cv oluşturdunuz.</div>
                        <?php }
                        if (@$_GET['get'] == "Y3Znb25kZXJpbGRp") { ?>
                            <div class="alert alert-success">Cv Oluşturuldu</div>
                        <?php }
                        if (@$_GET['get'] == "Y3ZndW5jZWxsZW5kaQ==") { ?>
                            <div class="alert alert-success">Cv Güncellendi</div>
                        <?php }
                        if (@$_GET['get'] == "Y3ZndW5jZWxsZW5tZWRp") { ?>
                            <div class="alert alert-danger">Cv Yok</div>
                        <?php } ?>

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">İsim Giriniz</label>
                                <input required class="form-control" id="inputFirstName" type="text" placeholder="İsim Giriniz" name="stajyer_isim" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                                                                echo @$cvparcala['stajyer_isim'];
                                                                                                                                                            }  ?>">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Soyisim</label>
                                <input required class="form-control" id="inputLastName" type="text" placeholder="Soyisim Giriniz" name="stajyer_soyisim" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                                                                    echo @$cvparcala['stajyer_soyisim'];
                                                                                                                                                                } ?>">
                            </div>
                        </div>
                        <!-- Form Row        -->

                        <!-- Form Group (email address)-->
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Yetenekler</label><br>
                                <input required type="text" name="stajyer_yetenekler" class="form-control" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                        echo @$cvparcala['stajyer_yetenekler'];
                                                                                                                    } ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Eğitim Lise</label><br>
                                <input required type="text" name="stajyer_egitim_lise" class="form-control" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                        echo @$cvparcala['stajyer_egitim_lise'];
                                                                                                                    } ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Eğitim Üniversite</label><br>
                                <input required type="text" name="stajyer_egitim_universite" class="form-control" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                                echo @$cvparcala['stajyer_egitim_universite'];
                                                                                                                            } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Telefon Numarası</label><br>
                                <input required type="text" name="stajyer_telefon" class="form-control" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                    echo @$cvparcala['stajyer_telefon'];
                                                                                                                } ?>">
                            </div>
                            <div><input hidden type="text" value="<?php echo $_SESSION['giriskullanici_mail'] ?>" name="giriskullanici_email"></div>
                            <!-- Form Group (birthday)-->

                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" name="cvgonder">Cv Gönder</button>
                        <button class="btn btn-primary" type="submit" name="cvguncelle">Cv Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <form action="baglanti/islem.php" method="post" enctype="multipart/form-data">
             <?php if(@$_GET['get'] == "Y3Znb25kZXI="){ ?>
                <div class="container alert alert-danger mt-4">
                   
                İlk önce cv göndermelisiniz.
                    
                </div>
                <?php } if(@$_GET['get'] == "Y3Znb25kZXJpbGRpbWk="){ ?>
                    <div class="container alert alert-success mt-4">
                   
                    Cv Gönderildi
                       
                   </div>
                   <?php } ?>
               <div class="container mt-4 card">
                        <div class="row  mt-4">     
                        <div class="col-md-6">
                        <p class="text-center">  <span>Sosyal Medya Hesapları</span></p>
                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fa-brands fa-facebook-f"></i>
                                </div>
                                <div class="col-md-10">
                                    <input required type="text" class="form-control" name="stajyer_facebook" value="<?php if($stajyerbilgileri->rowCount() ==1 ){ echo $stajyerbilgilericek['stajyer_facebook']; }?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fa-brands fa-instagram"></i>
                                </div>
                                <div class="col-md-10">
                                    <input required type="text" class="form-control"  name="stajyer_instagram" value="<?php  if($stajyerbilgileri->rowCount() ==1 ){ echo $stajyerbilgilericek['stajyer_instagram']; }?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fab fa-linkedin-in"></i>
                                </div>
                                <div class="col-md-10">
                                    <input required type="text" class="form-control"  name="stajyer_linkedin" value="<?php  if($stajyerbilgileri->rowCount() ==1 ){ echo $stajyerbilgilericek['stajyer_linkedin']; }?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fab fa-github"></i>
                                </div>
                                <div class="col-md-10">
                                    <input required type="text" class="form-control"  name="stajyer_github" value="<?php  if($stajyerbilgileri->rowCount() ==1 ){ echo $stajyerbilgilericek['stajyer_github']; }?>">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fa-brands fa-youtube"></i>
                                </div>
                                <div class="col-md-10">
                                    <input required type="text" class="form-control"  name="stajyer_youtube" value="<?php  if($stajyerbilgileri->rowCount() ==1 ){ echo $stajyerbilgilericek['stajyer_youtube']; }?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fas fa-user"></i>
                                </div>
                                <div class="col-md-10">
                                   <textarea required name="stajyer_hakkimda" id="" cols="30" rows="10" class="form-control" placeholder="Kendinizi tanıtınız..."><?php  if($stajyerbilgileri->rowCount() ==1 ){ echo $stajyerbilgilericek['stajyer_hakkimda']; }?></textarea>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-1 ">
                                <i class="fas fa-paper-plane"></i>
                                </div>
                                <div class="col-md-10">
                                  <button  type="submit" class="form-control btn btn-outline-dark" name="projegonder">Gönder</button>
                                </div>
                            </div>
                         </div>
                        <div class="col-md-6">
                        <p class="text-center">  <span>Proje (1) Görseli</span></p>
                            <a href="#"><img src="<?php  if($stajyerbilgileri->rowCount() ==1 ){ echo $stajyerbilgilericek['proje1_resim']; } ?>" alt="" width="100%"></a>
                            <input  required type="file" class="form-control mt-2" name="proje1_resim">
                            <div class="row mt-2">
                                <div class="col-md-1 mt-2"><i class="fas fa-link"></i></div>
                                <div class="col-md-11">
                                    <input required type="text" class="form-control" name="proje1_link" placeholder="Proje(1) linkini bırakınız.." value="<?php  if($stajyerbilgileri->rowCount() ==1 ){ echo $stajyerbilgilericek['proje1_link'];}?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6 mb-4 mt-4">
                        <p class="text-center">  <span>Proje (2) Görseli</span></p>
                            <a href="#"><img src="<?php  if($stajyerbilgileri->rowCount() ==1 ){ echo $stajyerbilgilericek['proje2_resim']; } ?>" alt="" width="100%"></a>
                            <input required type="file" class="form-control mt-2" name="proje2_resim">
                            <div class="row mt-2">
                                <div class="col-md-1 mt-2"><i class="fas fa-link"></i></div>
                                <div class="col-md-11">
                                    <input required type="text" class="form-control" name="proje2_link" placeholder="Proje(2) linkini bırakınız.." value="<?php  if($stajyerbilgileri->rowCount() ==1 ){ echo $stajyerbilgilericek['proje2_link']; }?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
               </form>

<?php } ?>
<?php if ($kullaniciparcala['kullanici_tur'] == 2) { ?>



    <div class="container-xl px-4 mt-4">
        <!-- Account page navigation-->
        <nav class="nav nav-borders">
            <a class="nav-link active ms-0" href="#">İş İlanı</a>

        </nav>
        <hr class="mt-0 mb-4">
        <div class="row d-flex justify-content-center">
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Şirket Konum</div>

                    <form method="post">
                        <p>
                            <input type="text" name="adres" placeholder="Konum Belirtiniz" class="form-control mt-1">
                        <p class="text-center"><span>(Konumu gönder dedikten sonra ilanı güncelleyiniz)</span></p>
                        </p>
                        <input type="submit" name="konumgonder" value="Konum Gonder" class="form-control mb-2">
                        <?php if (isset($_POST['konumgonder'])) {
                            $adres = $_POST["adres"];
                            $adres = str_replace(" ", "+", $adres);
                        } ?>
                        <iframe width="100%" height="200" src="https://maps.google.com/maps?q=<?php echo $sirketparcala['sirket_konum']; ?>&output=embed"></iframe>
                    </form>

                </div>
            </div>
            <div class="col-xl-4">
                <!-- Profile picture card-->
                <div class="card mb-4 mb-xl-0">
                    <div class="card-header">Şirket Görsel</div>
                    <div class="card-body text-center">
                        <!-- Profile picture image-->
                        <form method="post" action="baglanti/islem.php" enctype="multipart/form-data">
                            <img class="img-account-profile rounded-circle mb-2" src="<?php echo @$sirketparcala['sirket_resimyol'] ?>" alt="" width="100%">
                            <!-- Profile picture help block-->

                            <!-- Profile picture upload button-->
                            <div>
                                <input required type="file" class="form-control" name="sirket_resimyol" valu>
                            </div>
                    </div>
                </div>
            </div>
            <div class="col-xl-8 mt-4">
                <!-- Account details card-->
                <div class="card mb-4">
                    <div class="card-header">İlan Detayları</div>
                    <div class="card-body">

                        <!-- Form Group (username)-->
                        <?php if (@$_GET['get'] == "aWxhbnZhcg==") { ?>
                            <div class="alert alert-danger">Daha önce ilan oluşturdunuz.</div>
                        <?php }
                        if (@$_GET['get'] == "aWxhbmdvbmRlcmlsZGk=") { ?>
                            <div class="alert alert-success">İlan Oluşturuldu</div>
                        <?php }
                        if (@$_GET['get'] == "aWxhbmd1bmNlbGxlbmRp") { ?>
                            <div class="alert alert-success">İlan Güncellendi</div>
                        <?php }
                        if (@$_GET['get'] == "aWxhbmd1bmNlbGxlbmVtZWRp") { ?>
                            <div class="alert alert-danger">İlan Yok</div>
                        <?php } ?>

                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputFirstName">Şirket İsim </label>
                                <input required class="form-control" id="inputFirstName" type="text" placeholder="İsim Giriniz" name="sirket_isim" value="<?php if ($sirketlistele->rowCount() == 1) {
                                                                                                                                                                echo @$sirketparcala['sirket_isim'];
                                                                                                                                                            }  ?>">
                            </div>
                            <!-- Form Group (last name)-->

                        </div>
                        <!-- Form Row        -->

                        <!-- Form Group (email address)-->
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (phone number)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Şirket Ünvan</label><br>
                                <input required type="text" name="sirket_unvan" class="form-control" value="<?php if ($sirketlistele->rowCount() == 1) {
                                                                                                                echo @$sirketparcala['sirket_unvan'];
                                                                                                            } ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Şirket Vİzyon</label><br>
                                <input required type="text" name="sirket_vizyon" class="form-control" value="<?php if ($sirketlistele->rowCount() == 1) {
                                                                                                                    echo @$sirketparcala['sirket_vizyon'];
                                                                                                                } ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Şirket Misyon</label><br>
                                <input required type="text" name="sirket_misyon" class="form-control" value="<?php if ($sirketlistele->rowCount() == 1) {
                                                                                                                    echo @$sirketparcala['sirket_misyon'];
                                                                                                                } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Telefon Numarası</label><br>
                                <input required type="tel" name="sirket_telefon" class="form-control" value="<?php if ($sirketlistele->rowCount() == 1) {
                                                                                                                    echo @$sirketparcala['sirket_telefon'];
                                                                                                                } ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputPhone">Şirket Email</label><br>
                                <input required type="email" name="sirket_email" class="form-control" value="<?php if ($sirketlistele->rowCount() == 1) {
                                                                                                                    echo @$sirketparcala['sirket_email'];
                                                                                                                } ?>">
                            </div>
                            <div class="col-md-12">
                                <label class="small mb-1" for="inputPhone">Şirket Adres</label><br>
                                <textarea required type="text" name="sirket_adres" class="form-control"><?php if ($sirketlistele->rowCount() == 1) {
                                                                                                            echo @$sirketparcala['sirket_adres'];
                                                                                                        } ?></textarea>
                            </div>

                            <div class="col-md-12">
                                <label class="small mb-1" for="inputPhone">Şirket Açıklama</label><br>
                                <textarea required type="text" name="sirket_aciklama" class="form-control"><?php if ($sirketlistele->rowCount() == 1) {
                                                                                                                echo @$sirketparcala['sirket_aciklama'];
                                                                                                            } ?></textarea>
                            </div>
                            <div><input hidden type="text" value="<?php echo $_SESSION['giriskullanici_mail'] ?>" name="sirket_kullanici_email"></div>
                            <div><input hidden type="text" value="<?php echo $adres ?>" name="sirket_konum"></div>
                            <!-- Form Group (birthday)-->

                        </div>
                        <!-- Save changes button-->
                        <button class="btn btn-primary" type="submit" name="ilangonder">İlan Gönder</button>
                        <button class="btn btn-primary" type="submit" name="ilanguncelle">İlan Güncelle</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    


<?php } ?>
<?php include 'footer.php'; ?>