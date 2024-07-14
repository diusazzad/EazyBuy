import random
import mysql.connector

def insert_random_products(host, user, password, database, port, num_products):
  """Inserts random product data into the specified database."""

  try:
    mydb = mysql.connector.connect(
        host="localhost",
        user="root",
        password="",
        database="laravel-11-eazybuy-test",
        port=8080
    )

    mycursor = mydb.cursor()

    for i in range(num_products):
      name = f"Product {i+1}"
      description = f"Description for product {i+1}"
      price = round(random.uniform(1, 100), 2)
      quantity = random.randint(1, 100)
      sql = "INSERT INTO products (name, description, price, quantity) VALUES (%s, %s, %s, %s)"
      val = (name, description, price, quantity)
      mycursor.execute(sql, val)

    mydb.commit()
  except mysql.connector.Error as err:
    print(f"Error: {err}")
  finally:
    mycursor.close()
    mydb.close()



insert_random_products(host, user, password, database, port, num_products)
