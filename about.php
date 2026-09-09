<?php
// Query Data Skills untuk Chart
$query_skills = mysqli_query($conn, "SELECT * FROM skills");
$chart_labels = [];
$chart_data   = [];

while ($row = mysqli_fetch_assoc($query_skills)) {
    $chart_labels[] = $row['nama_skill'];
    $chart_data[]   = $row['persentase'];
}
?>

<div class="aboutbackground">
    <div id="about" class="about section">
        <div class="container">
            <div class="text-center mb-5">
                <h2>About Me</h2>
                <p>Kenali saya lebih jauh.</p>
            </div>

            <div class="row align-items-center">
                <div class="col-12 col-md-6 text-center mb-4 mb-md-0">
                    <img src="img/ius.png" alt="About Me" class="img-fluid">
                </div>
                <div class="col-12 col-md-6">
                    <h2>Saya Antonius</h2>
                    <p>Saya adalah seorang Mahasiswa Politeknik Atmi Surakarta Program studi Teknik Mekatronika (D3), saat ini saya sedang menjalani perkuliahan Tahun ketiga, Banyak hal yang saya pelajari, mulai dari Mikrokontroler, PLC, Sensorik, Pemrograman, Instalasi Kelistrikan, Teknik Kendali dan lain lain</p>
                    <div class="d-flex gap-2 flex-wrap mt-3">
                        <span class="badge text-bg-primary">HTML</span>
                        <span class="badge text-bg-secondary">CSS</span>
                        <span class="badge text-bg-success">Bootstrap</span>
                        <span class="badge text-bg-warning">PHP & MySQL</span>
                    </div>
                </div>
            </div>

            <div class="chart-box mt-5">
                <h3 class="text-center mb-4">Tingkat Kemampuan</h3>
                <canvas id="myChart"></canvas>
            </div>
        </div>
    </div>
</div>