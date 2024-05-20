<?php include 'header.php';

$cvlistele = $db->prepare("SELECT * FROM stajyer_bilgileri WHERE stajyer_id=:stajyer_id");
$cvlistele->execute(array(
    'stajyer_id' => @$_GET['cvid']
));
$cvparcala = $cvlistele->fetch(PDO::FETCH_ASSOC);

$stajyerbilgileri = $db->prepare("SELECT * FROM stajyer_bilgileri WHERE stajyer_email=:stajyer_email");

$stajyerbilgileri->execute(array(

    'stajyer_email' => @$_SESSION['giriskullanici_mail']
));

$stajyerbilgilericek = $stajyerbilgileri->fetch(PDO::FETCH_ASSOC);



$karaliste = array("tavuk","salak","mal","dana","deli");
?>

<style>
    .comment-wrapper .panel-body {
        max-height: 650px;

    }

    .comment-wrapper .media-list .media img {
        width: 170px;
        height: 100px;
        border: 2px solid #e5e7e8;
    }

    .comment-wrapper .media-list .media {
        border-bottom: 1px dashed #efefef;
        margin-bottom: 25px;
    }
</style>

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
                    <img class="img-account-profile rounded-circle mb-2" src="<?php echo $cvparcala['stajyer_resimyol'] ?>" alt="" width="100%">
                    <input type="text" name="mesaj" class="form-control mb-2">
                    <div>
                        <button class="btn btn-primary" type="button">Mesaj Gönder</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-8">
            <!-- Account details card-->
            <div class="card mb-4">
                <div class="card-header">Cv Detayları</div>
                <div class="card-body">
                    <form method="post" action="baglanti/islem.php" enctype="multipart/form-data">
                        <!-- Form Group (username)-->
                        <!-- Form Row-->
                        <div class="row gx-3 mb-3">
                            <!-- Form Group (first name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputFirstName">İsim Giriniz</label>
                                <input class="form-control" id="inputFirstName" type="text" placeholder="İsim Giriniz" name="stajyer_isim" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                                                        echo @$cvparcala['stajyer_isim'];
                                                                                                                                                    }  ?>">
                            </div>
                            <!-- Form Group (last name)-->
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputLastName">Soyisim</label>
                                <input class="form-control" id="inputLastName" type="text" placeholder="Soyisim Giriniz" name="stajyer_soyisim" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                                                            echo $cvparcala['stajyer_soyisim'];
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
                                <input type="text" name="stajyer_yetenekler" class="form-control" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                echo $cvparcala['stajyer_yetenekler'];
                                                                                                            } ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Eğitim Lise</label><br>
                                <input type="text" name="stajyer_egitim_lise" class="form-control" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                echo $cvparcala['stajyer_egitim_lise'];
                                                                                                            } ?>">
                            </div>

                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Eğitim Üniversite</label><br>
                                <input type="text" name="stajyer_egitim_universite" class="form-control" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                                    echo $cvparcala['stajyer_egitim_universite'];
                                                                                                                } ?>">
                            </div>
                            <div class="col-md-6">
                                <label class="small mb-1" for="inputPhone">Telefon Numarası</label><br>
                                <input type="text" name="stajyer_telefon" class="form-control" value="<?php if ($cvlistele->rowCount() == 1) {
                                                                                                            echo $cvparcala['stajyer_telefon'];
                                                                                                        } ?>">
                            </div>
                            <div><input hidden type="text" value="<?php echo @$_SESSION['giriskullanici_mail'] ?>" name="giriskullanici_email"></div>
                            <!-- Form Group (birthday)-->
                        </div>
                        <!-- Save changes button-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container mt-4  card">
                        <div class="row  mt-4">     
                        <div class="col-md-6">
                        <p class="text-center">  <span>Sosyal Medya Hesapları</span></p>
                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fa-brands fa-facebook-f"></i>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control" name="stajyer_facebook" value="<?php if($cvlistele->rowCount() ==1 ){ echo $cvparcala['stajyer_facebook']; }?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fa-brands fa-instagram"></i>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control"  name="stajyer_instagram" value="<?php if($cvlistele->rowCount() ==1 ){ echo $cvparcala['stajyer_instagram']; }?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fab fa-linkedin-in"></i>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control"  name="stajyer_linkedin" value="<?php if($cvlistele->rowCount() ==1 ){ echo $cvparcala['stajyer_linkedin']; }?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fab fa-github"></i>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control"  name="stajyer_github" value="<?php if($cvlistele->rowCount() ==1 ){ echo $cvparcala['stajyer_github']; }?>">
                                </div>
                            </div>

                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fa-brands fa-youtube"></i>
                                </div>
                                <div class="col-md-10">
                                    <input type="text" class="form-control"  name="stajyer_youtube" value="<?php if($cvlistele->rowCount() ==1 ){ echo $cvparcala['stajyer_youtube']; }?>">
                                </div>
                            </div>
                            <div class="row mb-2">
                                <div class="col-md-1 ">
                                <i class="fas fa-user"></i>
                                </div>
                                <div class="col-md-10">
                                   <textarea name="stajyer_hakkimda" id="" cols="30" rows="10" class="form-control" placeholder="Kendinizi tanıtınız..."><?php if($cvlistele->rowCount() ==1 ){ echo $cvparcala['stajyer_hakkimda']; }?></textarea>
                                </div>
                            </div>
                         </div>
                        <div class="col-md-6">
                        <p class="text-center">  <span>Proje (1) Görseli</span></p>
                            <a href="#"><img src="<?php if($cvlistele->rowCount() ==1 ){ echo $cvparcala['proje1_resim']; } ?>" alt="" width="100%"></a> 
                            <div class="row mt-2">
                                <div class="col-md-1 mt-2"><i class="fas fa-link"></i></div>
                                <div class="col-md-11">
                                    <input type="text" class="form-control" name="proje1_link" placeholder="Proje(1) linkini bırakınız.." value="<?php if($cvlistele->rowCount() ==1 ){ echo $cvparcala['proje1_link']; }?>">
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            
                        </div>
                        <div class="col-md-6 mb-4 mt-4">
                        <p class="text-center">  <span>Proje (2) Görseli</span></p>
                            <a href="#"><img src="<?php if($cvlistele->rowCount() ==1 ){ echo $cvparcala['proje2_resim'];} ?>" alt="" width="100%"></a>
                            <div class="row mt-2">
                                <div class="col-md-1 mt-2"><i class="fas fa-link"></i></div>
                                <div class="col-md-11">
                                    <input type="text" class="form-control" name="proje2_link" placeholder="Proje(2) linkini bırakınız.." value="<?php if($cvlistele->rowCount() ==1 ){ echo $cvparcala['proje2_link']; }?>">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
