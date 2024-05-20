<?php include 'header.php'; ?>

<?php if ($_POST) {
    $kod = $_GET['kod'];

    $kullanici_email = $_POST['kullanici_email'];
    $kullanici_sifre = $_POST['kullanici_sifre'];
    $kullanici_sifretekrar = $_POST['kullanici_sifretekrar'];
    $hashsifre = password_hash($kullanici_sifre, PASSWORD_DEFAULT);

    $sorgula = $db->prepare("SELECT * FROM kullanici WHERE unuttum_kod=:unuttum_kod and kullanici_email=:kullanici_email");
    $sorgula->execute(array(
        'kullanici_email' => $kullanici_email,
        'unuttum_kod' => $kod
    ));

    if ($sorgula->rowCount()) {

        if ($kullanici_sifre == $kullanici_sifretekrar) {
            if (strlen($kullanici_sifre) >= 4) {
                $guncelle = $db->prepare("UPDATE kullanici SET kullanici_sifre=:kullanici_sifre,unuttum_kod=:unuttum_kodu WHERE unuttum_kod=:unuttum_kod and kullanici_email=:kullanici_email");
                $guncelle->execute(array(
                    'kullanici_sifre' => $hashsifre,
                    'unuttum_kod' => $kod,
                    'unuttum_kodu' => "",
                    'kullanici_email' => $kullanici_email
                ));
                if ($guncelle) {

                    header("Location:sifremisifirla.php?get=basarili&kod=$kod");
                } else {
                    header("Location:sifremisifirla.php?get=basarisiz&kod=$kod");
                }
            } else {
                header("Location:sifremisifirla.php?get=sifreuzunluk&kod=$kod");
            }
        } else {
            header("Location:sifremisifirla.php?get=sifreesitlik&kod=$kod");
        }
    } else {
        header("Location:sifremisifirla.php?get=kullaniciyok&kod=$kod");
    }
} ?>

<div class="container-fluid vh-100">
    <div class="row d-flex justify-content-center align-items-center h-100">

        <div class="col-md-12 col-lg-6 col-xl-4 offset-xl-1">
            <form action="" method="post">
                <?php if (@$_GET['get'] == "sifreuzunluk") { ?>
                    <div class="alert alert-danger">
                        Şifre karakter uzunluğu 4'den büyük olmalı.
                    </div>
                <?php } ?>
                <?php if (@$_GET['get'] == "basarisiz") { ?>
                    <div class="alert alert-danger">
                        Şifre değişikliği başarısız.
                    </div>
                <?php } ?>
                <?php if (@$_GET['get'] == "sifreesitlik") { ?>
                    <div class="alert alert-danger">
                        Şifreler eşit değil.
                    </div>
                <?php } ?>
                <?php if (@$_GET['get'] == "basarili") { ?>
                    <div class="alert alert-success">
                        Şifre değiştirme başarılı.
                    </div>
                <?php } ?>

                <?php if (@$_GET['get'] == "kullaniciyok") { ?>
                    <div class="alert alert-danger">
                        Kullanıcı veya kod yok.
                    </div>
                <?php } ?>
                <div class="divider d-flex align-items-center justify-content-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0">Şifremi Unuttum</p>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input required type="email" name="kullanici_email" id="form3Example3" class="form-control form-control-lg" placeholder="Email adresinizi giriniz" required />
                    <label class="form-label" for="form3Example3">Mail Adresiniz</label>
                </div>

                <div class="form-outline mb-4">
                    <input required type="password" name="kullanici_sifre" id="form3Example3" class="form-control form-control-lg" placeholder="Şifrenizi  giriniz" required />
                    <label class="form-label" for="form3Example3">Şifreniz </label>
                </div>

                <div class="form-outline mb-4">
                    <input required type="password" name="kullanici_sifretekrar" id="form3Example3" class="form-control form-control-lg" placeholder="Şifrenizi Tekrar giriniz" required />
                    <label class="form-label" for="form3Example3">Şifreniz </label>
                </div>

                <div class="text-center text-lg-start mt-4 pt-2 ">
                    <p class="text-center">
                        <button class="btn btn-primary btn-lg" name="sifreguncelle" style="padding-left: 2.5rem; padding-right: 2.5rem;">Kod Gönder</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>