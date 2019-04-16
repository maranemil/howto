#!/usr/bin/env python
# coding=UTF-8
# # https://repl.it/
# pip3 install -U nltk

"""
https://www.nltk.org/book/ch01.html
https://www.nltk.org/book/ch01.html
"""

import nltk, re
from nltk import word_tokenize
nltk.download('punkt')
nltk.download('stopwords')

import sys
import codecs
import nltk
from nltk.corpus import stopwords
import numpy as np
import csv
import pandas as pd

# NLTK's default German stopwords
#default_stopwords = set(nltk.corpus.stopwords.words('english'))
default_stopwords = set(stopwords.words('english'))

#sentence = "The Italian far-right interior minister, Matteo Salvini, will meet the former British prime minister Tony Blair in Rome to discuss controversial plans to extend a gas pipeline that will run from Azerbaijan to Puglia in southern Italy."
list = pd.read_csv("test.csv")
sentence = ''
with open('test.csv', 'rb') as csvfile:
    sentence = str(csvfile.read()).replace('\\n', ' ')
#file = open("test.csv")
#data = file.read()
#print(sentence)
print ("Length Text: " + str(len(sentence)))
print ("Lexical diversity: " + str(  len(set(sentence)) / len(sentence)) )


print("--------------------------------------------")
tokens = nltk.word_tokenize(sentence)
print (tokens[:6])
print("------------TOP 50--------------------------------")
fdist = nltk.FreqDist(ch.lower() for ch in tokens if ch.isalpha())
print (fdist.most_common(50))
print("------------TOP 50 > LEN 5 -----------------------")
[char for (char, count) in fdist.most_common()]
# Remove single-character tokens (mostly punctuation)
words = [word for word in tokens if len(word) > 5]
# Remove numbers
words = [word for word in words if not word.isnumeric()]
# Lowercase all words (default_stopwords are lowercase too)
words = [word.lower() for word in words]
# Stemming words seems to make matters worse, disabled
# stemmer = nltk.stem.snowball.SnowballStemmer('german')
# words = [stemmer.stem(word) for word in words]
# Remove stopwords
words = [word for word in words if word not in default_stopwords]
# Calculate frequency distribution
fdist2 = nltk.FreqDist(words)
print (fdist2.most_common(50))
fdist.plot(30) # cumulative=True

print("-------------- LEN 10 ----------------------------")
V = set(words)
long_words = [w for w in V if len(w) > 10]
print(sorted(long_words))
"""
print("--------------- LEN 7 ----------------------------")
fdist5 = nltk.FreqDist(words)
output5 = sorted(w for w in set(words) if len(w) > 7 and fdist5[w] > 7)
print(output5)
"""
print("--------------------------------------------------")
print("Total samples: "+ str(fdist.N()))
#print("--------------------------------------------------")
#print(fdist.max())
#print(fdist.tabulate())