<?php if (@$_SESSION['giriskullanici_mail']) { ?>
    <div class="container">
        <div class="row bootstrap snippets bootdeys">
            <div class="col-md-12 col-sm-12">
                <div class="comment-wrapper">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                           <p class="pb-4 pt-4"> <span class="h4 p-4">Yorum Yap</span></p>
                        </div>
                        <form action="baglanti/islem.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                            <div class="panel-body">
                                <textarea class="form-control" placeholder="" rows="3" name="stajyer_yorum_detay"></textarea>
                                <br>
                                <button type="submit" class="btn btn-dark pull-right" name="cvyorumyap">Gönder</button>
                                <div class="clearfix"></div>
                                <hr>
                                <ul class="media-list">
                                    <?php $cvyorumlar = $db->prepare("SELECT * FROM stajyer_yorumlar WHERE stajyer_cv_id=:stajyer_cv_id");

                                    $cvyorumlar->execute(array(

                                        'stajyer_cv_id' => @$_GET['cvid']
                                    ));
                                    ?>

                                    <?php while ($cvyorumcek = $cvyorumlar->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <li class="media">

                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-2 mb-2">
                                                        <?php if($cvyorumcek["stajyer_yorum_resim"] == null){ ?><img src="image/images.png" alt=""> <?php } else { ?>
                                                            <img src="<?php echo $cvyorumcek['stajyer_yorum_resim']; ?>" alt=""> <?php }?>
                                                    </div>
                                                    <div class="col-md-10" style="word-wrap:break-word;  text-align: justify;">
                                                        <p><?php
                                                        
                                                        $bolunmusyorum = explode(" ",$cvyorumcek['stajyer_yorum_detay']);
                                                        
                                                        $yasaklikelime  = array_intersect($karaliste,$bolunmusyorum);
                                                        $yasaklikelime2 = str_replace($yasaklikelime,'******',$cvyorumcek['stajyer_yorum_detay']);
                                                            if($yasaklikelime2){
                                                               echo $yasaklikelime2;
                                                            }
                                                           
                                                            ?>
                                                            </p>
                                                    </div>
                                                </div>
                                            </div>

                                            <span class="text-muted pull-right">
                                                <strong class="text-success">@<?php echo $cvyorumcek['stajyer_yorum_isim'] ?></strong>
                                            </span>
                                            <?php if ($cvyorumcek['stajyer_yorum_email'] == $_SESSION['giriskullanici_mail']) { ?><p><a href="baglanti/islem.php?yorumid=<?php echo $cvyorumcek['stajyer_yorum_id']; ?>&cvyorumsil=ok&cvid=<?php echo $cvyorumcek['stajyer_cv_id'] ?>" class="btn btn-sm btn-outline-dark mt-2 w-100">Yorum Sil</a></p><?php } ?>
                                        </li>

                                    <?php } ?>

                                    <input hidden type="text" name="stajyer_cv_id" value="<?php echo @$_GET['cvid'] ?>">
                                    <input hidden type="text" name="stajyer_yorum_resim" value="<?php echo $kullaniciparcala['kullanici_resim'] ?>">
                                    <input hidden type="text" name="stajyer_yorum_email" value="<?php echo $_SESSION['giriskullanici_mail'] ?>">
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
                 
<?php } else { ?>

    <div class="alert alert-danger container mt-4">Yorumları görebilmek için giriş yapmanız veya üye olmanız gerekli <a href="giris.php" class="btn btn-sm btn-outline-dark">Giriş yap</a> <a href="kayit.php" class="btn btn-sm btn-light">Kayıt Ol</a></div>

<?php } 



?>
<?php include 'footer.php'; ?>