score=0
for i in range (3):
    s = int(input(f"คะแนนรายวิชาที่ {i+1} :"))
    score += s

average = score/3
print(f"คะแนนเฉลี่ย", average)