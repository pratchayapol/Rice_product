FROM rasa/rasa:3.6.10

WORKDIR /app

COPY . /app

USER root

# ติดตั้ง MySQL connector และ Cohere
RUN pip install --no-cache-dir mysql-connector-python cohere

COPY entrypoint.sh /app/entrypoint.sh
RUN chmod +x /app/entrypoint.sh

ENTRYPOINT ["/app/entrypoint.sh"]
