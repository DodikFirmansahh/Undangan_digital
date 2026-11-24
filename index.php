
<?php
require_once __DIR__ . '/data.php';

function e($value) {
    return htmlspecialchars(
        (string) $value,
        ENT_QUOTES,
        'UTF-8'
    );
}

function formatTanggal($date) {
    $timestamp = strtotime($date);

    if ($timestamp === false) {
        return $date;
    }

    return date('d-m-Y', $timestamp);
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Undangan Pernikahan | NikahKita</title>
    <meta name="description" content="Undangan pernikahan digital Adat Nusantara.">

    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cormorant+Garamond:wght@400;500;600;700&family=Poppins:wght@300;400;500;600&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="style.css">
</head>
<body>

    <!-- TOMBOL MUSIK -->
    <button id="musicToggle" class="music-button" aria-label="Putar atau hentikan musik">
        ♫
    </button>


        <!-- COVER UNDANGAN -->
        <section class="cover" id="cover">

            <!-- LAYER ANIMASI BACKGROUND -->
            <div class="cover-scene" aria-hidden="true">

                <div class="cover-layer layer-garden"></div>

                <div class="cover-layer layer-light"></div>

                <div class="cover-layer layer-batik"></div>

                <div class="cover-layer layer-foliage"></div>



            </div>

            <!-- KONTEN UTAMA COVER -->
            <div class="cover-content">

                <p class="eyebrow">UNDANGAN PERNIKAHAN</p>

                <div class="ornament">❋</div>

                <p class="cover-intro">The Wedding Of</p>

                <h1>
                    <?= e($wedding['groom_nickname']) ?>
                    <span>&amp;</span>
                    <?= e($wedding['bride_nickname']) ?>
                </h1>

                <div class="gold-line"></div>

                <p class="cover-date">Minggu, 20 Desember 2026</p>

                <p class="guest-label">Kepada Yth.</p>
                <p class="guest-name">Bapak/Ibu/Saudara/i</p>

                <button id="openInvitation" class="primary-button">
                    <span>✉</span> Buka Undangan
                </button>

                <p class="cover-note">
                    Mohon doa restu untuk kedua mempelai
                </p>

            </div>

            <!-- TUMBUHAN DEKORATIF COVER -->
            <div class="wind-plants" aria-hidden="true">
                <img
                    src="assets/images/tumbuhan-kiri.png"
                    class="wind-plant plant-left"
                    alt=""
                >

                <img
                    src="assets/images/tumbuhan-kanan.png"
                    class="wind-plant plant-right"
                    alt=""
                >
            </div>

        </section>
        <!-- AKHIR COVER UNDANGAN -->

        
        <!-- SLIDE KEDUA: SURAH AR-RUM AYAT 21 -->
        <section id="verse-scene" class="verse-scene hidden">

            <div class="verse-panel">

                <p class="verse-label">وَمِنْ آيَاتِهِ</p>

                <h2 class="verse-heading">Surah Ar-Rum</h2>
                <p class="verse-number">Ayat 21</p>

                <div class="verse-divider">
                    <span>✦</span>
                </div>

                <p class="verse-arabic" lang="ar" dir="rtl">
                    وَمِنْ آيَاتِهِ أَنْ خَلَقَ لَكُم مِّنْ
                    أَنْفُسِكُمْ أَزْوَاجًا لِّتَسْكُنُوا
                    إِلَيْهَا وَجَعَلَ بَيْنَكُم مَّوَدَّةً
                    وَرَحْمَةً ۚ إِنَّ فِي ذَٰلِكَ لَآيَاتٍ
                    لِّقَوْمٍ يَتَفَكَّرُونَ
                </p>

                <p class="verse-translation">
                    “Dan di antara tanda-tanda (kebesaran)-Nya
                    ialah Dia menciptakan pasangan-pasangan
                    untukmu dari jenismu sendiri, agar kamu
                    cenderung dan merasa tenteram kepadanya,
                    dan Dia menjadikan di antaramu rasa kasih
                    dan sayang. Sungguh, pada yang demikian itu
                    benar-benar terdapat tanda-tanda
                    (kebesaran Allah) bagi kaum yang berpikir.”
                </p>

                <p class="verse-source">
                    QS. Ar-Rum · 21
                </p>

            </div>
        </section>



    <!-- ISI UNDANGAN -->
    <main id="invitation" class="invitation hidden">

<!-- PEMBUKA -->
<section class="section hero-section">

    <div class="hero-frame">

        <p class="eyebrow">Assalamualaikum Wr.Wb.</p>
        <p class="section-intro">
            Dengan memohon rahmat dan ridho Allah SWT,
            kami bermaksud menyelenggarakan pernikahan putra-putri kami.
        </p>
        <div class="couple-grid">
            <article class="couple-card">
                <img
                    class="couple-photo"
                    src="<?= e($wedding['groom_photo']) ?>"
                    alt="Foto <?= e($wedding['groom_name']) ?>"
                    loading="lazy"
                    decoding="async"
                >

                <h3><?= e($wedding['groom_name']) ?></h3>
                <p>Putra dari</p>
                <p>
                    <?= e($wedding['groom_father']) ?>
                    &amp;
                    <?= e($wedding['groom_mother']) ?>
                </p>
            </article>
            <span class="couple-ampersand">&amp;</span>
            <article class="couple-card">
                <img
                    class="couple-photo"
                    src="<?= e($wedding['bride_photo']) ?>"
                    alt="Foto <?= e($wedding['bride_name']) ?>"
                    loading="lazy"
                    decoding="async"
                >

                <h3><?= e($wedding['bride_name']) ?></h3>
                <p>Putri dari</p>
                <p>
                    <?= e($wedding['bride_father']) ?>
                    &amp;
                    <?= e($wedding['bride_mother']) ?>
                </p>
            </article>

        </div>

    </div>

</section>


        <!-- COUNTDOWN -->
        <div class="story-background schedule-background">
        <section class="section countdown-section">
            <p class="eyebrow">MENUJU HARI BAHAGIA</p>
            <h2>Save The Date</h2>

            <div class="countdown" id="countdown">
                <div><strong id="days">00</strong><span>Hari</span></div>
                <div><strong id="hours">00</strong><span>Jam</span></div>
                <div><strong id="minutes">00</strong><span>Menit</span></div>
                <div><strong id="seconds">00</strong><span>Detik</span></div>
            </div>
        </section>

        <!-- DETAIL ACARA -->
        <section class="section event-section">
            <article class="event-card">
                <div class="ornament">
                    <img src="assets/images/ornament-gold.png"
                        alt="Ornamen Gunungan Jawa">
                </div>
                <h3>Akad Nikah</h3>
                <p>Minggu, 20 Desember 2026</p>
                <p>08.00 WIB – selesai</p>
                <div class="gold-line"></div>
                <p>Gedung Serbaguna Nusantara</p>
                <p>Jakarta, Indonesia</p>
            </article>
             <a class="primary-button link-button"
               href="https://maps.google.com/?q=Jakarta"
               target="_blank" rel="noopener noreferrer">
                Lihat Lokasi
            </a>

            <article class="event-card">
                <div class="ornament">❋</div>
                <h3>Resepsi</h3>
                <p>Minggu, 20 Desember 2026</p>
                <p>11.00–14.00 WIB</p>
                <div class="gold-line"></div>
                <p>Gedung Serbaguna Nusantara</p>
                <p>Jakarta, Indonesia</p>
            </article>

            <a class="primary-button link-button"
               href="https://maps.google.com/?q=Jakarta"
               target="_blank" rel="noopener noreferrer">
                Lihat Lokasi
            </a>
        </section>
        </div>

        <!-- GALERI -->
        <section class="section gallery-section">
            <p class="eyebrow">MOMEN KAMI</p>
            <h2>Galeri Foto</h2>

            
            <div class="gallery-grid">

                <img
                    class="gallery-photo"
                    src="assets/images/img1.jpg"
                    alt="Momen kebersamaan pengantin 1"
                    loading="lazy"
                    decoding="async"
                >

                <img
                    class="gallery-photo"
                    src="assets/images/img2.jpg"
                    alt="Momen kebersamaan pengantin 2"
                    loading="lazy"
                    decoding="async"
                >

                <img
                    class="gallery-photo"
                    src="assets/images/img3.jpg"
                    alt="Momen kebersamaan pengantin 3"
                    loading="lazy"
                    decoding="async"
                >

                <img
                    class="gallery-photo"
                    src="assets/images/img4.jpg"
                    alt="Momen kebersamaan pengantin 4"
                    loading="lazy"
                    decoding="async"
                >

            </div>

        </section>

        
        <!-- BACKGROUND 5: OUR LOVE STORY -->
        <section class="story-background love-story-section">

            <p class="eyebrow">PERJALANAN CINTA KAMI</p>
            <h2>Our Love Story</h2>

            <div class="love-timeline">

                <article class="love-moment">
                    <span class="love-number">01</span>
                    <h3>First Meet</h3>
                    <p>Awal pertemuan yang menjadi cerita indah kami.</p>
                </article>

                <article class="love-moment">
                    <span class="love-number">02</span>
                    <h3>Relationship</h3>
                    <p>Memulai perjalanan bersama, saling mengenal dan mendukung.</p>
                </article>

                <article class="love-moment">
                    <span class="love-number">03</span>
                    <h3>Engagement</h3>
                    <p>Memantapkan hati untuk melangkah ke jenjang berikutnya.</p>
                </article>

                <article class="love-moment">
                    <span class="love-number">04</span>
                    <h3>Married</h3>
                    <p>Memulai perjalanan baru sebagai pasangan seumur hidup.</p>
                </article>

            </div>

        </section>


        <!-- BACKGROUND 6: RSVP DAN KIRIM UCAPAN -->
        <div class="story-background wishes-background">
        <section class="section rsvp-section">
            <p class="eyebrow">KONFIRMASI KEHADIRAN</p>
            <h2>RSVP</h2>

            <p class="section-intro">
                Mohon konfirmasi kehadiran Anda melalui formulir berikut.
            </p>

            <form id="rsvpForm">
                <label for="guestName">Nama lengkap</label>
                <input id="guestName" name="guestName"
                       type="text" placeholder="Masukkan nama Anda" required>

                <label for="attendance">Konfirmasi kehadiran</label>
                <select id="attendance" name="attendance" required>
                    <option value="">Pilih konfirmasi</option>
                    <option value="hadir">Hadir</option>
                    <option value="tidak_hadir">Tidak dapat hadir</option>
                </select>

                <label for="guestCount">Jumlah tamu</label>
                <select id="guestCount" name="guestCount">
                    <option value="1">1 orang</option>
                    <option value="2">2 orang</option>
                </select>

                <button type="submit" class="primary-button">
                    Kirim Konfirmasi
                </button>

                <p id="rsvpMessage" class="form-message" aria-live="polite"></p>
            </form>
        </section>

        <!-- BUKU TAMU -->
        <section class="section guestbook-section">
            <p class="eyebrow">UCAPAN & DOA</p>
            <h2>Buku Tamu</h2>

            <form id="guestbookForm">
                <label for="messageName">Nama Anda</label>
                <input id="messageName" name="messageName"
                       type="text" placeholder="Nama lengkap" required>

                <label for="guestMessage">Ucapan dan doa</label>
                <textarea id="guestMessage" name="guestMessage"
                          rows="4" placeholder="Tuliskan ucapan terbaik..." required></textarea>

                <button type="submit" class="primary-button">
                    Kirim Ucapan
                </button>
            </form>

            <div id="guestbookList" class="guestbook-list">
                <p class="empty-message">
                    Ucapan dan doa untuk kedua mempelai akan ditampilkan di sini.
                </p>
            </div>
        </section>
        </div>

        
        <!-- BACKGROUND 7: TANDA KASIH -->
        <section class="story-background gift-section">

            <p class="eyebrow">UNGKAPAN TANDA KASIH</p>
            <h2>Tanda Kasih</h2>

            <article class="gift-card">
                <h3>BCA</h3>
                <p>Nomor rekening</p>
                <p class="gift-number" id="bcaNumber">ISI_NOMOR_BCA</p>
                <p class="gift-owner">Nama pemilik rekening</p>
                <button
                    type="button"
                    class="primary-button"
                    data-copy-target="bcaNumber">
                    Salin Rekening
                </button>
            </article>

            <article class="gift-card">
                <h3>DANA</h3>
                <p>Nomor DANA</p>
                <p class="gift-number" id="danaNumber">ISI_NOMOR_DANA</p>
                <p class="gift-owner">Nama pemilik DANA</p>
                <button
                    type="button"
                    class="primary-button"
                    data-copy-target="danaNumber">
                    Salin Nomor DANA
                </button>
            </article>

            <article class="gift-card">
                <h3>Kirim Kado</h3>
                <p>Alamat penerima kado</p>
                <p id="giftAddress">ISI_ALAMAT_PENERIMA</p>
                <button
                    type="button"
                    class="primary-button"
                    data-copy-target="giftAddress">
                    Salin Alamat
                </button>
            </article>

        </section>

        <!-- PENUTUP -->
        <section class="section closing-section">
            <div class="ornament">❋</div>

            <p class="section-intro">
                Merupakan suatu kehormatan dan kebahagiaan bagi kami
                apabila Bapak/Ibu/Saudara/i berkenan hadir dan memberikan doa restu.
            </p>

            <h2>Terima Kasih</h2>
            <p>Aditya & Kirana</p>
            
            <p class="footer-brand">
                Powered by
                <a href="https://www.instagram.com/USERNAME_NIKAHKITA/"
                target="_blank"
                rel="noopener noreferrer"
                aria-label="Instagram NikahKita">
                    NikahKita
                </a>
            </p>

        </section>

    </main>

    <!-- GANTI DENGAN FILE MUSIK MILIK SENDIRI NANTI -->
    <audio id="weddingMusic" loop preload="none">
        <source src="assets/music.mp3" type="audio/mpeg">
    </audio>

    <script src="script.js"></script>
</body>
</html>
