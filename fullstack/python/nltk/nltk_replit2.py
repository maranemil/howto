#!/usr/bin/env python
# coding=UTF-8
# # https://repl.it/

import re, nltk, sys
from nltk import word_tokenize

nltk.download('punkt')
nltk.download('stopwords')
from nltk.corpus import stopwords
from nltk.probability import ConditionalFreqDist

# NLTK's stopwords
default_stopwords = set(stopwords.words('romanian'))

sentence = "Primarul general al Capitalei, Gabriela Firea, l-a acuzat, marţi seara, pe Liviu Dragnea, că în şedinţele de partid este lapte şi miere, dar se schimbă total în întâlnirile cu câţiva apropiaţi, făcând referire la episoadele Grindeanu şi Tudose. Şi acum dl Dragnea zâmbeşte şi ocoleşte adevărul foarte frumos, pentru că niciodată nu ne confruntă direct, ci totul este ”lapte şi miere” în întâlniri şi în şedinţe, dar în subterane şi în întâlnirile pe care le are cu doar câţiva apropiaţi, deciziile sunt cu totul altele. Atunci, la episodul Grindeanu, cât şi la episodul Tudose, eu am pornit de la durerea bucureştenilor, precum şi a tuturor românilor care vin în Bucureşti. De fiecare dată dl Dragnea îmi spunea că el este de acord, din punct de vedere politic, cu toate acele proiecte, dar nu sunt de acord, întâi dl.Grindeanu şi apoi dl. Tudose. Atunci, pe bună dreptate, eu semnalam public faptul că guvernul nu ajută bucureştenii”, a declarat Gabriela Firea la TVR1. Gabriela Firea consideră că o retragere de la conducerea partidului ar fi benefică, dacă Liviu Dragnea nu îşi schimbă modul de lucru. ”Din punctul meu de vedere (ar trebui să se retragă-n.r.). Ori schimbă modul de lucru şi renunţă la a se mai consulta doar cu două-trei persoane, multe care nici nu fac parte din guvern. Deci ori schimbă total modul de lucru, dar nu cred că poate să lucreze în acest sens, pentru că ar fi făcut-o... Dacă poate, ar fi minunat. Dacă nu, cred că o retragere ar fi benefică pentru partid şi pentru ţară, pentru că noi suntem cel mai mare partid politic şi ar fi benefic pentru ţară”, a declarat Gabriela Firea la TVR."

tokens = nltk.word_tokenize(sentence)
# print (tokens)
fdist = nltk.FreqDist(ch.lower() for ch in tokens if ch.isalpha())
# print("\n Get all word lengths and their count of occurence")
# fdist.items()

# http://nikhedonia.com/frequency-analysis-using-ntlk/
print("\n How many words in the text? " + str(fdist.N()) + "")
print("\n All the words in the text? " + str(fdist.keys()) + "")
print("\n How many occurrences of a word? " + str(fdist['gabriela']) + "")
print("\n Frequency of a word? " + str(fdist.freq('gabriela')) + "")
print("\n Most frequent word? " + str(fdist.max()) + "")

# print("\n Plot the frequencies?")
# fdist.plot() # Plots word + frequency
# fdist.plot(cumulative=True) # Plots word + cumulative freq.

long_words = [w for w in sentence if len(w) == 5]
print("\n Words of a certain length?" + str(long_words))

words = [w for w in fdist.keys() if len(w) > 5 and fdist[w] > 5]
print("\n Common long words?" + str(words))

words = [(w, fdist[w]) for w in fdist.keys() if len(w) > 5 and fdist[w] > 5]
print("\n Long words and their frequencies?" + str(words))

words_only = [w for w in sentence if w.isalpha()]
unique = set([w.lower() for w in words_only])
word_count = len(unique)
print("\n Unique words?" + str(word_count))

# words.dispersion_plot(["firea", "liviu", "dragnea"])
# print (fdist.most_common(5))
# [char for (char, count) in fdist.most_common()]

# Remove single-character tokens (mostly punctuation)
words = [word for word in tokens if len(word) > 3]
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
fdist = nltk.FreqDist(words)
print ("\n")
print (fdist.most_common(15))

# cfdist = ConditionalFreqDist()
# for word in word_tokenize(sentence):
#  condition = len(word)
#  cfdist[condition][word] += 1
cfdist = nltk.ConditionalFreqDist((len(word), word) for word in word_tokenize(sentence))
# print ("\n")
print (cfdist)
# print ("\n")
print (cfdist[3])
# print ("\n")
print (cfdist[3].freq('cel'))

"""

Python 3.6.1 (default, Dec 2015, 13:05:11)
[GCC 4.8.2] on linux

[nltk_data] Downloading package punkt to /home/runner/nltk_data...
[nltk_data]   Package punkt is already up-to-date!
[nltk_data] Downloading package stopwords to /home/runner/nltk_data...
[nltk_data]   Package stopwords is already up-to-date!

 How many words in the text? 273

 All the words in the text? dict_keys(['primarul', 'general', 'al', 'capitalei', 'gabriela', 'firea', 'acuzat', 'marţi', 'seara', 'pe', 'liviu', 'dragnea', 'că', 'în', 'şedinţele', 'de', 'partid', 'este', 'lapte', 'şi', 'miere', 'dar', 'se', 'schimbă', 'total', 'întâlnirile', 'cu', 'câţiva', 'apropiaţi', 'făcând', 'referire', 'la', 'episoadele', 'grindeanu', 'tudose', 'acum', 'dl', 'zâmbeşte', 'ocoleşte', 'adevărul', 'foarte', 'frumos', 'pentru', 'niciodată', 'nu', 'ne', 'confruntă', 'direct', 'ci', 'totul', 'întâlniri', 'şedinţe', 'subterane', 'care', 'le', 'are', 'doar', 'deciziile', 'sunt', 'altele', 'atunci', 'episodul', 'cât', 'eu', 'am', 'pornit', 'durerea', 'bucureştenilor', 'precum', 'a', 'tuturor', 'românilor', 'vin', 'bucureşti', 'fiecare', 'dată', 'îmi', 'spunea', 'el', 'acord', 'din', 'punct', 'vedere', 'politic', 'toate', 'acele', 'proiecte', 'întâi', 'apoi', 'bună', 'dreptate', 'semnalam', 'public', 'faptul', 'guvernul', 'ajută', 'bucureştenii', 'declarat', 'consideră', 'o', 'retragere', 'conducerea', 'partidului', 'ar', 'fi', 'benefică', 'dacă', 'îşi', 'modul', 'lucru', 'punctul', 'meu', 'trebui', 'să', 'ori', 'renunţă', 'mai', 'consulta', 'persoane', 'multe', 'nici', 'fac', 'parte', 'guvern', 'deci', 'cred', 'poate', 'lucreze', 'acest', 'sens', 'minunat', 'ţară', 'noi', 'suntem', 'cel', 'mare', 'benefic', 'tvr'])

 How many occurrences of a word? 4

 Frequency of a word? 0.014652014652014652

 Most frequent word? şi

 Words of a certain length?[]

 Common long words?['pentru']

 Long words and their frequencies?[('pentru', 6)]

 Unique words?26


[('gabriela', 4), ('firea', 4), ('dragnea', 4), ('schimbă', 4), ('partid', 3), ('tudose', 3), ('modul', 3), ('lucru', 3), ('liviu', 2), ('lapte', 2), ('miere', 2), ('total', 2), ('întâlnirile', 2), ('câţiva', 2), ('apropiaţi', 2)]
<ConditionalFreqDist with 13 conditions>
<FreqDist with 18 samples and 23 outcomes>
0.043478260869565216

"""