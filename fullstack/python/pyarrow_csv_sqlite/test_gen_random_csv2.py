#!/usr/bin/python

# Create random DataFrame and write to .csv
# https://riptutorial.com/pandas/example/19502/create-random-dataframe-and-write-to--csv
# https://www.youtube.com/watch?v=LsrJraFPmo0
# https://github.com/SuperDataWorld/Python/blob/main/Dummy_Data.ipynb

# import numpy as np
# import pandas as pd
# np.random.seed(0)
# df = pd.DataFrame(np.random.randn(5, 3), columns=list('ABC'))
# print(df)
# df.to_csv('example.csv', index=False)

import pandas as pd
# import numpy as np
import random
import datetime

from test_folders import getDbDir, getTestDir
path = getTestDir()
db_path = getDbDir()

cars = ['Audi', 'BMW', 'Kia', 'Honda', 'Skoda']

models = {0: ['A1', 'A3', 'A4', 'A5', 'A6'],
          1: ['1 Series', '3 Series', '5 Series', '7 Series', 'X5'],
          2: ['Rio', 'Spotage', 'Sorento', 'Soul', 'Ceed'],
          3: ['Accord', 'Civic', 'Jazz', 'Fit'],
          4: ['Citigo', 'Scala', 'Octavia']}

prices = {0: [30000, 32000, 55000, 60000, 70000],
          1: [35000, 50000, 60000, 70000, 65000],
          2: [19000, 40000, 58000, 37000, 25000],
          3: [32000, 25000, 30000, 15000],
          4: [15000, 20000, 35000]}

years = [2021, 2020, 2019, 2018, 2017]

salespeople = ['Pat Byrne', 'Joe Fats', 'Tony Long', 'Jimmy The Fly', 'Santa Barry', 'Mary Black']

car_data = pd.DataFrame()

for i in range(0, 250):
    make = random.choice(cars)
    modelindex = cars.index(make)
    model = random.choice(models.get(modelindex))
    priceindex = models.get(modelindex).index(model)
    price = prices.get(modelindex)[priceindex]
    year = random.choice(years)
    deval = (2021 - year) * .1
    purchase_price = round(price * (1 - (deval + random.uniform(-.05, .1))), 2)
    repair_cost = round(purchase_price * random.uniform(.01, .1), 2)
    sales_price = round((purchase_price + repair_cost) * random.uniform(.95, 1.1), 2)
    stock_days = random.randint(1, 90)
    date_sold = datetime.datetime(2021, 9, 1) + datetime.timedelta(days=random.randint(0, 30))
    profit = sales_price - purchase_price - repair_cost
    salesperson = random.choice(salespeople)

    linedict = {'Make': [make], 'Model': [model], 'Year': [year], 'Purchase Price': [purchase_price],
                'Repair Cost': [repair_cost],
                'Sales Price': [sales_price], 'Profit': [profit], 'Stock Days': [stock_days], 'Date Sold': [date_sold],
                'Sales Person': [salesperson]}

    line = pd.DataFrame(linedict)
    car_data = pd.concat([car_data, line])

car_data.to_csv(path + 'Sales_Data_Sept21.csv', index=False)
print(car_data)
