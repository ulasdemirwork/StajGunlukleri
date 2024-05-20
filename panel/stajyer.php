<?php include 'header.php'; ?>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                  
                    <!-- DataTales Example -->
                    <div class="card shadow mb-4">
                        <div class="card-header py-3">
                            <h6 class="m-0 font-weight-bold text-primary">Kullanıcılar</h6>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>stajyer İsim</th>
                                            <th>stajyer Soy isim</th>
                                            <th>stajyer Yetenekler</th>
                                            <th>stajyer Eğitim(lise)</th>
                                            <th>stajyer Eğitim(Üniversite)</th>
                                            <th>stajyer Telefon</th>
                                            <th>stajyer Email</th>
                                            <th>stajyer Resim</th>
                                            <th>stajyer Düzenle</th>
                                        </tr>
                                    </thead>
                                        <?php $stajyer = $db->prepare("SELECT * FROM stajyer_bilgileri");
                                        $stajyer->execute();

                                        while($stajyercek = $stajyer->fetch(PDO::FETCH_ASSOC)){
                                        ?>
                                        <tr>
                                            <td><?php echo $stajyercek['stajyer_isim'] ?></td>
                                            <td><?php echo $stajyercek['stajyer_soyisim'] ?></td>
                                            <td><?php echo $stajyercek['stajyer_yetenekler'] ?></td>
                                            <td><?php echo $stajyercek['stajyer_egitim_lise'] ?></td>
                                            <td><?php echo $stajyercek['stajyer_egitim_universite'] ?></td>
                                            <td><?php echo $stajyercek['stajyer_telefon'] ?></td>
                                            <td><?php echo $stajyercek['stajyer_email'] ?></td>
                                            <td style="width: 200px;"><img src="../<?php echo $stajyercek['stajyer_resimyol']; ?>" alt="" width="100%"></td>
                                            <td style="width: 200px;">
                                            <a  href="stajyerduzenle.php?stajyerid=<?php echo $stajyercek['stajyer_id'] ?>" class="btn btn-outline-primary">Düzenle</a>
                                            <a  href="../baglanti/islem.php?stajyerid=<?php echo $stajyercek['stajyer_id'] ?>&stajyersil=tamam"class="btn btn-outline-danger">Sil</a>
                                        </tr>
                                        <?php }?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2020</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Ready to Leave?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Select "Logout" below if you are ready to end your current session.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancel</button>
                    <a class="btn btn-primary" href="login.html">Logout</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/datatables/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables/dataTables.bootstrap4.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/datatables-demo.js"></script>

</body>

</html>