<?php include 'header.php' ?>
<style>
  .divider:after,
  .divider:before {
    content: "";
    flex: 1;
    height: 1px;
    background: #eee;
  }

  .h-custom {
    height: calc(100% - 73px);
  }

  @media (max-width: 450px) {
    .h-custom {
      height: 100%;
    }
  }
</style>
<section class="vh-100">
  <div class="container-fluid h-custom">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-md-9 col-lg-6 col-xl-5">
        <img src="image/pexels-pixabay-267885-2-1200x720.jpg" class="img-fluid rounded" alt="Sample image">
      </div>
      <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
        <form action="baglanti/islem.php" method="post">

          <?php if (isset($_GET['get']) == base64_decode('Z2lyaXNiYXNhcmlzaXo=')) { ?>
            <div class="alert alert-danger">Giris Başarısız</div>
          <?php } ?>
          <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
            <p class="lead fw-normal mb-0 me-3">Lütfen Giriş Yapın</p>
          </div>

          <div class="divider d-flex align-items-center my-4">
            <p class="text-center fw-bold mx-3 mb-0">Giriş Yap</p>
          </div>

          <!-- Email input -->
          <div class="form-outline mb-4">
            <input required type="email" name="kullanici_email" id="form3Example3" class="form-control form-control-lg" placeholder="Email adresinizi giriniz" />
            <label class="form-label" for="form3Example3">Mail Adresiniz</label>
          </div>

          <!-- Password input -->
          <div class="form-outline mb-3">
            <input required type="password" name="kullanici_sifre" id="form3Example4" class="form-control form-control-lg" placeholder="Şifrenizi giriniz" />
            <label class="form-label" for="form3Example4">Şifreniz</label>
          </div>



          <div class="text-center text-lg-start mt-4 pt-2">
            <button type="submit" name="giris" class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Giriş Yap</button>
            <p class="small fw-bold mt-2 pt-1 mb-0">Hesabınız yok mu ? hemen oluştur <a href="kayit.php" class="link-danger">Kayıt Ol</a></p>
            <p class="small fw-bold mt-2 pt-1 mb-0">Şifrenizi mi unuttunuz ? <a href="sifremiunuttum.php" class="link-danger">Şifremi Unuttum</a></p>
          </div>

        </form>
      </div>
    </div>
  </div>