let bgMusic = null;
        let isMusicPlaying = false;
        let musicLoaded = false;

        // เริ่มต้นระบบเสียง
        function initAudio() {
            bgMusic = document.getElementById('bgMusic');

            // ตั้งค่าไฟล์เสียง
            const source = document.createElement('source');
            source.src = 'music.mp3';
            source.type = 'audio/mpeg';
            bgMusic.appendChild(source);

            // ตั้งค่าระดับเสียงเริ่มต้น
            bgMusic.volume = 0.05;

            // โหลดไฟล์เสียง
            bgMusic.load();
            musicLoaded = true;

            console.log('✅ ระบบเสียงพร้อมทำงาน');
        }

        // ฟังก์ชันเล่นเพลง
        function playMusic() {
            if (!bgMusic) {
                initAudio();
            }

            bgMusic.play().then(() => {
                isMusicPlaying = true;
                updateMusicButton();
                console.log('▶️ กำลังเล่นเพลง');
            }).catch(err => {
                console.log('⚠️ ไม่สามารถเล่นเพลงได้: ', err);
                // ลองใหม่อีกครั้งหลังจากผู้ใช้คลิก
                setTimeout(() => {
                    bgMusic.play().then(() => {
                        isMusicPlaying = true;
                        updateMusicButton();
                    }).catch(e => console.log('ยังไม่สามารถเล่นได้'));
                }, 100);
            });
        }

        // ฟังก์ชันหยุดเพลง
        function pauseMusic() {
            if (bgMusic) {
                bgMusic.pause();
                isMusicPlaying = false;
                updateMusicButton();
                console.log('⏸️ หยุดเล่นเพลง');
            }
        }

        // สลับเล่น/หยุด
        function toggleMusic() {
            if (!musicLoaded) {
                initAudio();
            }

            if (isMusicPlaying) {
                pauseMusic();
            } else {
                playMusic();
            }
        }

        // ปรับระดับเสียง
        function changeVolume(value) {
            const vol = value / 100;
            if (bgMusic) {
                bgMusic.volume = vol;
            }
            document.getElementById('volumeValue').textContent = value + '%';
            console.log('🔊 ระดับเสียง: ' + value + '%');
        }

        // อัปเดตปุ่มควบคุม
        function updateMusicButton() {
            const btn = document.getElementById('musicToggle');
            if (isMusicPlaying) {
                btn.innerHTML = '<i class="fas fa-pause"></i>';
            } else {
                btn.innerHTML = '<i class="fas fa-play"></i>';
            }
        }

        // เริ่มต้นระบบเสียงเมื่อโหลดหน้าเว็บ
        window.addEventListener('DOMContentLoaded', function () {
            initAudio();
        });

        // คลิกที่ใดก็ได้เพื่อเริ่มเล่นเพลง (แก้ปัญหา autoplay)
        document.body.addEventListener('click', function () {
            if (!isMusicPlaying && musicLoaded) {
                playMusic();
            }
        }, { once: false });

        // ==========================================
        // ระบบคำนวณอายุและนับถอยหลัง
        // ==========================================
        const BIRTHDAY = { day: 2, month: 7, year: 2550 };

        function calculateAge() {
            const now = new Date();
            const birthDate = new Date(BIRTHDAY.year - 543, BIRTHDAY.month - 1, BIRTHDAY.day);
            const today = new Date(now.getFullYear(), now.getMonth(), now.getDate());

            let age = today.getFullYear() - birthDate.getFullYear();
            const monthDiff = today.getMonth() - birthDate.getMonth();

            if (monthDiff < 0 || (monthDiff === 0 && today.getDate() < birthDate.getDate())) {
                age--;
            }

            let nextBirthday = new Date(now.getFullYear(), BIRTHDAY.month - 1, BIRTHDAY.day);
            if (nextBirthday < now) {
                nextBirthday = new Date(now.getFullYear() + 1, BIRTHDAY.month - 1, BIRTHDAY.day);
            }

            const diffTime = nextBirthday - now;
            const diffDays = Math.floor(diffTime / (1000 * 60 * 60 * 24));
            const diffHours = Math.floor((diffTime % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
            const diffMinutes = Math.floor((diffTime % (1000 * 60 * 60)) / (1000 * 60));
            const diffSeconds = Math.floor((diffTime % (1000 * 60)) / 1000);

            return { age, diffDays, diffHours, diffMinutes, diffSeconds, nextBirthday };
        }

        function isBirthdayToday() {
            const now = new Date();
            return now.getDate() === BIRTHDAY.day && (now.getMonth() + 1) === BIRTHDAY.month;
        }

        let partyActive = false;

        function updateDisplay() {
            const { age, diffDays, diffHours, diffMinutes, diffSeconds } = calculateAge();

            document.getElementById('currentAge').textContent = age;
            const personalAgeEl = document.getElementById('personalAge');
            if (personalAgeEl) personalAgeEl.textContent = age;

            document.getElementById('days').textContent = String(diffDays).padStart(2, '0');
            document.getElementById('hours').textContent = String(diffHours).padStart(2, '0');
            document.getElementById('minutes').textContent = String(diffMinutes).padStart(2, '0');
            document.getElementById('seconds').textContent = String(diffSeconds).padStart(2, '0');

            const statusEl = document.getElementById('birthdayStatus');
            const birthday = isBirthdayToday();

            if (birthday) {
                statusEl.innerHTML = '🎂 วันนี้เป็นวันเกิด! สุขสันต์วันเกิด! 🎉';
                if (!partyActive) {
                    startParty(age);
                    partyActive = true;
                }
            } else {
                statusEl.innerHTML = `🎈 อีก ${diffDays} วัน ${diffHours} ชั่วโมง ก็จะถึงวันเกิดปีที่ ${age + 1} แล้ว!`;
                if (partyActive) {
                    stopParty();
                    partyActive = false;
                }
            }
        }

        function startParty(age) {
            document.body.classList.add('party-active');
            document.getElementById('newAge').textContent = age;

            const overlay = document.getElementById('partyOverlay');
            overlay.innerHTML = '';
            for (let i = 0; i < 50; i++) {
                const confetti = document.createElement('div');
                confetti.className = 'confetti';
                confetti.style.left = Math.random() * 100 + '%';
                confetti.style.animationDelay = Math.random() * 2 + 's';
                confetti.style.background = `hsl(${Math.random() * 360}, 80%, 60%)`;
                overlay.appendChild(confetti);
            }
        }

        function stopParty() {
            document.body.classList.remove('party-active');
            document.getElementById('partyOverlay').innerHTML = '';
        }

        // ==========================================
        // ฟังก์ชันอื่นๆ
        // ==========================================
        function openLightbox(src) {
            document.getElementById('lightboxImg').src = src;
            document.getElementById('lightbox').classList.add('active');
        }

        function closeLightbox() {
            document.getElementById('lightbox').classList.remove('active');
        }

        function confirmNavigation(url) {
            const btn = event.target.closest('.map-btn');
            const loc = btn ? btn.getAttribute('data-location') : 'สถานที่';
            if (confirm(`🔍 ค้นหาข้อมูล "${loc}" บน Google Maps?`)) {
                window.open(url, '_blank');
            }
        }

        function openGmail() {
            window.open('https://mail.google.com/mail/?view=cm&fs=1&to=first172550@gmail.com&su=ติดต่อจาก Portfolio', '_blank');
        }

        // แสดง/ซ่อนเนื้อหา
        const showInfoBtn = document.getElementById('showInfoBtn');
        const hiddenContent = document.getElementById('hiddenContent');

        showInfoBtn.addEventListener('click', () => {
            hiddenContent.classList.toggle('show');
            if (hiddenContent.classList.contains('show')) {
                showInfoBtn.innerHTML = '<i class="fas fa-times-circle"></i> ปิดข้อมูล';
            } else {
                showInfoBtn.innerHTML = '<i class="fas fa-user-circle"></i> ข้อมูลส่วนตัว';
            }
        });

        // อัปเดตทุกวินาที
        updateDisplay();
        setInterval(updateDisplay, 1000);

        // กด ESC เพื่อปิด lightbox
        document.addEventListener('keydown', (e) => {
            if (e.key === 'Escape') {
                closeLightbox();
            }
        });