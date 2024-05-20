<?php include 'header.php'; ?>


<div class="container-fluid vh-100">
    <div class="row d-flex justify-content-center align-items-center h-100">

        <div class="col-md-12 col-lg-6 col-xl-4 offset-xl-1">
            <form action="mailgonder.php" method="post">
                <?php
                if (@$_GET['get'] == "mailgonderildi") { ?>
                    <div class="alert alert-success">
                        Mail gönderildi mailinizi kontrol edin.
                    </div>
                <?php }
                if (@$_GET['get'] == "mailgonderilmedi") { ?>
                    <div class="alert alert-success">
                        Mail gönderilemedi mailinizi kontrol edin
                    </div>
                <?php }  ?>



                <div class="divider d-flex align-items-center justify-content-center my-4">
                    <p class="text-center fw-bold mx-3 mb-0">Şifremi Unuttum</p>
                </div>

                <!-- Email input -->
                <div class="form-outline mb-4">
                    <input required type="email" name="kullanici_email" id="form3Example3" class="form-control form-control-lg" placeholder="Email adresinizi giriniz" required />
                    <label class="form-label" for="form3Example3">Mail Adresiniz</label>
                </div>

                <div class="text-center text-lg-start mt-4 pt-2 ">
                    <p class="text-center">
                        <button class="btn btn-primary btn-lg" style="padding-left: 2.5rem; padding-right: 2.5rem;">Kod Gönder</button>
                    </p>
                </div>
            </form>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>