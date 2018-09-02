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
import logging
import os


logging.basicConfig( filename="main.log.py",
 filemode='w',
 level=logging.DEBUG,
 format= '%(asctime)s - %(levelname)s - %(message)s',
)

def cleanstring(text):
    #import string
    # Get the difference of all ASCII characters from the set of printable characters
    nonprintable = set([chr(i) for i in range(128)]).difference(string.printable)
    # Use translate to remove all non-printable characters
    cleantext = text.translate({ord(character):None for character in nonprintable})
    resptext = re.sub(r'[^a-zA-Z0-9\s]', '',cleantext)
    return resptext

reload(sys)  
sys.setdefaultencoding('ISO-8859-1')
#sys.setdefaultencoding('UTF-8')
print(sys.getdefaultencoding())
#csv.field_size_limit(sys.maxsize)
#csv.field_size_limit(10)

# split -l 500 export_for_mongodb_20180831070348.csv prefix_
# sudo apt install rename -y
# rename 's/^/imp_/' * - add prefix
# for f in *;do mv "$f" "$f.csv"; done   - add sufix extension
# rename 's/perl/pl/' *.perl - rename to pl

# Connect to MongoDB
try:
    mongo = pymongo.MongoClient()
    collection = mongo.datagovro["contracte"]
except pymongo.errors.PyMongoError as e:
    print("error: unable to connect to MongoDB")
    sys.exit(3)

collection.drop();


importDir = 'import/'

for filename in os.listdir(importDir):

	ext = os.path.splitext(filename)[-1].lower()

	#if (ext == 'py'):
	#	continue
	#else:
	#	print filename;		

	if filename.endswith(".csv"):
		# Open the CSV file
		try:
		    csvfile = open(os.path.join(importDir, filename), 'r')
		except IOError as e:
		    print("error: unable to read %s" % filename)
		    sys.exit(2)

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
		    for line in open(os.path.join(importDir, filename)):
		        #print (line)

		        #reader = csv.reader(line.split('\n'), delimiter='|',quotechar='"')
		        #reader = csv.reader(line.strip().strip('\'"'), delimiter='|',quotechar='"')
		        reader = csv.reader(line.split('\n'), delimiter='|',quotechar='"',dialect=csv.excel_tab)

		        #keys = np.arange(40) # range(40)
		        keys = list(range(40)) 
		        #print(list(keys)) 
		        #print(len(keys)) 
		        
		        #keys = reader.next()
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

		            if( len(row) == 40 ):
		                doc = {}
		                for i in range(len(row)):
		                    # Is this a null position?
		                    if i in nulls:
		                        continue
		                    
		                    #val = (vals[i]).replace(".","").replace("/","").encode("utf-8")
		                    valn = re.sub(r'[^a-zA-Z0-9-.:\s]', ' ',row[i]).rstrip()
		                    keysn = 'ky' + re.sub(r'[^a-zA-Z0-9]', '',str(keys[i])).replace(";"," ")
		                    doc[keysn] = valn

		                doc['ky11'] = '*'
		                doc['ky12'] = '*'
		                doc['ky22'] = '*'
		                doc['ky38'] = '*'
		                print ("-----------------------------------------------------------")
		                if(len(doc) == 40):
		                    jsondoc = json.dumps(doc)
		                    #print (jsondoc)   
		                    print ( str(len(doc)) + str(filename)) 
		                    collection.insert_one(doc)
		                else:
		                    continue    
		            #sys.exit()          
		        
		except csv.Error as e:
		    print(":::::exit5")
		    print(e)
		    print(":::::exit5")
		    #logging.exception(e + str(filename))


		    """
		    logging.error(
			    "Function {function_name} raised {exception_class} ({exception_docstring}): {exception_message}".format(
			    function_name = extract_function_name(), #this is optional
			    exception_class = e.__class__,
			    exception_docstring = e.__doc__,
				exception_message = e.message))
			"""
		    # Error: new-line character seen in unquoted field - do you need to open the file in universal-newline mode?
		    #sys.exit(5)
		    continue

	#sys.exit(0)



