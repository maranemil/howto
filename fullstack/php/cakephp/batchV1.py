#!/usr/bin/python
# -*- coding: utf-8 -*-

import _mysql
import sys
import os
import re
import csv

################################
#
# Entry point cakephp
#
################################

"""

# MySQL version: 5.7.19-0ubuntu0.17.04.1
# http://zetcode.com/db/mysqlpython/
# sudo apt-get install python-mysqldb

con = _mysql.connect('localhost', 'root', 'root', 'cakephpdb')    
con.query("SELECT VERSION()")
result = con.use_result()    
print "MySQL version: %s" % \
result.fetch_row()[0]
con.close()

con = _mysql.connect('localhost', 'root', 'root', 'cakephpdb')
con.query("SELECT * FROM files")
result = con.use_result()   
# print all the first cell of all the rows
for row in result.fetch_row():
	print row[4]
con.close()

"""

def checkFileExists(idFile):
	con = _mysql.connect('localhost', 'root', 'root', 'cakephpdb')
	con.query("SELECT * FROM dbfiles WHERE id=" + idFile)
	result = con.use_result()   
	# print all the first cell of all the rows
	#for row in result.fetch_row():
	#	print row[4] #
	#if( len(result.fetch_row()[0]) ):
	return result.fetch_row()[0]
	#else:
	#	return 	
	con.close()

def ReadItemsFolder(dataDirPath):   
	# Iterate on first dir for each file
	global dataFiles
	#indexerFl = 0
	pathdeep = str("/var/www/html/link/to/mydir/" + str(dataDirPath))
	for dir_item in os.listdir(pathdeep):       
		# if os.pathdeep.isfile(dir_item):
		# print dir_item # + "\n"
		# dataFiles[indexerFl] = dir_item;
		idselected = re.sub('[^0-9]', '', dir_item) 
		try:
			arFile = checkFileExists(idselected)
			#print idselected
			#print arFile[4]
			#++indexerFl

		except:
			# handle this
			#dataFiles.append(dataDirPath + str(idselected))

			print str("err" + str(idselected))

			#with open('batch.csv', 'a') as csvfile:
			#    fieldnames = ['fileid']
			#    writer = csv.DictWriter(csvfile, fieldnames=fieldnames)
			#    writer.writeheader()
			#    writer.writerow({'fileid': str(idselected) })

			#fd = open('batch.csv','a')
			#fd.write(str(idselected) + "\n")
			#fd.close()    


# Open a dir and check the dir list 
path = "/var/www/html/link/to/mydir/" 
dirs = os.listdir( path )
data = []
dataFiles = [] 
indexer = 0
# This would print all the files and directories
for file in dirs:
	#print file	
	if(file):		
		#print file
		data.append(file);


for item in data:
	#print(item)
	ReadItemsFolder(item)


#print(dataFiles)

# https://docs.python.org/2/library/functions.html
# https://docs.python.org/2/tutorial/datastructures.html
# https://docs.python.org/3/tutorial/datastructures.html
# http://www.secnetix.de/olli/Python/block_indentation.hawk
# https://docs.python.org/release/2.5.1/ref/indentation.html
# http://www.diveintopython.net/getting_to_know_python/indenting_code.html
# http://www.tutorialspoint.com/python/os_listdir.htm
# https://docs.python.org/2/library/functions.html
# http://www.php2python.com/wiki/function.readdir/
# https://pypi.python.org/pypi/scandir
# http://www.diveintopython.net/file_handling/os_module.html
# https://docs.python.org/2/library/re.html
# https://docs.python.org/2/howto/regex.html
# http://www.tutorialspoint.com/python/python_reg_expressions.htm
# https://www.python-kurs.eu/sql_python.php
# https://www.tutorialspoint.com/python/python_database_access.htm

#except _mysql.Error, e:
#  
#    print "Error %d: %s" % (e.args[0], e.args[1])
#    sys.exit(1)#
#
#finally:    
#    if con:
#        con.close()


