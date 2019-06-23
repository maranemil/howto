##############################################################################
#
#   CNN Flatten Operation Visualized - Tensor Batch Processing for Deep Learning
#   https://pytorch.org/docs/stable/tensors.html
#   -------------------------------------------------------------------------
#   Natural Language Processing (Spyder IDE)
#   https://www.youtube.com/watch?v=6ZVf1jnEKGI&list=PLZoTAELRMXVMdJ5sqbCK2LiM0HhQVWNzm
#
##############################################################################

#import nltk
#paragraph = "some text here"
#sentences = nltk.sent_tokenize(paragraph)
#words = nltk.word_tokenize(paragraph)

#---------------------------------
# Stemming
#---------------------------------

import nltk
from nltk.stem import PorterStemmer
from nltk.corpus import stopwords
paragraph = "some text here"
sentences = nltk.sent_tokenize(paragraph)
stemmer = PorterStemmer()
for i in range(len(sentences)):
	words = nltk.word_tokenize(sentences[i])
	words = [stemmer.stem(word) for word in words if word not in set(stopwords.words('english'))]
	sentences[i] = ' '.join(words)

#---------------------------------
# Lemmatization
#---------------------------------

import nltk
from nltk.stem import WordNetLemmatizer
from nltk.corpus import stopwords
sentences = nltk.sent_tokenize(paragraph)
lemmantizer = WordNetLemmatizer()
for i in range(len(sentences)):
	words = nltk.word_tokenize(sentences[i])
	words = [lemmantizer.lemmantize(word) for word in words if word not in set(stopwords.words('english'))]
	sentences[i] = ' '.join(words)

#---------------------------------
# BagofWords
#---------------------------------
"""
import nltk
from nltk.stem import WordNetLemmatizer
from nltk.stem import PorterStemmer
from nltk.corpus import stopwords
import re

ps = PorterStemmer()
wordnet = WordNetLemmatizer()
sentences = nltk.sent_tokenize(paragraph)
corpus = []
for i in range(len(sentences)):
	review = re.sub('[^a-zA-Z]',' ', sentences[i])
	review = review.lower()
	review = review.split()
	review2 = [ps.stem(word) for word in review if not in set(stopwords.words('english')) ]
	review2 = ' '.join(review2)
	corpus.append(review2)

from sklearn.feature_extraction_text import CountVectorizer
cv =  CountVectorizer(max_features = 1500)
X = cv.fit_transform(corpus).toarray()
"""

#---------------------------------
# TF-IDF for Machine Learning
#---------------------------------
"""
import nltk
from nltk.stem import WordNetLemmatizer
from nltk.stem import PorterStemmer
from nltk.corpus import stopwords
import re

ps = PorterStemmer()
wordnet = WordNetLemmatizer()
sentences = nltk.sent_tokenize(paragraph)
corpus = []
for i in range(len(sentences)):
	review = re.sub('[^a-zA-Z]',' ', sentences[i])
	review = review.lower()
	review = review.split()
	review2 = [wordnet.lemmantize(word) for word in review if not in set(stopwords.words('english')) ]
	review2 = ' '.join(review2)
	corpus.append(review2)

from sklearn.feature_extraction_text import TfidVectorizer
cv =  TfidVectorizer()
X = cv.fit_transform(corpus).toarray()
"""
