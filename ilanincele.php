<?php

include 'header.php';


$sirketlistele = $db->prepare("SELECT * FROM sirket_bilgileri WHERE sirket_id=:sirket_id");
$sirketlistele->execute(array(
    'sirket_id' => $_GET['id']
));
$sirketparcala = $sirketlistele->fetch(PDO::FETCH_ASSOC);

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
        <a class="nav-link active ms-0" href="#">İş İlanı</a>

    </nav>
    <hr class="mt-0 mb-4">
    <div class="container">
        <?php if (@$_GET['get'] == "ZGFoYW9uY2V2ZXJpbGRp") { ?>
            <div class="alert alert-danger">
                Daha önce puan verdiniz
            </div>
        <?php } ?>

        <?php if (@$_GET['get'] == "cHVhbnZlcmlsZGk=") { ?>
            <div class="alert alert-success">
                Puanınız kaydedildi
            </div>
        <?php } ?>
    </div>
    <div class="row d-flex justify-content-center">
        <div class="col-xl-4">
            <!-- Profile picture card-->
            <div class="card mb-4 mb-xl-0">
                <div class="card-header">Şirket Konum</div>
                <div class="card-body text-center">
                    <iframe width="100%" height="300" src="https://maps.google.com/maps?q=<?php echo $sirketparcala['sirket_konum']; ?>&output=embed"></iframe>
                </div>
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
                            <input type="text" class="form-control mb-2">
                            <input type="submit" class="form-control btn btn-outline-primary" value="Mesaj Gönder">
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
                        <?php if(@$_SESSION['giriskullanici_mail']){ ?>

                            <form action="baglanti/islem.php" method="post">

                            <div class="col-md-12">
                                <label class="small mb-1" for="inputPhone">Şirketi Puanla</label>
                                <select name="sirketpuan" id="" class="form-control mb-2">
                                    <option value="1">1</option>
                                    <option value="2">2</option>
                                    <option value="3">3</option>
                                    <option value="4">4</option>
                                    <option value="5">5</option>
                                </select>
                                <input type="submit" name="puangonder" class="form-control btn btn-outline-dark">
                                <input hidden type="text" name="sirket_ilan_id" value="<?php echo @$_GET['id'] ?>">
                                <input hidden type="text" name="sirket_kullanici_id" value="<?php echo @$kullaniciparcala['kullanici_id'] ?>">
                                <input hidden type="text" name="sirket_puan_email" value="<?php echo @$_SESSION['giriskullanici_mail'] ?>">
                            </div>
                            </form>

                                        <?php } ?>
                        <div><input hidden type="text" value="<?php echo @$_SESSION['giriskullanici_mail'] ?>" name="sirket_kullanici_email"></div>
                        <!-- Form Group (birthday)-->

                    </div>
                    <!-- Save changes button-->
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php if (@$_SESSION['giriskullanici_mail']) { ?>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
                <div class="comment-wrapper">
                    <div class="panel panel-info">
                        <div class="panel-heading">
                            Yorum yap
                        </div>
                        <form action="baglanti/islem.php" method="post" enctype="multipart/form-data" name="form1" id="form1">
                            <div class="panel-body">
                                <textarea class="form-control" placeholder="" rows="3" name="sirket_yorum_detay"></textarea>
                                <br>
                                <button type="submit" class="btn btn-dark pull-right" name="yorumyap">Gönder</button>
                                <div class="clearfix"></div>
                                <hr>
                                <ul class="media-list">
                                    <?php $yorumlar = $db->prepare("SELECT * FROM sirket_yorumlar WHERE sirket_ilan_id=:sirket_ilan_id");

                                    $yorumlar->execute(array(

                                        'sirket_ilan_id' => @$_GET['id']
                                    ));
                                    ?>

                                    <?php while ($yorumcek = $yorumlar->fetch(PDO::FETCH_ASSOC)) { ?>
                                        <li class="media">

                                            <div class="container-fluid">
                                                <div class="row">
                                                    <div class="col-md-2 mb-2">
                                                    <?php if($yorumcek["sirket_yorum_resim"] == null){ ?><img src="image/images.png" alt=""> <?php } else { ?>
                                                            <img src="<?php echo $yorumcek['sirket_yorum_resim']; ?>" alt=""> <?php }?>
                                                    </div>
                                                    <div class="col-md-10" style="word-wrap:break-word; text-align: justify;">
                                                        <p><?php
                                                        
                                                        $bolunmusyorum = explode(" ",$yorumcek['sirket_yorum_detay']);
                                                        
                                                        $yasaklikelime  = array_intersect($karaliste,$bolunmusyorum);
                                                        $yasaklikelime2 = str_replace($yasaklikelime,'******',$yorumcek['sirket_yorum_detay']);
                                                            if($yasaklikelime2){
                                                               echo $yasaklikelime2;
                                                            }
                                                           
                                                            ?></p>
                                                    </div>
                                                </div>
                                            </div>


                                            <span class="text-muted pull-right">
                                                <strong class="text-success">@<?php echo $yorumcek['sirket_yorum_isim'] ?></strong>
                                            </span>
                                            <?php if ($yorumcek['sirket_yorum_email'] == $_SESSION['giriskullanici_mail']) { ?><p><a href="baglanti/islem.php?yorumid=<?php echo $yorumcek['sirket_yorum_id']; ?>&yorumsil=ok&ilanid=<?php echo $yorumcek['sirket_ilan_id'] ?>" class="btn btn-sm btn-outline-dark mt-2 w-100">Yorum Sil</a></p><?php } ?>
                                        </li>

                                    <?php } ?>

                                    <input hidden type="text" name="sirket_ilan_id" value="<?php echo @$_GET['id'] ?>">
                                    <input hidden type="text" name="sirket_yorum_resim" value="<?php echo $kullaniciparcala['kullanici_resim'] ?>">
                                    <input hidden type="text" name="sirket_yorum_email" value="<?php echo $_SESSION['giriskullanici_mail'] ?>">
                                </ul>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
<?php } else { ?>

    <div class="alert alert-danger container">Yorumları görebilmek için giriş yapmanız veya üye olmanız gerekli <a href="giris.php" class="btn btn-sm btn-outline-dark">Giriş yap</a> <a href="kayit.php" class="btn btn-sm btn-light">Kayıt Ol</a></div>

<?php } ?>

<?php include 'footer.php'; ?>