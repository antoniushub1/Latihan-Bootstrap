<div class="kontak">
    <div id="contact" class="container section">
        <div class="text-center mb-5">
            <h2>Contact</h2>
            <p>Silakan hubungi saya.</p>
        </div>

        <div class="row align-items-center">
            <div class="col-12 col-md-6 text-center mb-4 mb-md-0">
                <img src="img/astronot kontak.png" alt="Contact" class="img-fluid">
            </div>

            <div class="col-12 col-md-6">
                <?php if (isset($_GET['status']) && $_GET['status'] == 'sukses'): ?>
                    <div class="alert alert-success alert-dismissible fade show mb-3" role="alert">
                        Pesan Anda Telah Terkirim!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php elseif (isset($_GET['status']) && $_GET['status'] == 'gagal'): ?>
                    <div class="alert alert-danger alert-dismissible fade show mb-3" role="alert">
                        Gagal menyimpan pesan ke database.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                <?php endif; ?>

                <form action="index.php" method="POST">
                    <div class="mb-3">
                        <label class="form-label">Nama</label>
                        <input type="text" name="nama" class="form-control" placeholder="Nama kamu" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Email kamu" required>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Pesan</label>
                        <textarea name="pesan" class="form-control" rows="4" placeholder="Tulis pesan..." required></textarea>
                    </div>
                    <button type="submit" name="kirim_pesan" class="btn btn-primary w-100">Kirim Pesan</button>
                </form>
            </div>
        </div>
    </div>
</div>