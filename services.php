<div class="serviss">
    <div id="services" class="container section">
        <div class="text-center text-white mb-5">
            <span class="section-label">SERVICES</span>
            <h2>Services</h2>
            <p>Beberapa hal yang saya kerjakan.</p>
        </div>

        <div class="row g-4">
            <?php
            $query_services = mysqli_query($conn, "SELECT * FROM services");
            while ($service = mysqli_fetch_assoc($query_services)) {
            ?>
                <div class="col-12 col-md-4">
                    <div class="box text-center">
                        <div class="service-icon">
                            <img src="<?php echo $service['icon']; ?>" alt="<?php echo $service['judul']; ?>">
                        </div>
                        <h3><?php echo $service['judul']; ?></h3>
                        <p><?php echo $service['deskripsi']; ?></p>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>