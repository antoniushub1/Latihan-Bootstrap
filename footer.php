<!-- FOOTER -->
<div class="footer text-center">
        <p>&copy; <?php echo date('Y'); ?> Antonius Rama Moriska. All rights reserved.</p>
    </div>

    <!-- JAVASCRIPT & CHARTJS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        if (window.history.replaceState) {
            const url = new URL(window.location.href);
            if (url.searchParams.has('status')) {
                url.searchParams.delete('status');
                window.history.replaceState(null, '', url.pathname + url.hash);
            }
        }

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

        const sectionIds = ["home", "services", "about", "contact"];
        function updateActiveNav() {
            let currentSection = "";
            const scrollPosition = window.scrollY + 200;

            if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight - 50) {
                currentSection = "contact";
            } else {
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

            menuLinks.forEach(link => {
                link.classList.remove("active");
                if (link.getAttribute("href") === "#" + currentSection) {
                    link.classList.add("active");
                }
            });
        }

        window.addEventListener("scroll", updateActiveNav);
        window.addEventListener("load", updateActiveNav);

        // Chart Init
        const ctx = document.getElementById("myChart");
        if (ctx) {
            new Chart(ctx, {
                type: "bar",
                data: {
                    labels: <?php echo json_encode($chart_labels ?? []); ?>,
                    datasets: [{
                        label: "Tingkat Kemampuan (%)",
                        data: <?php echo json_encode($chart_data ?? []); ?>,
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
        }
    </script>
</body>
</html>