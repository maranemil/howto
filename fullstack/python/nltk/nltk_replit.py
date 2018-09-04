#!/usr/bin/env python
# coding=UTF-8
# # https://repl.it/

import fullstack.python.nltk, re
from fullstack.python.nltk import word_tokenize
fullstack.python.nltk.download('punkt')
fullstack.python.nltk.download('stopwords')
import sys
import codecs
import fullstack.python.nltk
from fullstack.python.nltk.corpus import stopwords

# NLTK's default German stopwords
#default_stopwords = set(nltk.corpus.stopwords.words('english'))
default_stopwords = set(stopwords.words('english'))

sentence = "The Italian far-right interior minister, Matteo Salvini, will meet the former British prime minister Tony Blair in Rome to discuss controversial plans to extend a gas pipeline that will run from Azerbaijan to Puglia in southern Italy."
tokens = fullstack.python.nltk.word_tokenize(sentence)
print (tokens)


fdist = fullstack.python.nltk.FreqDist(ch.lower() for ch in tokens if ch.isalpha())
print (fdist.most_common(5))
#[char for (char, count) in fdist.most_common()]

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
fdist = fullstack.python.nltk.FreqDist(words)