from typing import Any, Text, Dict, List
from rasa_sdk import Action, Tracker
from rasa_sdk.executor import CollectingDispatcher
import mysql.connector

class ActionQueryRiceData(Action):
    def name(self) -> Text:
        return "action_query_rice_data"

    def run(self, dispatcher: CollectingDispatcher,
            tracker: Tracker,
            domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:

        message = tracker.latest_message.get('text', '').strip()

        # ----------------------------
        # 1. คำค้นหา → ตาราง + คอลัมน์
        # ----------------------------
        keyword_map = {
            "แคลอรี่": ("rice_nutrition", "calories"),
            "โปรตีน": ("rice_nutrition", "protein"),
            "ไขมัน": ("rice_nutrition", "fat"),
            "คาร์โบไฮเดรต": ("rice_nutrition", "carbohydrate"),
            "น้ำตาล": ("rice_nutrition", "sugar"),
            "โอเมก้า 3": ("bioactive", "omega3"),
            "โอเมก้า 6": ("bioactive", "omega6"),
            "โอเมก้า 9": ("bioactive", "omega9"),
            "สารต้านอนุมูลอิสระ": ("bioactive", "totalAntioxidant"),
            "เฟอรูลิก": ("bioactive", "ferulicAcid"),
            "กาบา": ("bioactive", "GABA"),
            "แกมมาโอไรซานอล": ("bioactive", "gammaOryzanol"),
        }

        rice_types = ["ข้าวกล้อง", "ข้าวกล้องงอก", "ข้าวสาร", "ข้าวเปลือก", "ข้าวหอมมะลิ", "ข้าวเหนียว"]
        found_keyword = None
        found_rice = None

        for kw in keyword_map:
            if kw in message:
                found_keyword = kw
                break

        for rt in rice_types:
            if rt in message:
                found_rice = rt
                break

        if not found_keyword or not found_rice:
            dispatcher.utter_message(text="กรุณาระบุทั้งชื่อสารหรือข้อมูล (เช่น โปรตีน) และชื่อข้าว (เช่น ข้าวกล้อง)")
            return []

        table, column = keyword_map[found_keyword]

        try:
            conn = mysql.connector.connect(
                host="mariadb",
                user="admin",
                password="rice",
                database="rice_product"
            )
            cursor = conn.cursor(dictionary=True)

            # เงื่อนไข WHERE จะเปลี่ยนไปตามตาราง
            if table == "rice_nutrition":
                where_clause = "rice_name LIKE %s"
            elif table == "bioactive":
                where_clause = "riceCategories LIKE %s"
            else:
                where_clause = "1=1"  # fallback

            query = f"""
                SELECT {column} FROM {table}
                WHERE {where_clause} AND {column} IS NOT NULL
                ORDER BY 1 DESC LIMIT 1
            """

            cursor.execute(query, (f"%{found_rice}%",))
            result = cursor.fetchone()

            if result and column in result:
                value = result[column]
                dispatcher.utter_message(text=f"{found_rice} มี {found_keyword} เท่ากับ {value} หน่วยค่ะ")
            else:
                dispatcher.utter_message(text=f"ขออภัย ไม่พบข้อมูล {found_keyword} สำหรับ {found_rice} ค่ะ")

        except Exception as e:
            dispatcher.utter_message(text=f"เกิดข้อผิดพลาด: {str(e)}")
        finally:
            if conn.is_connected():
                cursor.close()
                conn.close()

        return []
