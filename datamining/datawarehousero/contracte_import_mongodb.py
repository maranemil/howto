#!/usr/bin/env python

# sudo apt-get install python-pip
# sudo pip install python-dateutil --force-reinstall
# sudo pip install pymongo -U
# python -m pip install pymongo
# python3 -m pip install pymongo
# sudo pip  install unidecode

import csv
import dateutil.parser
import pymongo
import sys
import os
import codecs
import io
import string
import re
import md5
import pandas as pd
import numpy as np
import json


def cleanstring(text):
    # import string
    # Get the difference of all ASCII characters from the set of printable characters
    nonprintable = set([chr(i) for i in range(128)]).difference(string.printable)
    # Use translate to remove all non-printable characters
    cleantext = text.translate({ord(character): None for character in nonprintable})
    resptext = re.sub(r'[^a-zA-Z0-9\s]', '', cleantext)
    return resptext


reload(sys)
sys.setdefaultencoding('ISO-8859-1')
# sys.setdefaultencoding('UTF-8')
print(sys.getdefaultencoding())
# csv.field_size_limit(sys.maxsize)
# csv.field_size_limit(10)

print(sys.argv[0])
print(sys.argv[1])
# sys.exit(0)

"""
filename = sys.argv[1]
print("# sum(1 for line in open(filename)) ")
n = sum(1 for line in open(filename))
print('n = ', n)
print('\n')
print("# sum(1 for line in csv.reader(filename))")
n = sum(1 for line in csv.reader(filename))
print('n = ', n)
print('\n')
sys.exit(0)
"""

if len(sys.argv) != 2:
    print("usage: %s csvfile" % sys.argv[0])
    sys.exit(1)

# Open the CSV file
try:
    csvfile = open(sys.argv[1], 'r')
except IOError as e:
    print("error: unable to read %s" % sys.argv[1])
    sys.exit(2)

# Connect to MongoDB
try:
    mongo = pymongo.MongoClient()
    # NOTE dashes in collection names are problematic in the shell, hence the
    # conversion to underscores
    # collection = mongo.datagovro[sys.argv[1].split('.')[0].replace('-', '_')]
    collection = mongo.datagovro["contracte"]
except pymongo.errors.PyMongoError as e:
    print("error: unable to connect to MongoDB")
    sys.exit(3)

collection.drop();

"""
docy = list(range(800040)) 
for i in docy:
    print(i) 
sys.exit()
"""

"""
#####################################################################
#
#   Read CSV and prepare data for mongoDB
#
#####################################################################
"""

try:
    filename = sys.argv[1]
    for line in open(filename):
        # print (line)

        # reader = csv.reader(line.split('\n'), delimiter='|',quotechar='"')
        # reader = csv.reader(line.strip().strip('\'"'), delimiter='|',quotechar='"')
        reader = csv.reader(line.split('\n'), delimiter='|', quotechar='"', dialect=csv.excel_tab)

        # print(reader.line_num)
        # print(next(reader))
        # sys.exit()

        # keys = np.arange(40) # range(40)
        keys = list(range(40))
        # print(list(keys))
        # print(len(keys))

        # keys = reader.next()
        nulls = {int(i) for i in range(len(keys)) if keys[i] == ""}

        for row in reader:
            """
            try:
                assert(len(keys) == len(row))
            except AssertionError as e:
                print("error: unable to process %s as csv" % sys.argv[1])
                sys.exit(4)
                #continue
            """

            if (len(row) == 40):
                doc = {}
                for i in range(len(row)):
                    # Is this a null position?
                    if i in nulls:
                        continue

                    # val = (vals[i]).replace(".","").replace("/","").encode("utf-8")
                    valn = re.sub(r'[^a-zA-Z0-9-.:\s]', ' ', row[i]).rstrip()
                    keysn = 'ky' + re.sub(r'[^a-zA-Z0-9]', '', str(keys[i])).replace(";", " ")
                    doc[keysn] = valn

                doc['ky11'] = '*'
                doc['ky12'] = '*'
                doc['ky22'] = '*'
                doc['ky38'] = '*'
                print ("-----------------------------------------------------------")
                if (len(doc) == 40):
                    jsondoc = json.dumps(doc)
                    print (jsondoc)
                    print len(doc)
                    collection.insert_one(doc)
                else:
                    continue
                    # sys.exit()

except csv.Error as e:
    print(":::::exit5")
    print(e)
    print(":::::exit5")
    sys.exit(5)

sys.exit(0)

"""
#####################################################################
#
#   Read CSV and prepare data for mongoDB V2
#
#####################################################################
"""

try:
    # reader = csv.reader(csvfile, escapechar='\\', delimiter='|', dialect='csv') # quotechar='',
    # reader = csv.reader(csvfile, escapechar='\\', delimiter='|',
    #    quotechar='"',quoting=csv.QUOTE_NONE,dialect=csv.excel_tab)
    # reader = csv.reader(csvfile, escapechar='\\', delimiter='|')
    reader = csv.reader(csvfile, dialect=csv.excel_tab, delimiter='|')

    print (sum(1 for row in reader))
    # with open(self.file, 'r') as f:
    #    data = [row for row in csv.reader(f.read().splitlines())]

    # The header line contains field names
    keys = reader.next()
    # The CSV contains multiple null fields. We are removing these by
    # identifying their positions and skipping their positions on each line.
    nulls = {int(i) for i in range(len(keys)) if keys[i] == ""}

    for vals in reader:

        try:
            assert (len(keys) == len(vals))
        except AssertionError as e:
            print("error: unable to process %s as csv" % sys.argv[1])
            sys.exit(4)

        doc = {}

        for i in range(len(vals)):
            # Is this a null position?
            if i in nulls:
                continue

            # val = (vals[i]).replace(".","").replace("/","").encode("utf-8")
            valn = re.sub(r'[^a-zA-Z0-9\s]', '', vals[i]).rstrip()
            # keys[i] = (keys[i]).replace(".","")
            keysn = 'ky_' + re.sub(r'[^a-zA-Z0-9]', '', str(i))

            # Convert GameDate string to datetime
            # if keys[i] == "Altele":
            #    try:
            #        val = dateutil.parser.parse(val)
            #    except ValueError as e:
            #        pass
            # else:
            #    # Save integers as such instead of strings
            #    try:
            #        val = int(val)
            #    except ValueError as e:
            #        pass

            doc[keysn] = valn

        print (doc)
        print ("-----------------------------------------------------------")
        # sys.exit(7);

        collection.insert_one(doc)


