from flask import Flask, request, render_template_string
import mysql.connector

app = Flask(__name__)

def connect_db():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="hotel_db"
    )

@app.route('/reserve', methods=['POST'])
def reserve():
    data = request.form
    conn = connect_db()
    cursor = conn.cursor()
    cursor.execute(
        "INSERT INTO reservations (name, email, checkin, checkout, room, requests) VALUES (%s, %s, %s, %s, %s, %s)",
        (data['name'], data['email'], data['checkin'], data['checkout'], data['room'], data['requests'])
    )
    conn.commit()
    cursor.close()
    conn.close()
    return "Booking successful!"

if __name__ == '__main__':
    app.run(debug=True)
