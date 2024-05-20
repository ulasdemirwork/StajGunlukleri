<?php include 'header.php' ?>

<section class="vh-100" style="background-color: #eee;">
  <div class="container h-100">
    <div class="row d-flex justify-content-center align-items-center h-100">
      <div class="col-lg-12 col-xl-11">
        <div class="card text-black" style="border-radius: 25px;">
          <div class="card-body p-md-5">
            <div class="row justify-content-center">
              <div class="col-md-10 col-lg-6 col-xl-5 order-2 order-lg-1">

                <p class="text-center h1 fw-bold mb-5 mx-1 mx-md-4 mt-4">Kayıt Ol</p>


                <?php

                if (@$_GET['get'] == 'a2F5aXRiYXNhcmlsaQ==') { ?>

                  <div class="alert alert-success">
                    Kayıt Başarılı
                  </div>
                  <div class="alert alert-primary">
                    <a href="giris.php" class="btn btn-sm btn-outline-primary ">Giriş sayfasına git</a>
                  </div>

                <?php }
                if (@$_GET['get'] == 'a2F5aXRiYXNhcmlzaXo=') { ?>
                  <div class="alert alert-danger">
                    Kayıt Başarısız
                  </div>

                <?php } ?>

                <form class="mx-1 mx-md-4" method="post" action="baglanti/islem.php">

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name="kullanici_isim" />
                      <label class="form-label" for="form3Example1c">İsim Giriniz</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-user fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="text" id="form3Example1c" class="form-control" name="kullanici_soyisim" />
                      <label class="form-label" for="form3Example1c">Soyisim Giriniz</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-envelope fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="email" id="form3Example3c" class="form-control" name="kullanici_email" />
                      <label class="form-label" for="form3Example3c">Email adresinizi giriniz</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-lock fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4c" class="form-control" name="kullanici_sifre" />
                      <label class="form-label" for="form3Example4c">Şifrenizi giriniz</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-key fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <input type="password" id="form3Example4cd" class="form-control" name="kullanici_sifretekrar" />
                      <label class="form-label" for="form3Example4cd">Şifrenizi tekrar giriniz</label>
                    </div>
                  </div>

                  <div class="d-flex flex-row align-items-center mb-4">
                    <i class="fas fa-search fa-lg me-3 fa-fw"></i>
                    <div class="form-outline flex-fill mb-0">
                      <select name="kullanici_tur" id="" class="form-control">
                        <option value="1">Staj Yeri Arıyorum</option>
                        <option value="2">Stajyer Arıyorum</option>
                      </select>
                      <label class="form-label" for="form3Example4cd">Stajyer mi arıyorsunuz yoksa staj yeri mi ?</label>
                    </div>
                  </div>

                  <div class="d-flex justify-content-center mx-4 mb-3 mb-lg-4">
                    <button type="submit" class="btn btn-primary btn-sm" name="kayitol">Kayit Ol</button>
                  </div>

                </form>

              </div>
              <div class="col-md-10 col-lg-6 col-xl-7 d-flex align-items-center order-1 order-lg-2">

                <img src="image/pexels-pixabay-267885-2-1200x720.jpg" class="img-fluid rounded" alt="Sample image">

              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>