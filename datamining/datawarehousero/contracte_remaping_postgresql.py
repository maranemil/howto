#
# Small script to show PostgreSQL and Pyscopg together
#


# pip install psycopg2
# pip install psycopg2-binary

import psycopg2
import sys
import json

# connect
try:
    conn = psycopg2.connect("dbname='datagovro' user='postgres' host='localhost' password='root'")
except:
    print "I am unable to connect to the database"

# select rows
cur = conn.cursor()
cur.execute("""SELECT * from contractetmp LIMIT 300000 OFFSET 200000""")
rows = cur.fetchall()

# clear table before import
cur = conn.cursor()
#insert_query = "INSERT INTO contracte VALUES {}".format("(10, 'hello@dataquest.io', 'Some Name', '123 Fake St.')")
truncate_query = "TRUNCATE TABLE contracte"
print(truncate_query)
cur.execute(truncate_query)
conn.commit()


arTmp = {}
for row in rows:
    
	#print(json.dumps(row))
	#jsonrow = json.dumps(row)

	# map data 
	arTmp['castigator'] = row[0]
	arTmp['castigatorcui'] = row[1] 
	arTmp['castigatortara'] = row[2] 
	arTmp['castigatorlocalitate'] = row[3] 
	arTmp['castigatoradresa'] = row[4] 
	arTmp['tip'] = row[5] 
	arTmp['tipcontract'] = row[6] 
	arTmp['tipprocedura'] = row[7] 
	arTmp['autoritatecontractanta'] = row[8] 
	arTmp['autoritatecontractantacui'] = row[9] 
	arTmp['tipac'] = row[10] 
	arTmp['tipactivitateac'] = row[11] 
	arTmp['numaranuntatribuire'] = row[12] 
	arTmp['dataanuntatribuire'] = row[13] 
	arTmp['tipincheierecontract'] = row[14] 
	arTmp['tipcriteriiatribuire'] = row[15] 
	arTmp['culicitatieelectronica'] = row[16] 
	arTmp['numaroferteprimite'] = row[17] 
	arTmp['subcontractat'] = row[18] 
	arTmp['numarcontract'] = row[19] 
	arTmp['datacontract'] = row[20] 
	arTmp['titlucontract'] = row[21] 
	arTmp['valoare'] = row[22] 
	arTmp['moneda'] = row[23] 
	arTmp['valoareron'] = row[24] 
	arTmp['valoareeur'] = row[25] 
	arTmp['cpvcodeid'] = row[26] 
	arTmp['cpvcode'] = row[27] 
	arTmp['numaranuntparticipare'] = row[28]
	arTmp['dataanuntparticipare'] = row[29] 
	arTmp['valoareestimataparticipare'] = row[30] 
	arTmp['monedavaloareestimataparticipare'] = row[31] 
	arTmp['fonduricomunitare'] = row[32] 
	arTmp['tipfinantare'] = row[33] 
	arTmp['tiplegislatieid'] = row[35] 
	arTmp['fondeuropean'] = row[36] 
	arTmp['contractperiodic'] = row[37] 
	arTmp['depozitegarantii'] = row[38] 
	arTmp['modalitatifinantare'] = row[39] 

	#print(arTmp)
	#sys.exit()

	# inset data in second table
	cur = conn.cursor()
	#insert_query = "INSERT INTO contracte VALUES {}".format("(10, 'hello@dataquest.io', 'Some Name', '123 Fake St.')")
	insert_query = "INSERT INTO contracte (castigator,castigatorcui , castigatortara , castigatorlocalitate , castigatoradresa , tip , tipcontract , tipprocedura , autoritatecontractanta , autoritatecontractantacui , tipac , tipactivitateac , numaranuntatribuire , dataanuntatribuire , tipincheierecontract , tipcriteriiatribuire , culicitatieelectronica , numaroferteprimite , subcontractat , numarcontract , datacontract , titlucontract , valoare , moneda , valoareron , valoareeur , cpvcodeid , cpvcode , numaranuntparticipare , dataanuntparticipare , valoareestimataparticipare , monedavaloareestimataparticipare , fonduricomunitare , tipfinantare , tiplegislatieid , fondeuropean , contractperiodic , depozitegarantii , modalitatifinantare) VALUES ( '" + str(arTmp["castigator"]) + "','" + str(arTmp["castigatorcui"]) + "', '" + str(arTmp["castigatortara"]) + "', '" + str(arTmp["castigatorlocalitate"]) + "', '" + str(arTmp["castigatoradresa"]) + "', '" + str(arTmp["tip"]) + "', '" + str(arTmp["tipcontract"]) + "', '" + str(arTmp["tipprocedura"]) + "', '" + str(arTmp["autoritatecontractanta"]) + "', '" + str(arTmp["autoritatecontractantacui"]) + "', '" + str(arTmp["tipac"]) + "', '" + str(arTmp["tipactivitateac"]) + "' , '" + str(arTmp["numaranuntatribuire"]) + "' , '" + str(arTmp["dataanuntatribuire"]) + "', '" + str(arTmp['tipincheierecontract']) + "', '" + str(arTmp['tipcriteriiatribuire']) + "', '" + str(arTmp['culicitatieelectronica']) + "', '" + str(arTmp['numaroferteprimite']) + "', '" + str(arTmp['subcontractat']) + "', '" + str(arTmp['numarcontract']) + "', '" + str(arTmp['datacontract']) + "', '" + str(arTmp['titlucontract']) + "', '" + str(arTmp['valoare']) + "', '" + str(arTmp['moneda']) + "', '" + str(arTmp['valoareron']) + "', '" + str(arTmp['valoareeur']) + "', '" + str(arTmp['cpvcodeid']) + "', '" + str(arTmp['cpvcode']) + "', '" + str(arTmp['numaranuntparticipare']) + "', '" + str(arTmp['dataanuntparticipare']) + "', '" + str(arTmp['valoareestimataparticipare']) + "', '" + str(arTmp['monedavaloareestimataparticipare']) + "', '" + str(arTmp['fonduricomunitare']) + "', '" + str(arTmp['tipfinantare']) + "', '" + str(arTmp["tiplegislatieid"]) + "', '" + str(arTmp["fondeuropean"]) + "', '" + str(arTmp['contractperiodic']) + "', '" + str(arTmp['depozitegarantii']) + "', '" + str(arTmp['modalitatifinantare']) + "') "
	print(insert_query)
	cur.execute(insert_query)
	conn.commit()
	#sys.exit()