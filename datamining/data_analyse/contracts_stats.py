#!/usr/bin/python

import os,sys
import pandas as pd
import numpy as np
#import matplotlib.pylab as plt
import sklearn as sk
from scipy import stats
from sklearn.tree import DecisionTreeRegressor
import matplotlib
import matplotlib.pyplot as plt

# read csv with pandas
os.chdir(".")
df = pd.read_csv('contracte2aP1cut2.csv')
features = list(df.columns[:10]) # show firt 10 columns

# print info about csv
print(df.head()) # print first 4 lines
print(features) # print features
print(len(df)) # print total csv lines

print "------------------------------------------"
X = df.values[:, 1:2] # second col [:, 1:5]
Y = df.values[: -1,9] # last column

print(X) # [['Bucuresti']  ['IASI']  ['Sibiu']]
print(Y) # ['RON' 'RON' 'RON' ..., 'RON' 'RON' 'RON']

print(df.shape) # (92211, 10)
print(df.ndim) # 2
print(df.size) # 922110
print(type(df)) # <class 'pandas.core.frame.DataFrame'>

#import numpy
#a = numpy.asarray([ [1,2,3], [4,5,6], [7,8,9] ])
#numpy.savetxt("contracte2aP1cut2.csv", a, delimiter=",")
#a.tofile('foo.csv',sep=',',format='%10.5f')

#import pandas as pd
#df = pd.DataFrame(np_array)
#df.to_csv("file_path.csv")

from collections import defaultdict
pdf = defaultdict(int)
for x,y in zip(X,Y):
  pdf[x] += y

aResult = pdf.keys()
bResult = pdf.values()



