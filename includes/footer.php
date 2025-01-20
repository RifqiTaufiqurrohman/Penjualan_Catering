<footer class="footer py-5 mt-4 bg-gradient-dark position-relative overflow-hidden">
    <div class="container position-relative z-index-1">
        <div class="row">
            <div class="col-lg-6 me-auto mb-lg-0 mb-4 text-lg-start text-center">
                <h6 class="text-white font-weight-bolder text-uppercase mb-lg-4 mb-3">Ardina Catering</h6>
                <ul class="nav flex-row ms-n3 align-items-center mb-4 mt-sm-0">
                    <li class="nav-item">
                        <a class="nav-link text-white opacity-8" href="index.php">
                            Home
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white opacity-8" href="category.php">
                            Collections
                        </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link text-white opacity-8" href="#">
                            Gallery
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white opacity-8" href="#">
                            About
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link text-white opacity-8" href="#">
                            Contact
                        </a>
                    </li>
                </ul>
                <p class="text-sm text-white opacity-8 mb-0">
                    Copyright © <script>
                        document.write(new Date().getFullYear())
                    </script> Material Design by Creative Tim.
                </p>
            </div>
            <div class="col-lg-6 ms-auto text-lg-end text-center">
                <p class="mb-5 text-lg text-white font-weight-bold">
                    Tingkatkan Moment Istimewa Anda dengan Keahlian Kuliner Terbaik! Pesan Sekarang di Ardina Catering
                </p>
                <a href="javascript:;" target="_blank" class="text-white me-xl-4 me-4 opacity-8">
                    <span class="fab fa-instagram"></span>
                </a>
                <a href="javascript:;" target="_blank" class="text-white me-xl-4 me-4 opacity-8">
                    <span class="fab fa-tiktok"></span>
                </a>
                <a href="javascript:;" target="_blank" class="text-white opacity-8">
                    <span class="fab fa-facebook"></span>
                </a>
            </div>
        </div>
    </div>
</footer>
<!-- -------- END FOOTER 5 w/ DARK BACKGROUND ------- -->
</main>
<!-- Bootstrap JS -->
<script src="assets/js/bootstrap.bundle.min.js"></script>
<script src="assets/js/plugins/perfect-scrollbar.min.js"></script>
<script src="assets/js/plugins/smooth-scrollbar.min.js"></script>
<script src="assets/js/plugins/choices.min.js"></script>
<script src="assets/js/jquery-3.6.4.min.js"></script>
<script src='https://kit.fontawesome.com/a076d05399.js' crossorigin='anonymous'></script>
<script>
    // Fungsi untuk mengupdate hitungan mundur
    function updateCountdown(hours, minutes, seconds) {
        var countdownText = hours + " Jam " + minutes + " Menit " + seconds + " Detik";
        document.getElementById("countdown-text").innerHTML = countdownText;
    }
    // Fungsi untuk menghitung dan memperbarui hitungan mundur setiap detik
    function countdownTimer(deadlineTime) {
        setInterval(function() {
            var now = Math.floor(new Date().getTime() / 1000);
            var timeDiff = deadlineTime - now;

            var hours = Math.floor(timeDiff / 3600);
            var minutes = Math.floor((timeDiff % 3600) / 60);
            var seconds = timeDiff % 60;

            updateCountdown(hours, minutes, seconds);
        }, 1000); // Update setiap detik (1000 milidetik)
    }
    // Mendapatkan waktu batas pembayaran dari PHP
    var deadlineTime =
        <?php echo $deadlineTime; ?>; // PHP menambahkan timestamp ke dalam script JavaScript
    // Memanggil fungsi countdownTimer dengan waktu batas pembayaran sebagai parameter
    countdownTimer(deadlineTime);
</script>

<script>
    function pilihBank() {
        var id = $('#rekening_id').val();
        $.ajax({
            url: "controller/dataRekening.php",
            method: "POST",
            data: {
                id: id
            },
            dataType: "json",
            success: function(data) {
                $('#nama_bank').val(data.nama_bank);
                $('#no_rek').val(data.no_rekening);
                $('#nama_rek').val(data.nama_rekening);
            }
        })
    }
</script>

<!-- Owl Carousel JS -->
<script src="assets/js/plugins/owl.carousel.min.js"></script>
<script>
    $('.owl-carousel').owlCarousel({
        loop: true,
        margin: 10,
        nav: true,
        responsive: {
            0: {
                items: 1
            },
            600: {
                items: 3
            },
            1000: {
                items: 5
            }
        }
    })
</script>
<!-- Custom JS -->
<script src="assets/js/custom.js"></script>
<!-- Alertify -->
<script src="//cdn.jsdelivr.net/npm/alertifyjs@1.13.1/build/alertify.min.js"></script>

<script>
    alertify.set('notifier', 'position', 'top-center');
    <?php
    if (isset($_SESSION['message'])) {
    ?>
        alertify.success("<?= $_SESSION['message'] ?>");
    <?php
        unset($_SESSION['message']);
    }
    ?>
</script>

<script>
    // Fungsi untuk menghitung nilai secara bertahap
    function countTo(element, target, duration) {
        let count = 0;
        const increment = target / (duration / 15); // 15 is an arbitrary number for smoother animation
        const elementId = setInterval(() => {
            count += increment;
            element.textContent = Math.round(count);
            if (count >= target) {
                clearInterval(elementId);
                element.textContent = target;
            }
        }, 15);
    }

    // Fungsi untuk memulai animasi
    function startCountAnimation() {
        const statsSection = document.getElementById('count-stats');
        const countElements = statsSection.querySelectorAll('[countTo]');

        countElements.forEach(element => {
            const targetValue = parseFloat(element.getAttribute('countTo'));
            countTo(element, targetValue, 2000); // Durasi animasi dalam milidetik (misal: 2000 ms)
        });
    }

    // Memulai animasi saat halaman selesai dimuat
    document.addEventListener('DOMContentLoaded', startCountAnimation);
</script>
</body>

</html>