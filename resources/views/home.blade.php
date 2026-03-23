@extends('layouts.master')
@section('title', 'Home')
@section('content')
{{-- cek session role --}}
@if(auth()->check() && auth()->user()->role == 'admin' && session('role') === 'admin')
    <p>Welcome, Admin!</p>
@else
    <p>Welcome, Customer!</p>
@endif
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
@endsection