"""

https://data.gov.ro/dataset/achizitii-publice-2007-2015-contracte

http://data.gov.ro/storage/f/2013-11-01T13:59:27.012Z/contracte-2007.csv
http://data.gov.ro/dataset/situatia-executarii-contractelor-de-achizitii-publice-2017
http://data.gov.ro/dataset/contracte-de-achizitii-publice-incheiate-pe-anul-2016
http://data.gov.ro/dataset/contracte_achizitii_publice
http://data.gov.ro/dataset/contracte-de-achizitii-publice-cu-valoare-peste-10-000-euro
http://data.gov.ro/dataset/achizitii-publice-2016-continuare
http://data.gov.ro/dataset/achizitii-publice-2010-2015-anunturi-de-participare
http://data.gov.ro/dataset/achizitii-publice-2010-2015-invitatii-de-participare


http://data.gov.ro/dataset/achizitii-publice-2007-2016-contracte6
https://www.europeandataportal.eu/data/en/dataset/achizitii-publice-2007-2016-contracte6
https://www.europeandataportal.eu/mqa-service/en/catalogue/data-gov-ro/distributions
http://data.gov.ro/dataset/contracte-de-achizitii-publice-incheiate-pe-anul-2016
http://data.gov.ro/dataset/centralizator-achizitii-publice-2016
http://data.gov.ro/dataset/achizitii-publice
http://data.gov.ro/dataset/achizitii-publice-2017
http://data.gov.ro/dataset/achizitii-publice-2017#





http://data.gov.ro/dataset/situatia-platilor-ministerul-justitiei-titlul-51
http://data.gov.ro/dataset/mers-tren-regiotrans-brasov
http://data.gov.ro/dataset/situatii-privind-efectuarea-platilor-de-catre-centrul-national-sis
http://data.gov.ro/dataset/situatia-platilor-ministerul-justitiei-titlul-55
http://data.gov.ro/dataset/asistenta-si-incluziune-sociala
http://data.gov.ro/dataset/datoriile-catre-bugetul-de-stat
http://data.gov.ro/dataset/plati-surse-proprii-subventii-2015
http://data.gov.ro/dataset/autorizatii-transport-persoane
http://data.gov.ro/dataset/monitorizari-privind-publicarea-de-documente-din-oficiu-ministere-si-institutii-subordonate
http://data.gov.ro/dataset/registrul-national-ong
http://data.gov.ro/dataset/buget-sgg
http://data.gov.ro/dataset/achizitii-publice-2010-2015-anunturi-de-participare
http://data.gov.ro/dataset/protectia-drepturilor-copilului
http://data.gov.ro/dataset/achizitii
http://data.gov.ro/dataset/pensii-si-asigurari-sociale-de-stat
http://data.gov.ro/dataset/protectia-persoanelor-cu-dizabilitati
http://data.gov.ro/dataset/informatii-derulare-fonduri-europene-smis
http://data.gov.ro/dataset/buget-sinteza
http://data.gov.ro/dataset/dinamica-cererilor-inregistrate-si-solutionate-cu-admitere-sau-respingere
http://data.gov.ro/dataset/conditii-de-munca
http://data.gov.ro/dataset/achizitii-publice-2016-continuare


http://data.gov.ro/dataset/pndl
http://data.gov.ro/dataset/bilant
http://data.gov.ro/dataset/analize-sectorul-ong
http://data.gov.ro/dataset/ocuparea-somajul-si-protectia-sociala-a-somerilor
http://data.gov.ro/dataset/achizitii-publice-2010-2015-invitatii-de-participare
http://data.gov.ro/dataset/achizitii-publice-2007-2016-contracte6
http://data.gov.ro/dataset/parc-auto-romania ####
http://data.gov.ro/dataset/volumul-datelor-imobilelor-gestionate-la-nivel-uat
http://data.gov.ro/dataset/situatia-platilor-ministerul-justitiei-titlul-65
http://data.gov.ro/dataset/seturi-de-date-privind-invatamantul-profesional-si-tehnic
http://data.gov.ro/dataset/monitorizare-lunara-a-executiei-bugetare-a-spitalelor
http://data.gov.ro/dataset/situatia-farmaciilor-din-romania
http://data.gov.ro/dataset/nomenclator-strazi-judetul-timis
http://data.gov.ro/dataset/situatia-platilor-ministerul-justitiei-titlul-56
http://data.gov.ro/dataset/nomenclator-strazi-judetul-sibiu
http://data.gov.ro/dataset/situatia-platilor-directia-nationala-de-probatiune-titlul-10
http://data.gov.ro/dataset/nomenclator-strazi-judetul-constanta
http://data.gov.ro/dataset/executia-bugetara-a-mcpdc
http://data.gov.ro/dataset/centralizator-achizitii-publice-2016
http://data.gov.ro/dataset/buletinul-contractelor-de-achizitii-publice-ale-departamentului-pentru-armamente-pe-anul-2015
http://data.gov.ro/dataset/regio-2007-2013-stadiul-implementarii-pe-regiuni
http://data.gov.ro/dataset/date-climatologice-de-la-cele-23-de-statii-esentiale-pentru-anul-2016
http://data.gov.ro/dataset/uat-20170921
http://data.gov.ro/dataset/unitati-administrativ-teritoriale-numar-maxim-de-posturi
http://data.gov.ro/dataset/regio-2007-2013-plati
http://data.gov.ro/dataset/firme-inregistrate-la-registrul-comertului-pana-la-data-de-31-octombrie-2016
http://data.gov.ro/dataset/firme-inregistrate-la-registrul-comer-ului-pana-la-data-de-01-februarie-2016
http://data.gov.ro/dataset/firme-inregistrate-la-registrul-comertului-pana-la-data-de-29-iulie-2016



http://data.gov.ro/dataset/df94f502-b4fd-409e-a1d8-4999eb100e35
http://data.gov.ro/dataset/359b876d-8b24-49f4-a2f1-ff1782ca99f9
http://data.gov.ro/dataset/firme-inregistrate-la-registrul-comertului-pana-la-data-de-02-mai-2016
http://data.gov.ro/dataset/7aaf3ea7-662a-43b5-a635-5c72b4754f2a
http://data.gov.ro/dataset/cc8b9f6f-bdac-44f2-a738-115187426d04
http://data.gov.ro/dataset/alegeri_parlamentare_2016
http://data.gov.ro/dataset/c9aa763a-7e9a-453a-8ee9-b84c4cf4339d
http://data.gov.ro/dataset/achizitii-publice-2016
http://data.gov.ro/dataset/e55cb246-1576-4bd6-87f3-5d39811a95ee
http://data.gov.ro/dataset/759a7bf7-b723-485c-918a-e9dc2b53b57a
http://data.gov.ro/dataset/fe8327af-3946-45cc-abe5-76b253104577
http://data.gov.ro/dataset/48aa2ea4-2355-45c2-95af-c8a27b951f64
http://data.gov.ro/dataset/c98c13e4-a905-4ecb-8f81-c9b5ca32a1b5
http://data.gov.ro/dataset/b61d65ab-9b24-4a68-a7e8-16ffaf15fb1b
http://data.gov.ro/dataset/mers-tren-softrans-s-r-l
http://data.gov.ro/dataset/mers-tren-transferoviar-calatori-s-r-l
http://data.gov.ro/dataset/mers-tren-sntfc-cfr-calatori-s-a
http://data.gov.ro/dataset/mers-tren-interregional-calatori
http://data.gov.ro/dataset/situatia-platilor-ministerul-justitiei-titlul-10
http://data.gov.ro/dataset/dinamica-vanzarilor-imobilelor
http://data.gov.ro/dataset/dinamica-ipotecilor-imobilelor-aflate-in-intravilan-sau-extravilan
http://data.gov.ro/dataset/situatia-platilor-ministerul-justitiei-capitolul-68-01
http://data.gov.ro/dataset/situatia-platilor-ministerul-justitiei-titlul-20



"""



