
/* =========================================
   NIKAHKITA - ADAT NUSANTARA
   Interaksi template undangan digital
========================================= */

document.addEventListener("DOMContentLoaded", function () {


// =====================================
// 1. BUKA UNDANGAN
// =====================================

const openButton = document.getElementById("openInvitation");
const cover = document.getElementById("cover");
const invitation = document.getElementById("invitation");
const verseScene = document.getElementById("verse-scene");

if (openButton && cover && invitation) {

    let invitationOpened = false;

    openButton.addEventListener("click", function () {

        if (invitationOpened) return;

        invitationOpened = true;
        openButton.disabled = true;

        // Animasi cover menutup.
        cover.classList.add("leaves-closing");

        // Tunggu animasi cover selesai.
        window.setTimeout(function () {

            cover.classList.add("hidden");

            // Tampilkan Surah Ar-Rum.
            if (verseScene) {
                verseScene.classList.remove("hidden");

                requestAnimationFrame(function () {
                    verseScene.classList.add("active");
                });
            }

        }, 1200);
    });

    // Klik atau sentuh area Surah Ar-Rum
    // untuk masuk ke isi undangan.
    if (verseScene) {

        function enterInvitation(event) {

            if (invitationOpened !== true) return;
            if (verseScene.classList.contains("hidden")) return;

            // Cegah klik berulang.
            if (verseScene.dataset.transitioning === "true") return;

            verseScene.dataset.transitioning = "true";

            // Hilangkan halaman Surah Ar-Rum.
            verseScene.classList.remove("active");
            verseScene.classList.add("hidden");

            // Tampilkan isi undangan.
            invitation.classList.remove("hidden");
            initInvitationReveal();
            initInvitationParallax();
            invitation.classList.add("invitation-entering");

            updateCountdown();
            playMusic();

            window.setTimeout(function () {
                invitation.classList.remove("invitation-entering");
            }, 1200);
        }

        verseScene.addEventListener("click", enterInvitation);
    }
}

if (invitation.classList.contains("hidden")) {
    return;
}

function initInvitationReveal() {
    const invitation = document.getElementById("invitation");
    if (!invitation) return;

    const elements = invitation.querySelectorAll(
        ".section, .couple-card, .event-card, " +
        ".gallery-photo, .countdown, form, .footer-brand, " +
        ".love-moment, .gift-card"
    );

    if (!("IntersectionObserver" in window)) {
        elements.forEach(el => el.classList.add("is-visible"));
        return;
    }

    const observer = new IntersectionObserver(entries => {
        entries.forEach(entry => {
            if (entry.isIntersecting) {
                entry.target.classList.add("is-visible");
            } else {
                entry.target.classList.remove("is-visible");
            }
        });
    }, {
        threshold: 0.12
    });

    elements.forEach(el => {
        el.classList.add("reveal");
        observer.observe(el);
    });
}

initInvitationReveal();


/* =====================================
   6. BACKGROUND PARALLAX
===================================== */

function initInvitationParallax() {
    const invitation = document.getElementById("invitation");

    if (!invitation) return;

    const scenes = invitation.querySelectorAll(
        ".story-background, .section"
    );

    let ticking = false;

    function updateParallax() {
        const viewportHeight = window.innerHeight;

        scenes.forEach(scene => {
            const rect = scene.getBoundingClientRect();

            if (
                rect.bottom < -viewportHeight ||
                rect.top > viewportHeight * 2
            ) {
                return;
            }

            const offset =
                (viewportHeight / 2 - rect.top) * 0.06;

            const limitedOffset = Math.max(
                -28,
                Math.min(28, offset)
            );

            scene.style.setProperty(
                "--nk-parallax-y",
                `${limitedOffset}px`
            );
        });

        ticking = false;
    }

    function onScroll() {
        if (ticking) return;

        ticking = true;
        window.requestAnimationFrame(updateParallax);
    }

    window.addEventListener("scroll", onScroll, {
        passive: true
    });

    window.addEventListener("resize", onScroll, {
        passive: true
    });

    updateParallax();
}

initInvitationParallax();



    // =====================================
    // 2. COUNTDOWN PERNIKAHAN
    // =====================================

    // Format: tahun, bulan (0 = Januari), tanggal, jam, menit
    // Contoh ini menggunakan pukul 08.00 WIB.
    const weddingDate = new Date(2026, 11, 20, 8, 0, 0);

    function updateCountdown() {
        const now = new Date();
        let difference = weddingDate.getTime() - now.getTime();

        const daysEl = document.getElementById("days");
        const hoursEl = document.getElementById("hours");
        const minutesEl = document.getElementById("minutes");
        const secondsEl = document.getElementById("seconds");

        if (!daysEl || !hoursEl || !minutesEl || !secondsEl) {
            return;
        }

        if (difference <= 0) {
            daysEl.textContent = "00";
            hoursEl.textContent = "00";
            minutesEl.textContent = "00";
            secondsEl.textContent = "00";
            return;
        }

        const days = Math.floor(difference / (1000 * 60 * 60 * 24));
        difference %= 1000 * 60 * 60 * 24;

        const hours = Math.floor(difference / (1000 * 60 * 60));
        difference %= 1000 * 60 * 60;

        const minutes = Math.floor(difference / (1000 * 60));
        difference %= 1000 * 60;

        const seconds = Math.floor(difference / 1000);

        daysEl.textContent = String(days).padStart(2, "0");
        hoursEl.textContent = String(hours).padStart(2, "0");
        minutesEl.textContent = String(minutes).padStart(2, "0");
        secondsEl.textContent = String(seconds).padStart(2, "0");
    }

    updateCountdown();
    setInterval(updateCountdown, 1000);


    // =====================================
    // 3. MUSIK PLAY / PAUSE
    // =====================================

    const music = document.getElementById("weddingMusic");
    const musicToggle = document.getElementById("musicToggle");

    async function playMusic() {
        if (!music || !musicToggle) return;

        try {
            await music.play();
            musicToggle.textContent = "♫";
            musicToggle.setAttribute("aria-label", "Jeda musik");
            musicToggle.setAttribute("aria-pressed", "true");
        } catch (error) {
            // Browser bisa menolak pemutaran musik.
            // Pengguna tetap bisa menekan tombol musik.
            musicToggle.textContent = "♫";
            musicToggle.setAttribute("aria-label", "Putar musik");
            musicToggle.setAttribute("aria-pressed", "false");
        }
    }

    function pauseMusic() {
        if (!music || !musicToggle) return;

        music.pause();
        musicToggle.textContent = "♫";
        musicToggle.setAttribute("aria-label", "Putar musik");
        musicToggle.setAttribute("aria-pressed", "false");
    }

    if (musicToggle && music) {
        musicToggle.addEventListener("click", function () {
            if (music.paused) {
                playMusic();
            } else {
                pauseMusic();
            }
        });

        music.addEventListener("ended", function () {
            musicToggle.setAttribute("aria-pressed", "false");
        });
    }


    // =====================================
    // 4. FORM RSVP - DEMO
    // =====================================

    const rsvpForm = document.getElementById("rsvpForm");
    const rsvpMessage = document.getElementById("rsvpMessage");

    if (rsvpForm && rsvpMessage) {
        rsvpForm.addEventListener("submit", function (event) {
            event.preventDefault();

            if (!rsvpForm.reportValidity()) return;

            const guestName =
                document.getElementById("guestName").value.trim();

            const attendance =
                document.getElementById("attendance").value;

            const guestCount =
                document.getElementById("guestCount").value;

            if (!guestName || !attendance) return;

            const statusText = attendance === "hadir"
                ? "menyatakan akan hadir"
                : "menyatakan tidak dapat hadir";

            rsvpMessage.textContent =
                "Terima kasih, " + guestName +
                ". Konfirmasi Anda: " + statusText +
                ". Jumlah tamu: " + guestCount +
                " orang. Ini masih demo dan belum tersimpan ke database.";

            rsvpForm.reset();
        });
    }


    // =====================================
    // 5. BUKU TAMU - DEMO
    // =====================================

    const guestbookForm = document.getElementById("guestbookForm");
    const guestbookList = document.getElementById("guestbookList");

    if (guestbookForm && guestbookList) {
        guestbookForm.addEventListener("submit", function (event) {
            event.preventDefault();

            if (!guestbookForm.reportValidity()) return;

            const nameInput = document.getElementById("messageName");
            const messageInput = document.getElementById("guestMessage");

            const name = nameInput.value.trim();
            const message = messageInput.value.trim();

            if (!name || !message) return;

            // Hapus pesan kosong ketika ucapan pertama dikirim.
            const emptyMessage =
                guestbookList.querySelector(".empty-message");

            if (emptyMessage) {
                emptyMessage.remove();
            }

            // Buat elemen menggunakan textContent agar
            // teks pengguna tidak dijalankan sebagai HTML.
            const entry = document.createElement("article");
            entry.className = "guestbook-entry";

            const entryName = document.createElement("h3");
            entryName.textContent = name;

            const entryMessage = document.createElement("p");
            entryMessage.textContent = message;

            entry.appendChild(entryName);
            entry.appendChild(entryMessage);

            guestbookList.prepend(entry);

            guestbookForm.reset();
        });
    }

    
/* =====================================
   7. SALIN REKENING, DANA, DAN ALAMAT
===================================== */

document.addEventListener("click", async function (event) {
    const button = event.target.closest("[data-copy-target]");

    if (!button) return;

    const targetId = button.dataset.copyTarget;
    const target = document.getElementById(targetId);

    if (!target) return;

    const text = target.textContent.trim();

    if (!text || text.startsWith("ISI_")) {
        alert("Silakan lengkapi data terlebih dahulu.");
        return;
    }

    try {
        await navigator.clipboard.writeText(text);

        const originalText = button.textContent;
        button.textContent = "Berhasil disalin!";

        window.setTimeout(function () {
            button.textContent = originalText;
        }, 1800);
    } catch (error) {
        alert(
            "Tidak dapat menyalin otomatis. " +
            "Silakan salin teks secara manual."
        );
    }
});


});
