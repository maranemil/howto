#!/usr/bin/python

# https://towardsdatascience.com/how-to-generate-dummy-data-in-python-a05bce24a6c6
# pip install Faker

import pandas as pd
import random
import os
from faker import Faker
# from random import randrange
from datetime import datetime

from test_folders import getDbDir, getTestDir

path = getTestDir()
db_path = getDbDir()

nr_of_customers = 1000
fake = Faker('de_DE')
customers = []

for customers_id in range(nr_of_customers):
    # Create transaction date
    d1 = datetime.strptime(f'1/1/2021', '%m/%d/%Y')
    d2 = datetime.strptime(f'8/10/2021', '%m/%d/%Y')
    transaction_date = fake.date_between(d1, d2)
    # create customer's name
    name = fake.name()
    # Create gender
    gender = random.choice(["M", "F"])
    # Create email
    email = fake.ascii_email()
    # Create city
    city = fake.city()
    # create product ID in 8-digit barcode
    product_ID = fake.ean(length=8)
    # create amount spent
    amount_spent = fake.pyfloat(right_digits=2, positive=True, min_value=1, max_value=100)
    customers.append([transaction_date, name, gender, email, city, product_ID, amount_spent])

customers_df = pd.DataFrame(customers, columns=['Transaction_date', 'Name', 'Gender', 'Email', 'City', 'Product_id',
                                                'Amount_spent'])

pd.pandas.set_option('display.max_columns', None)
print(customers_df)

customers_df.to_csv(path + 'Sales_Customers_Sept21.csv', index=False)

# from google.colab import files
# customers_df.to_csv('customers_df.csv')
# files.download('customers_df.csv')

'''
https://www.listendata.com/2019/04/create-dummy-data-in-python.html
https://datascientyst.com/make-fake-data-set-python-pandas/
https://www.plus2net.com/python/pandas-student.php
https://www.caktusgroup.com/blog/2020/04/15/quick-guide-generating-fake-data-with-pandas/
https://www.caktusgroup.com/blog/2020/04/15/quick-guide-generating-fake-data-with-pandas/
https://dennisokeeffe.medium.com/generating-fake-csv-data-with-python-c73ba0ad7cbf
'''
