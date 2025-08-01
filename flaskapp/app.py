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

    # เชื่อม DB เพื่อดึงข้อมูลที่เกี่ยวข้อง (ตัวอย่างเชิง concept)
    conn = mysql.connector.connect(**db_config)
    cursor = conn.cursor(dictionary=True)

    # สมมติ user_input ถามชื่อพันธุ์ข้าว
    # ดึงข้อมูลเฉพาะพันธุ์ข้าวที่มีคำที่ user_input ถาม (แบบง่าย)
    query = "SELECT * FROM food_product WHERE product_name LIKE %s LIMIT 3"
    cursor.execute(query, (f"%{user_input}%",))
    relevant_data = cursor.fetchall()

    cursor.close()
    conn.close()

    # สร้างข้อความสรุปข้อมูลที่ดึงมา (ไม่ส่ง raw data ทั้งหมด)
    context = ""
    for item in relevant_data:
        context += f"- {item['product_name']}: โภชนาการ - {item.get('nutrition_info', 'ไม่มีข้อมูล')}\n"

    prompt = f"ข้อมูลโภชนาการข้าวที่เกี่ยวข้อง:\n{context}\n\nตอบคำถามนี้: {user_input}"

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
        "gpt_response": gpt_response
    })




if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
