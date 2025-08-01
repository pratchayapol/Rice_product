from flask import Flask, request, jsonify
from flask_cors import CORS
import openai
import mysql.connector
import os

app = Flask(__name__)
CORS(app)  # ✅ เปิด CORS

# ดึง API KEY จาก ENV
openai.api_key = os.getenv("OPENAI_API_KEY")

# ตั้งค่าฐานข้อมูล
db_config = {
    'host': 'mariadb',
    'user': 'admin',
    'password': 'rice',
    'database': 'rice_product',
    'port': 3306
}

@app.route('/api/chat', methods=['POST'])
def chat():
    data = request.get_json()
    user_input = data.get("message", "")
    tables = data.get("tables", ["food_product"])  # รับชื่อ tables เป็น list
    gpt_response = ""
    db_data = {}

    # ดึงข้อมูลจากหลายตารางก่อน (ในที่นี้เน้น food_product)
    try:
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor(dictionary=True)
        for table in tables:
            cursor.execute(f"SELECT * FROM {table}")
            db_data[table] = cursor.fetchall()
        cursor.close()
        conn.close()
    except Exception as e:
        db_data = {"error": str(e)}

    # สร้าง context สำหรับ GPT
    # สมมติตาราง food_product มีข้อมูล: product_name, nutrition_info, etc.
    nutrition_info_text = ""
    if "food_product" in db_data and isinstance(db_data["food_product"], list):
        for item in db_data["food_product"]:
            # สมมติมี fields ชื่อ product_name กับ nutrition_info
            name = item.get("product_name", "Unknown")
            nutrition = item.get("nutrition_info", "No info")
            nutrition_info_text += f"- {name}: {nutrition}\n"

    # สร้าง prompt ที่ส่งให้ GPT
    prompt = (
        "ข้อมูลโภชนาการข้าวจากฐานข้อมูล:\n"
        f"{nutrition_info_text}\n"
        "โปรดตอบคำถามนี้โดยใช้ข้อมูลข้างต้นเป็นอ้างอิง:\n"
        f"{user_input}"
    )

    # เรียก GPT-3.5 โดยส่ง prompt นี้
    try:
        client = openai.OpenAI(api_key=os.getenv("OPENAI_API_KEY"))
        response = client.chat.completions.create(
            model="gpt-3.5-turbo",
            messages=[{"role": "user", "content": prompt}]
        )
        gpt_response = response.choices[0].message.content
    except Exception as e:
        gpt_response = f"OpenAI Error: {str(e)}"

    return jsonify({
        "input": user_input,
        "gpt_response": gpt_response,
        "db_data": db_data
    })



if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
