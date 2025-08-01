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
    'host': os.getenv("DB_HOST"),
    'user': os.getenv("DB_USER"),
    'password': os.getenv("DB_PASSWORD"),
    'database': os.getenv("DB_NAME"),
    'port': 3307
}

@app.route('/api/chat', methods=['POST'])
def chat():
    data = request.get_json()
    user_input = data.get("message", "")
    gpt_response = ""
    db_data = []

    # เรียก GPT-3.5
    try:
        client = openai.OpenAI(api_key=os.getenv("OPENAI_API_KEY"))
        response = client.chat.completions.create(
            model="gpt-3.5-turbo",
            messages=[{"role": "user", "content": user_input}]
        )
        gpt_response = response.choices[0].message.content
    except Exception as e:
        gpt_response = f"OpenAI Error: {str(e)}"

    # ดึงข้อมูลจาก MySQL
    try:
        conn = mysql.connector.connect(**db_config)
        cursor = conn.cursor(dictionary=True)
        cursor.execute("SELECT * FROM products")
        db_data = cursor.fetchall()
        cursor.close()
        conn.close()
    except Exception as e:
        db_data = [{"error": str(e)}]

    return jsonify({
        "input": user_input,
        "gpt_response": gpt_response,
        "db_data": db_data
    })

if __name__ == '__main__':
    app.run(host='0.0.0.0', port=5000)