except csv.Error as e:
    print(":::::exit5")
    print(e)
    print(":::::exit5")
    sys.exit(5)

"""
https://www.jdoodle.com/python3-programming-online

import string
import re

def cleanstring(text):
    import string
    # Get the difference of all ASCII characters from the set of printable characters
    nonprintable = set([chr(i) for i in range(128)]).difference(string.printable)
    # Use translate to remove all non-printable characters
    cleantext = text.translate({ord(character):None for character in nonprintable})
    resptext = re.sub(r'[^a-zA-Z0-9\s]', '',cleantext)
    return resptext

list = ['5310', 'Societatea Utilaj Transport SA', '6261285', 'Romania', 'Oltenita', 'Str. Dr. Lucian Popescu, nr. 1', 'Anunt de atribuire la anunt de participare', 'Lucrari', 'Licitatie deschisa',
'PRIMARIA MUNICIPIULUI OLTENITA', '4294103', 'Administratie publica locala (municipii, orase, comune), institutie publica in subordonarea/coordonarea administratiei publice locale',
'Servicii generale ale administratiilor publice', '8878', '2007-08-24 09:29:13.270', 'Un contract de achizitii publice', 'Oferta cea mai avantajoasa d.p.d.v. economic', '0', '1', '0',
'15587', '2007-07-23 00:00:00.000', 'Contr. de lucrari tehnico-edilitare zona str.Dr.Lucian Popescu(fosta Primaverii)lotizari si utilitat', '495000.00', 'RON', '495000.0', '157975.35999999999',
'6155', '45233000-9', '19993', '2007-06-19 15:47:20.617', '750715.00', 'RON', '0', '0', '0', '0', '0', 
'Garantia participare-10.000 lei constit prin scr.de garantie bancara/prin depunerea la casierie a unui ordin de plata(cont Trezoreria Oltenita RO67TREZ2025006XXX000587/fila CEC.', 
'plata se face de la bugetul local pe baza situatiilor de lucrari si a facturilor de plata prin conturi deschise la unitati de Trezorerie']

for i in list:
    print (cleanstring(i)) 
    print ("\n");

"""

"""

https://www.mongodb.com/blog/post/usdsample-football-2016-the-winner-s-in-the-data

iconv -c -f utf-8 -t ascii contracte_org.csv
sed 's/\[""\]//g' contracte_org.csv # remove quotes
sed 's/\\//g' contracte_org.csv # remove slash


https://docs.python.org/3.1/library/csv.html
https://docs.python.org/2/library/csv.html
https://docs.python.org/3/library/csv.html
https://docs.python.org/3.2/library/csv.html
https://docs.python.org/3/howto/unicode.html
https://docs.python.org/2/howto/unicode.html
https://docs.python.org/2/library/json.html
https://docs.python.org/3/howto/unicode.html
https://www.tutorialspoint.com/python/string_replace.htm
https://docs.python.org/2.0/ref/strings.html
http://www.codecodex.com/wiki/Remove_non-letters_from_a_string

# Short version  
print filter(lambda c: c.isalpha(), s)  
# Using regular expressions  
print re.sub("[^A-Za-z]", "", s)  

https://docs.mongodb.com/manual/reference/method/db.collection.remove/
https://docs.mongodb.com/manual/reference/program/mongoimport/
http://api.mongodb.com/python/current/tutorial.html
http://www.dba86.com/docs/mongo/2.4/reference/limits.html
https://docs.mongodb.com/manual/reference/limits/






B1---------------------------------------
data = open('data.csv', 'r')
reader = csv.reader(data)
print(next(reader))               # Parse the first line
[next(data) for _ in range(5)]    # Skip the next 5 lines on the underlying iterator
print(next(reader))               # This will be the 7'th line in data
print(reader.line_num)            # reader thinks this is the 2nd line
data.seek(0)                      # Go back to the beginning of the file
print(next(reader))               # gives first line again
data = ['1,2,3', '4,5,6', '7,8,9']
reader = csv.reader(data)         # works fine on lists of strings too
print(next(reader))               # ['1', '2', '3']


Removing Double Quotation From Python String 
mylist = line.strip('\n').replace('\"','')



https://jsonformatter.curiousconcept.com/
https://www.jdoodle.com/python3-programming-online
https://www.tutorialspoint.com/execute_python_online.php
https://www.python.org/shell/
https://repl.it/
https://repl.it/repls/ClearIndigoElement
https://www.onlinegdb.com/online_python_compiler


# import module
import pandas as pd
# read data
net_data = pd.read_csv('net_data.csv')
# print first five rows
print (net_data.head())
# extract values from column "win"
win_values = net_data.ix[:, 'win']
# print first five values from win_values
win_values.head()

"""