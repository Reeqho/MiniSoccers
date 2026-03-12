<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
    <title>MiniSoccer - Booking Lapangan Futsal</title>
</head>
<body>
    <nav class="navbar">
        <div class="nav-container">
            <a href="/" class="nav-logo">⚽ MiniSoccer</a>
            <ul class="nav-links">
                <li><a href="/" class="active">Home</a></li>
                <li><a href="/fields">Lapangan</a></li>
                <li><a href="/bookings">Booking</a></li>
            </ul>
        </div>
    </nav>
    <section class="hero">
        <div class="hero-overlay"></div>
        <div class="hero-content">
            <h1>Booking Lapangan <br><span>Mudah & Cepat</span></h1>
            <p>Temukan lapangan terbaik dan pesan langsung sekarang. Nikmati permainan bersama teman-teman!</p>
            <div class="hero-buttons">
                <a href="/fields" class="btn btn-primary">Lihat Lapangan</a>
                <a href="/bookings/create" class="btn btn-outline">Booking Sekarang</a>
            </div>
        </div>
    </section>
    <section class="features">
        <div class="container">
            <h2 class="section-title">Kualitas yang Kami Tawarkan</h2>
            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">📅</div>
                    <h3>Booking Online</h3>
                    <p>Pesan lapangan kapan saja dan di mana saja tanpa perlu datang langsung.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">⚡</div>
                    <h3>Konfirmasi Cepat</h3>
                    <p>Dapatkan konfirmasi booking secara instan setelah melakukan pembayaran.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">🏟️</div>
                    <h3>Lapangan Berkualitas</h3>
                    <p>Lapangan terawat dengan rumput sintetis dan pencahayaan optimal.</p>
                </div>
                <div class="feature-card">
                    <div class="feature-icon">💳</div>
                    <h3>Pembayaran Mudah</h3>
                    <p>Berbagai metode pembayaran tersedia untuk kemudahan transaksi Anda.</p>
                </div>
            </div>
        </div>
    </section>
    <section class="how-to">
        <div class="container">
            <h2 class="section-title">Cara Booking</h2>
            <div class="steps">
                <div class="step">
                    <div class="step-number">1</div>
                    <h4>Pilih Lapangan</h4>
                    <p>Pilih lapangan yang tersedia sesuai kebutuhan Anda</p>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <h4>Tentukan Jadwal</h4>
                    <p>Pilih tanggal dan jam bermain yang diinginkan</p>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <h4>Lakukan Pembayaran</h4>
                    <p>Selesaikan pembayaran untuk konfirmasi booking</p>
                </div>
                <div class="step">
                    <div class="step-number">4</div>
                    <h4>Bermain!</h4>
                    <p>Datang ke lapangan dan nikmati permainan</p>
                </div>
            </div>
        </div>
    </section>
    <footer class="footer">
        <div class="container">
            <div class="footer-grid">
                <div class="footer-brand">
                    <h3>⚽ MiniSoccer</h3>
                    <p>Platform booking lapangan futsal terpercaya untuk Anda dan tim.</p>
                </div>
                <div class="footer-links">
                    <h4>Menu</h4>
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/fields">Lapangan</a></li>
                        <li><a href="/bookings">Booking</a></li>
                    </ul>
                </div>
                <div class="footer-contact">
                    <h4>Kontak</h4>
                    <p>📞 0813-3328-7896</p>
                    <p>✉️ ambasoccer@gmail.com</p>
                </div>
            </div>
            <div class="footer-bottom">
                <p>&copy; {{ date('Y') }} MiniSoccer. All rights reserved.</p>
            </div>
        </div>
    </footer>

</body>
</html>
