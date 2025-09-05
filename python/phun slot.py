import random
import time


symbols = ["🍒", "🍋", "🔔", "💎", "🍀", "9️⃣"]


jackpot_rate = 100


def spin_slot():
    roll = random.randint(1, 100)

    if roll <= jackpot_rate:

        chosen = random.choice(symbols)
        return [chosen, chosen, chosen]
    else:

        return [random.choice(symbols) for _ in range(3)]


def check_win(result):
    return result[0] == result[1] == result[2]


def play_slot():
    print("🎰 กำลังหมุน...")
    time.sleep(1)
    result = spin_slot()
    print(" | ".join(result))
    
    if check_win(result):
        print("🎉 แจ็คพอต! คุณชนะ!")
    else:
        print("😢 เสียดาย! ลองใหม่อีกครั้งนะ")


while True:
    play_slot()
    again = input("\nจะหมุนอีกครั้งไหม? (y/n): ")
    if again.lower() != 'y':
        print("ขอบคุณที่เล่นครับ!")
        break
