# > การใช้ comment
    # --------

# การใช้ปริ้นให้แสดงคำที่ เขียน

# ประเภทของตัวแปร
x = 1 #int จำนวนเต็ม
y = 1.5 #float ทศนิยม
z = 'a1' #complex เลขกับอักษร 

print(type(x))
print(type(y))
print(type(z))


print("Hello World") #มันจะออกมาเป็น Hello World

# การย่อหน้า ของ Python
if 5 > 2 :
    print("5 มากกว่า 2")

# ตัวแปรใน Python และ ส่งออกตัวแปรหลายตัว
x = 5 # x มีค่าเปน 5
y = 6 # y มีค่าเปน 6 
z = 7 # z มีค่าเปน 7
print(x,y,z)

# การสร้างตัวแปร Python ที่กำหนด
x = "Hello"
y = 18
print(x) # จะนำตัว x ที่มีสร้างตัวแปรไว้
print(y) # จะนำตัว y ที่มีสร้างตัวแปรไว้

# แยกแยะชื่อตัวแปร ตัวเล็ก/ใหญ่
a = "abcd"
A = 5

# ชื่อตัวแปรใน python
myvar = "pepo"
print(myvar) #แทนชื่อด้วยตัวแปร

# ตัวแปรหลากหลาย ใน 1 บรรทัด
x , y , z = 'red','blue','green'
print(x) # red
print(y) # blue
print(z) # green

# 1 ค่า ต่อตัวแปรหลายตัว
x = y = z = "1234" #แสดงตัวแปร หลายบรรทัดตามที่กำหนดไว้
print(x) #1234
print(y) #1234
print(z) #1234

# แยกค่าตัวแปร ใน 1 รายการ
car = ['toyota','honda','suzuki'] #จะทำการแยกประเภท ตามที่เรากำหนดตัวแปรไว้
a,b,c = car
print(a)
print(b)
print(c)

# ใช้เครื่องหมายทาง คณิต
x = 5
y = 5
print(x + y) #นำมา x+y จะได้ 10

# การใช้เครื่องหมาย , คั่นกลางเพื่อรองรับประภทตัวแปรต่างกัน
x = 5
y = 'pepo'
print(x ,y)

# สร้างตัวแปร ภายในฟังค์ชั่น def myfunc
x = 'awesome' # ตัวแปรนี้จะไปแสดงนอก ฟังค์ชั่น
def myfunc ():
    x = "fantastic" # ตัวแปรนี้จะไปแสดงใน ฟังค์ชั่น
    print("Python is " + x)

myfunc()
print("python is " + x)

# ใช้ global
x = 'awesome' # ตัวแปรนี้จะไม่นับ

def myfunc ():
    global x 
    x = "fantastic" # นับตัวแปรนี้ไปแสดงต่อ

myfunc()

print("python is " + x)

# การสุ่ม ตัวเลขโดยใช้ random()
import random
print (random.randrange(1, 10)) #การสุุ่มตัวเลข ตั้งแค่ 1-9

# String array
a = "Hello pepo" #เป็นการใส่ตัวเลขตามอักษร ตามจำนวนอักษรที่มี (อักษรตัวแรกจะนับเป็น 0)
print(a[5])

# การใช้ for ใน String
for x in "appple" : 
    print(x)

# การใช้ len() ใน String
c = "Hello pepo!" #เป็นการนับจำนวนตัวอักษร
print(len(c))

# การตรวจสอบคำใน String 
txt ="wow yet mae mather fuck" #เปนการนำคนในคำสั่งมาตรวจสอบว่ามีจริงหรือไม่
print("fuck" in txt) 
# เพิ่มคำสั่ง if
txt = "wow ahiahi eiei"
if "w" in txt : #เป็นคำสั่งที่ตรวจสอบคำในคำtxt ไม่ว่าจะ 1ตัว หรือ2ตัว ขอแค่อยู่ในคำสั่ง txt
    print("D makmak")

# การแบ่ง String python
a = 'Hello pepo' 
print(a[:5])

