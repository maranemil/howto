------------------------------------------------------------------------------
### Automated Intent Classification Using Deep Learning in Google Sheets
```
https://www.searchenginejournal.com/automated-intent-classification-using-deep-learning-google-sheets/353910/
https://developers.google.com/apps-script
https://github.com/uber/ludwig
https://developers.google.com/apps-script/guides/sheets
https://www.searchenginejournal.com/automated-intent-classification-using-deep-learning-google-sheets/353910/
```
```
Tools > Script Editor

function logKeywords() {
  var sheet = SpreadsheetApp.getActiveSheet();
  var data = sheet.getDataRange().getValues();
  for (var i = 0; i < data.length; i++) {
      console.log('Keyword: ' + data[i][0]);
  }
}


function addIDtoKeywords() {
  var sheet = SpreadsheetApp.getActiveSheet();
  var data = sheet.getRange("B1");
	// data.setValue("Keyword ID");
 	// data.setFontWeight("bold");
  //build value list
  var values = [];
  //number of keywords
  length = 100;
  for (var i = 1; i <= length+1; i++){
    values.push([i]);
  }
  console.log(values.length);
  //Update sheet column with calculated values
  var column = sheet.getRange("B2:B102");
  column.setValues(values);
}


function TranslateKeywords() {
  var sheet = SpreadsheetApp.getActiveSheet();
  var header = sheet.getRange("B1");

  // Add a new header column named Translation
  header.setValue("Translation");
  header.setFontWeight("bold");

  //var keyword = "barcode generator";
  var keyword = sheet.getRange("A2").getValue();
  console.log(keyword);
  translated_keyword = fetchTranslation(keyword);
  console.log(translated_keyword);
  var data = sheet.getRange("B2");
  data.setValue(translated_keyword);
}

%tensorflow_version 1.x

import tensorflow as tf; print(tf.__version__)

!pip install ludwig

#upload Question_Classification_Dataset.csv and 'Question Report_Page 1_Table.csv'
from google.colab import files

files.upload()

import pandas as pd
df = pd.read_csv("Question_Classification_Dataset.csv", index_col=0)

!wget https://storage.googleapis.com/bert_models/2018_10_18/uncased_L-12_H-768_A-12.zip
!unzip uncased_L-12_H-768_A-12.zip

# create the ludwig configuration file for BERT-powered classification
template="""
input_features:
-
name: Questions
type: text
encoder: bert
config_path: uncased_L-12_H-768_A-12/bert_config.json
checkpoint_path: uncased_L-12_H-768_A-12/bert_model.ckpt
preprocessing:
word_tokenizer: bert
word_vocab_file: uncased_L-12_H-768_A-12/vocab.txt
padding_symbol: '[PAD]'
unknown_symbol: '[UNK]'
output_features:
-
name: Category0
type: category
-
name: Category2
type: category
text:
word_sequence_length_limit: 128
training:
batch_size: 32
learning_rate: 0.00002
"""
with open("model_definition.yaml", "w") as f:
    f.write(template)
!pip install bert-tensorflow

!ludwig experiment \
  --data_csv Question_Classification_Dataset.csv\
  --model_definition_file model_definition.yaml


test_df = pd.read_csv("Question Report_Page 1_Table.csv")
#we rename Query to Questions to match what the model expects
predictions = model.predict(test_df.rename(columns={'Query': 'Questions'} ))
test_df.join(predictions)[["Query", "Category2_predictions"]]

!pip install ludwig[serve]
!ludwig serve --help
!ludwig serve -m results/experiment_run/model
%%bash --bg
nohup ludwig serve -m results/experiment_run/model > debug.log 2>&1


!tail debug.log
!curl http://0.0.0.0:8000/predict -X POST -F 'Questions=who is the boss?'
!curl http://api.yourdomain.com/predict -X POST -F 'Questions=who is the boss?'
!curl -s http://localhost:4040/api/tunnels | python3 -c \

    "import sys, json; print(json.load(sys.stdin)['tunnels'][0]['public_url'])"


function fetchPrediction(question = "who is the boss?"){

  TEXT = encodeURI(TEXT);
  console.log(TEXT);
  var url = "http://api.yourdomain.com/predict";
   var options = {
    "method" : "POST",
    "contentType" : "application/x-www-form-urlencoded",
    "payload" : TEXT,
    'muteHttpExceptions': true
  };

  var response = UrlFetchApp.fetch(url, options);
  var json = response.getContentText();
  //console.log(json);
  prediction = JSON.parse(json);
  //console.log(prediction);
  console.log(prediction["Category0_predictions"]);
  return prediction["Category0_predictions"];

}
```
