const BIRTHDAY = {

    day: 2,
    month: 7,
    year: 2550

};

function calculateBirthday() {

    const now = new Date();

    const birthDate = new Date(
        BIRTHDAY.year - 543,
        BIRTHDAY.month - 1,
        BIRTHDAY.day
    );

    let age =
        now.getFullYear() -
        birthDate.getFullYear();

    const hasBirthdayThisYear =

        now.getMonth() > birthDate.getMonth()
        ||
        (
            now.getMonth() === birthDate.getMonth()
            &&
            now.getDate() >= birthDate.getDate()
        );

    if (!hasBirthdayThisYear) {
        age--;
    }

    let nextBirthday = new Date(

        now.getFullYear(),BIRTHDAY.month - 1, BIRTHDAY.day,0,0,0
    );

    if (now > nextBirthday) {

        nextBirthday = new Date(now.getFullYear() + 1, BIRTHDAY.month - 1, BIRTHDAY.day,0,0,0
        );
    }

    const diff = nextBirthday - now;

    const days = Math.floor(
        diff / (1000 * 60 * 60 * 24)
    );
    const hours = Math.floor(
        (diff % (1000 * 60 * 60 * 24))/(1000 * 60 * 60)
    );
    const minutes = Math.floor(
        (diff % (1000 * 60 * 60))/(1000 * 60)
    );
    const seconds = Math.floor(
        (diff % (1000 * 60))/ 1000
    );

    return {age,days,hours,minutes,seconds
    };
}

function isBirthdayToday() {

    const now = new Date();

    return (
        now.getDate() === BIRTHDAY.day
        &&
        (now.getMonth() + 1) === BIRTHDAY.month
    );
}

function updateDisplay() {

    const {age,days,hours,minutes,seconds

    } = calculateBirthday();

    document.getElementById("days").textContent =
        String(days).padStart(2, "0");
    document.getElementById("hours").textContent =
        String(hours).padStart(2, "0");
    document.getElementById("minutes").textContent =
        String(minutes).padStart(2, "0");
    document.getElementById("seconds").textContent =
        String(seconds).padStart(2, "0");

    const statusEl =
        document.getElementById("birthdayStatus");

    if (isBirthdayToday()) {

        statusEl.innerHTML =
            `🎂 สุขสันต์วันเกิด อายุ ${age} ปี 🎉`;

    } else {

        statusEl.innerHTML =

            `🎈 อีก ${days} วัน `
            +
            `${hours} ชั่วโมง `
            +
            `${minutes} นาที `
            +
            `${seconds} วินาที `
            +
            `จะถึงวันเกิดปีที่ ${age + 1}`;
    }
}

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

updateDisplay();

setInterval(updateDisplay, 1000);