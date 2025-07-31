from typing import Any, Text, Dict, List
from rasa_sdk import Action, Tracker
from rasa_sdk.executor import CollectingDispatcher
import cohere
import os

class ActionAskCohere(Action):
    def name(self) -> Text:
        return "action_ask_cohere"

    def run(self, dispatcher: CollectingDispatcher,
            tracker: Tracker,
            domain: Dict[Text, Any]) -> List[Dict[Text, Any]]:

        # ดึงข้อความที่ผู้ใช้พูด
        user_message = tracker.latest_message.get("text", "").strip()

        # ดึง Cohere API Key จาก ENV (ปลอดภัยกว่า hardcode)
        api_key = os.getenv("9YXQBRffflmHsMKGssDTfXGx2nyqdo5oA2AdYg8E")
        if not api_key:
            dispatcher.utter_message(text="ไม่พบ COHERE_API_KEY กรุณาตั้งค่าก่อนใช้งาน")
            return []

        try:
            # เรียกใช้งาน Cohere
            co = cohere.Client(api_key)

            response = co.generate(
                model='command',  # รองรับข้อความทั่วไปได้ดี
                prompt=f"ตอบคำถามนี้เป็นภาษาไทยแบบสุภาพ: {user_message}",
                max_tokens=100,
                temperature=0.7
            )

            answer = response.generations[0].text.strip()

            # ส่งข้อความตอบกลับผู้ใช้
            dispatcher.utter_message(text=answer)

        except Exception as e:
            dispatcher.utter_message(text=f"เกิดข้อผิดพลาดขณะเรียก Cohere API: {str(e)}")

        return []
