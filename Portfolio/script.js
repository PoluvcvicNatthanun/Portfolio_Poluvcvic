// ==========================================
// วันเกิด
// ==========================================
const BIRTHDAY = {
    day: 2,
    month: 7,
    year: 2550
};
// ==========================================
// คำนวณอายุ + นับถอยหลัง
// ==========================================
function calculateBirthday() {
    const now = new Date();
    // แปลง พ.ศ. -> ค.ศ.
    const birthDate = new Date(
        BIRTHDAY.year - 543,
        BIRTHDAY.month - 1,
        BIRTHDAY.day
    );
    // ======================================
    // คำนวณอายุ
    // ======================================
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
    // ======================================
    // วันเกิดครั้งถัดไป
    // ======================================
    let nextBirthday = new Date(
        now.getFullYear(),
        BIRTHDAY.month - 1,
        BIRTHDAY.day,0,0,0
    );
    // ถ้าผ่านวันเกิดแล้ว → นับปีหน้า
    if (now > nextBirthday) {
        nextBirthday = new Date(
            now.getFullYear() + 1,
            BIRTHDAY.month - 1,
            BIRTHDAY.day,0,0,0
        );
    }
    // ======================================
    // เวลานับถอยหลัง
    // ======================================
    const diff = nextBirthday - now;
    const diffDays = Math.floor(
        diff / (1000 * 60 * 60 * 24)
    );
    const diffHours = Math.floor(
        (diff % (1000 * 60 * 60 * 24))/(1000 * 60 * 60));
    const diffMinutes = Math.floor(
        (diff % (1000 * 60 * 60))/(1000 * 60));
    const diffSeconds = Math.floor(
        (diff % (1000 * 60))/ 1000);
    return {age,diffDays,diffHours,diffMinutes,diffSeconds};
    }
// ==========================================
// เช็กว่าวันนี้วันเกิดไหม
// ==========================================
function isBirthdayToday() {
    const now = new Date();
    return (
        now.getDate() === BIRTHDAY.day
        &&
        (now.getMonth() + 1) === BIRTHDAY.month
    );
}
// ==========================================
// อัปเดตหน้าเว็บ
// ==========================================
function updateDisplay() {
    const {age,diffDays,diffHours,diffMinutes,diffSeconds
    } = calculateBirthday();
    document.getElementById("currentAge").textContent =age;
    // นับถอยหลัง
    document.getElementById("days").textContent =
        String(diffDays).padStart(2, "0");
    document.getElementById("hours").textContent =
        String(diffHours).padStart(2, "0");
    document.getElementById("minutes").textContent =
        String(diffMinutes).padStart(2, "0");
    document.getElementById("seconds").textContent =
        String(diffSeconds).padStart(2, "0");
    // ข้อความสถานะ
    const statusEl =
        document.getElementById("birthdayStatus");
    // ถ้าเป็นวันเกิด
    if (isBirthdayToday()) {
        statusEl.innerHTML =
            "🎂 วันนี้เป็นวันเกิด! สุขสันต์วันเกิด 🎉";
    } else {
        statusEl.innerHTML =
            `🎈 อีก ${diffDays} วัน `
            +
            `${diffHours} ชั่วโมง `
            +
            `${diffMinutes} นาที `
            +
            `${diffSeconds} วินาที `
            +
            `จะถึงวันเกิดปีที่ ${age + 1}`;
    }
}
// ==========================================
// เริ่มทำงาน
// ==========================================
updateDisplay();
setInterval(updateDisplay, 1000);