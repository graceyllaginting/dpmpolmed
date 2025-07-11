<h2>Halo, {{ $aspirasi->nama_pengirim }}!</h2>

<p>Terima kasih telah menyampaikan aspirasi kepada DPM Politeknik Negeri Medan.</p>

<p>Berikut adalah tanggapan dari kami:</p>

<blockquote style="border-left: 4px solid #ccc; padding-left: 10px;">
    {{ $aspirasi->tanggapan }}
</blockquote>

<p>Jika Anda ingin membalas, silakan kunjungi halaman berikut:</p>

<p>
    <a href="{{ route('aspiration-detail', $aspirasi->kode_aspirasi) }}">
        Lihat Detail Aspirasi Anda
    </a>
</p>

<p>Hormat kami,<br>DPM Polmed</p>
