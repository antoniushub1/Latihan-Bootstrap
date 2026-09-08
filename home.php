<?php
// 1. KONEKSI DATABASE
$host = "localhost";
$user = "root";
$pass = "";
$db   = "Web-PHP";

$conn = mysqli_connect($host, $user, $pass, $db);

if (!$conn) {
    die("Koneksi Database Gagal: " . mysqli_connect_error());
}

// 2. PROSES SIMPAN FORM CONTACT (MENGGUNAKAN REDIRECT AGAR TIDAK DUPLIKAT SAAT REFRESH)
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['kirim_pesan'])) {
    $nama  = mysqli_real_escape_string($conn, $_POST['nama']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $pesan = mysqli_real_escape_string($conn, $_POST['pesan']);

    $sql_insert = "INSERT INTO pesan_kontak (nama, email, pesan) VALUES ('$nama', '$email', '$pesan')";
    
    if (mysqli_query($conn, $sql_insert)) {
        // Redirect kembali ke home.php dengan status sukses untuk membersihkan isi $_POST
        header("Location: home.php?status=sukses#contact");
        exit();
    } else {
        header("Location: home.php?status=gagal#contact");
        exit();
    }
}

// 3. AMBIL DATA SKILLS UNTUK GRAFIK DINAMIS
$query_skills = mysqli_query($conn, "SELECT * FROM skills");
$chart_labels = [];
$chart_data   = [];

while ($row = mysqli_fetch_assoc($query_skills)) {
    $chart_labels[] = $row['nama_skill'];
    $chart_data[]   = $row['persentase'];
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>My Portfolio - Dynamic</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>

    <!-- HEADER -->
    <div class="header">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-auto">
                    <img src="img/logo.png" alt="Logo" width="60">
                </div>
                <div class="col text-end">
                    <a href="#home" class="menu active">Home</a>
                    <a href="#services" class="menu">Services</a>
                    <a href="#about" class="menu">About</a>
                    <a href="#contact" class="menu">Contact</a>
                </div>
            </div>
        </div>
    </div>

    <!-- HOME SECTION -->
    <div id="home" class="hero section">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-12 col-md-6">
                    <p class="section-label mb-2">WELCOME TO MY PORTFOLIO</p>
                    <h1>Hello, I'm Antonius Rama</h1>
                    <h3>Mahasiswa Politeknik ATMI Surakarta</h3>
                    <p class="mt-3">Saya sedang belajar membuat website dengan HTML, CSS, dan PHP MySQL.</p>
                    <a href="#contact" class="btn btn-primary mt-2">Contact Me</a>
                </div>
                <div class="col-12 col-md-6 text-center mt-4 mt-md-0">
                    <img src="img/rocket.png" alt="Rocket" class="img-fluid">
                </div>
            </div>
        </div>
    </div>

    <!-- 1. SERVICES SECTION (DINAMIS DARI DATABASE) -->
    <div class="serviss">
        <div id="services" class="container section">
            <div class="text-center text-white mb-5">
                <span class="section-label">SERVICES</span>
                <h2>Services</h2>
                <p>Beberapa hal yang saya kerjakan.</p>
            </div>

            <div class="row g-4">
                <?php
                // Ambil data services dari database
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

    <!-- 2. ABOUT & GRAFIK (DINAMIS DARI DATABASE) -->
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

                <!-- GRAFIK DINAMIS REALTIME -->
                <div class="chart-box mt-5">
                    <h3 class="text-center mb-4">Tingkat Kemampuan</h3>
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
    </div>

    <!-- 3. CONTACT SECTION (SIMPAN KE DATABASE) -->
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
                    <!-- NOTIFIKASI SUKSES / GAGAL -->
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

                    <form action="home.php" method="POST">
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

    <!-- FOOTER -->
    <div class="footer text-center">
        <p>&copy; <?php echo date('Y'); ?> Antonius Rama Moriska. All rights reserved.</p>
    </div>

    <!-- JAVASCRIPT & CHARTJS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script>
    // 1. PEMBERSIH URL (Mencegah notifikasi muncul terus saat F5)
    if (window.history.replaceState) {
        const url = new URL(window.location.href);
        if (url.searchParams.has('status')) {
            url.searchParams.delete('status');
            window.history.replaceState(null, '', url.pathname + url.hash);
        }
    }

    // 2. SMOOTH SCROLL & ACTIVE MENU HIGHLIGHT
    // 2. SMOOTH SCROLL & ACTIVE MENU HIGHLIGHT
    const menuLinks = document.querySelectorAll(".menu");

    menuLinks.forEach(item => {
        item.addEventListener("click", event => {
            event.preventDefault();
            const id = item.getAttribute("href");
            const targetElement = document.querySelector(id);
            if (targetElement) {
                targetElement.scrollIntoView({ behavior: "smooth" });
            }
        });
    });

// PERBAIKAN: Deteksi section responsif naik & turun, termasuk bagian paling bawah
const sectionIds = ["home", "services", "about", "contact"];
    
    function updateActiveNav() {
        let currentSection = "";
        const scrollPosition = window.scrollY + 200; // Offset deteksi layar

        // 1. Cek apakah posisi scroll sudah paling bawah (untuk bagian Contact)
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
            currentSection = "contact";
        } else {
            // 2. Jika belum di paling bawah, hitung posisi section seperti biasa
            sectionIds.forEach(id => {
                const section = document.getElementById(id);
                if (section) {
                    const parent = section.closest('.hero, .serviss, .aboutbackground, .kontak') || section;
                    const sectionTop = parent.offsetTop;
                    const sectionHeight = parent.offsetHeight;

                    if (scrollPosition >= sectionTop && scrollPosition < sectionTop + sectionHeight) {
                        currentSection = id;
                    }
                }
            });
        }

        // Update class active pada navbar
        menuLinks.forEach(link => {
            link.classList.remove("active");
            if (link.getAttribute("href") === "#" + currentSection) {
                link.classList.add("active");
            }
        });
    }

    // Jalankan saat di-scroll dan saat halaman dimuat
    window.addEventListener("scroll", updateActiveNav);
    window.addEventListener("load", updateActiveNav);

    // 3. GRAFIK CHARTJS
    const ctx = document.getElementById("myChart");
    new Chart(ctx, {
        type: "bar",
        data: {
            labels: <?php echo json_encode($chart_labels); ?>,
            datasets: [{
                label: "Tingkat Kemampuan (%)",
                data: <?php echo json_encode($chart_data); ?>,
                backgroundColor: [
                    'rgba(59, 130, 246, 0.85)',
                    'rgba(147, 51, 234, 0.85)',
                    'rgba(16, 185, 129, 0.85)'
                ],
                borderColor: ['#60a5fa', '#c084fc', '#34d399'],
                borderWidth: 2,
                borderRadius: 8
            }]
        },
        options: {
            responsive: true,
            plugins: {
                legend: { labels: { color: '#f8fafc' } }
            },
            scales: {
                x: {
                    ticks: { color: '#e2e8f0' },
                    grid: { color: 'rgba(255, 255, 255, 0.2)' }
                },
                y: {
                    beginAtZero: true,
                    max: 100,
                    ticks: { color: '#e2e8f0' },
                    grid: { color: 'rgba(255, 255, 255, 0.2)' }
                }
            }
        }
    });
</script>
</body>
</html>