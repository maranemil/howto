
# Spam Filter

"""
https://archive.ics.uci.edu/ml/datasets/sms+spam+collection
https://www.kaggle.com/ishansoni/sms-spam-collection-dataset
https://www.kaggle.com/uciml/sms-spam-collection-dataset
https://gist.github.com/mydpy/5fb434b1014a6039502faa1e6b6e1d05
https://github.com/mohitgupta-omg/Kaggle-SMS-Spam-Collection-Dataset-
https://etav.github.io/projects/spam_message_classifier_naive_bayes.html
https://www.kdnuggets.com/2011/06/sms-spam-collection-data.html

"""


import pandas as pd
# Dataset from - https://archive.ics.uci.edu/ml/datasets/SMS+Spam+Collection
df = pd.read_table('smsspamcollection/SMSSpamCollection',
                   sep='\t',
                   header=None,
                   names=['label', 'sms_message'])

df.head()
# Map applies a function to all the items in an input list or df column.
df['label'] = df.label.map({'ham' :0, 'spam' :1})
df.head()

import string  # punctuation
import pprint
from collections import Counter  # frequencies

# Bag of Words from scratch
documents = ['Hello, how are you!',
             'Win money, win from home.',
             'Call me now.',
             'Hello, Call hello you tomorrow?']

lower_case_documents = []

for i in documents:
    lower_case_documents.append(i.lower())
print "lower case:", lower_case_documents

# Remove punctuation.
sans_punctuation_documents = []

for i in lower_case_documents:
    sans_punctuation_documents = ["".join( j for j in i if j not in string.punctuation) for i in  lower_case_documents]
print"no punctuation:", (sans_punctuation_documents)

# Break each word
preprocessed_documents = []

for i in sans_punctuation_documents:
    preprocessed_documents.append(i.split(' '))  # split on space
print "break words:", (preprocessed_documents)

# Count frequency of words using counter
frequency_list = []

for i in preprocessed_documents:
    frequency_counts = Counter(i)
    frequency_list.append(frequency_counts)
print "tokenized counts:", pprint.pprint(frequency_list)

from sklearn.feature_extraction.text import CountVectorizer
count_vector = CountVectorizer()  # set the variable

count_vector.fit(documents)  # fit the function
count_vector.get_feature_names()  # get the outputs
doc_array = count_vector.transform(documents).toarray()
#doc_array
frequency_matrix = pd.DataFrame(doc_array,
                                columns = count_vector.get_feature_names()
                                )
#frequency_matrix

from sklearn.model_selection import train_test_split
X_train, X_test, y_train, y_test = train_test_split(df['sms_message'],
                                                    df['label'],
                                                    random_state=1)

print "Our original set contains", df.shape[0], "observations"
print "Our training set contains", X_train.shape[0], "observations"
print "Our testing set contains", X_test.shape[0], "observations"

train = count_vector.fit_transform(X_train)
test = count_vector.transform(X_test)

# performing calculations:
p_hiv = .015  # P(HIV) assuming 1.5% of the population has HIV
p_no_hiv = .98 # P(~HIV)
p_positive_hiv = .95  # sensitivity
p_negative_hiv = .95  # specificity
# P(Positive)
p_positive = (p_hiv * p_positive_hiv) + (p_no_hiv * ( 1 -p_negative_hiv))
print "The probability of getting a positive test result is:", p_positive, "this is our prior"
# P(HIV | Positive)
p_hiv_positive = (p_hiv * p_positive_hiv) / p_positive
print "The probability of a person having HIV, given a positive test result is:", p_hiv_positive
# P(~HIV | Positive)
p_positive_no_hiv = 1 - p_positive_hiv
p_no_hiv_positive = (p_no_hiv * p_positive_no_hiv) / p_positive
print "The probability of an individual not having HIV given getting a positive test result is:", p_no_hiv_positive
posterior_sum = p_no_hiv_positive + p_hiv_positive
#posterior_sum  # sum to 1, looks good!



# 5.1 Naive Bayes Classifier using Scikit-Learn

from sklearn.naive_bayes import MultinomialNB
naive_bayes = MultinomialNB()  # call the method
naive_bayes.fit(train, y_train)  # train the classifier on the training set
MultinomialNB(alpha=1.0, class_prior=None, fit_prior=True)
predictions = naive_bayes.predict(test)  # predic using the model on the testing set

# 6.1 Evaluating the Model

from sklearn.metrics import accuracy_score, precision_score ,f1_score
print('accuracy score: ') ,format(accuracy_score(y_test ,predictions))
print('precision score: ') ,format(precision_score(y_test ,predictions))









# Implementing a Spam classifier in python| Natural Language Processing
# https://github.com/krishnaik06/SpamClassifier

# importing the Dataset

import pandas as pd

messages = pd.read_csv('smsspamcollection/SMSSpamCollection', sep='\t',
                       names=["label", "message"])

# Data cleaning and preprocessing
import re
import nltk
nltk.download('stopwords')

from nltk.corpus import stopwords
from nltk.stem.porter import PorterStemmer
ps = PorterStemmer()
corpus = []
for i in range(0, len(messages)):
    review = re.sub('[^a-zA-Z]', ' ', messages['message'][i])
    review = review.lower()
    review = review.split()

    review = [ps.stem(word) for word in review if not word in stopwords.words('english')]
    review = ' '.join(review)
    corpus.append(review)


# Creating the Bag of Words model
from sklearn.feature_extraction.text import CountVectorizer
cv = CountVectorizer(max_features=2500)
X = cv.fit_transform(corpus).toarray(). y=p. d.get_dummies(messages['label'])
y= y .iloc[:,1 ].values

# Train Test Split
from sklearn.model_selection import train_test_split
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size =0.20, random_state = 0)

# Training model using Naive bayes classifier

from sklearn.naive_bayes import MultinomialNB
spam_detect_model = MultinomialNB().fit(X_train, y_train)
y_pred = spam_detect_model.predict(X_test)

