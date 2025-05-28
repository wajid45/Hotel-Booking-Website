from flask import Flask, request, send_from_directory
import mysql.connector
import os

app = Flask(__name__)

# Connect to the MySQL database
def connect_db():
    return mysql.connector.connect(
        host="localhost",
        user="root",
        password="",  # Default XAMPP password is blank
        database="hotel_db"
    )

# Booking Route
@app.route('/reserve', methods=['POST'])
def reserve():
    try:
        data = request.form
        conn = connect_db()
        cursor = conn.cursor()
        cursor.execute("""
            INSERT INTO reservations (name, email, checkin, checkout, room, requests)
            VALUES (%s, %s, %s, %s, %s, %s)
        """, (data['name'], data['email'], data['checkin'], data['checkout'], data['room'], data['requests']))
        conn.commit()

        # HTML Response
        return """
            <!DOCTYPE html>
            <html>
            <head>
                <title>Booking Confirmed</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        text-align: center;
                        padding: 50px;
                        background: linear-gradient(to top, rgba(66, 66, 66, 0.5) 40%, rgba(66, 66, 66, 0.5) 40%),
                                    url("img/pen1.jpg") center;
                        background-size: cover;
                        color: white;
                    }
                    .box {
                        background: white;
                        padding: 30px;
                        max-width: 500px;
                        margin: auto;
                        border-radius: 10px;
                        box-shadow: 0 0 10px rgba(0,0,0,0.1);
                        color: black;
                    }
                    h2 { color: green; }
                </style>
            </head>
            <body>
                <div class="box">
                    <h2>✅ Booking Successful!</h2>
                    <p>Thank you for booking with Royalton Hotel.</p>
                </div>
            </body>
            </html>
        """
    except Exception as e:
        return f"❌ Error: {e}"

# Signup Route
@app.route('/signup', methods=['POST'])
def signup():
    try:
        name = request.form['signup-name']
        email = request.form['signup-email']
        password = request.form['signup-password']

        conn = connect_db()
        cursor = conn.cursor()
        cursor.execute("INSERT INTO users (name, email, password) VALUES (%s, %s, %s)",
                       (name, email, password))
        conn.commit()
        return "✅ Signup successful! You can now log in."
    except mysql.connector.Error as err:
        return f"❌ Signup error: {err}"
    finally:
        cursor.close()
        conn.close()

# Login Route
@app.route('/login', methods=['POST'])
def login():
    try:
        email = request.form['login-email']
        password = request.form['login-password']

        conn = connect_db()
        cursor = conn.cursor()
        cursor.execute("SELECT * FROM users WHERE email = %s AND password = %s",
                       (email, password))
        user = cursor.fetchone()

        if user:
            return f"✅ Welcome, {user[1]}!"
        else:
            return "❌ Invalid email or password."
    except mysql.connector.Error as err:
        return f"❌ Login error: {err}"
    finally:
        cursor.close()
        conn.close()


if __name__ == '__main__':
    app.run(debug=True)
