<?php

/*
Phpml

https://php-ml.readthedocs.io/en/latest/math/distance/
https://php-ml.readthedocs.io/en/latest/machine-learning/classification/naive-bayes/
https://php-ml.readthedocs.io/en/latest/machine-learning/datasets/array-dataset/
https://php-ml.readthedocs.io/en/latest/math/matrix/
https://php-ml.readthedocs.io/en/latest/math/statistic/

http://yann.lecun.com/exdb/mnist/
http://yann.lecun.com/exdb/mnist/train-images-idx3-ubyte.gz
http://yann.lecun.com/exdb/mnist/train-labels-idx1-ubyte.gz
http://yann.lecun.com/exdb/mnist/t10k-images-idx3-ubyte.gz
http://yann.lecun.com/exdb/mnist/t10k-labels-idx1-ubyte.gz

https://github.com/php-ai/php-ml
https://packagist.org/packages/php-ai/php-ml
https://github.com/amacgregor/phpml-exercise
https://libraries.io/packagist/php-ai%2Fphp-ml
https://devhub.io/repos/php-ai-php-ml

http://www.inf.u-szeged.hu/~ormandi/ai2/06-naiveBayes-example.pdf
https://github.com/amacgregor/phpml-exercise/blob/master/classifyTweets.php

https://github.com/php-ai/php-ml
https://php-ml.readthedocs.io/en/latest/
https://imasters.com/development/machine-learning-php-php-ml/?trace=1519021197&source=single
https://www.sitepoint.com/how-to-analyze-tweet-sentiments-with-php-machine-learning/
https://riptutorial.com/php/example/19397/classification-using-php-ml
https://arkadiuszkondas.com/text-data-classification-with-bbc-news-article-dataset/
http://mlg.ucd.ie/datasets/bbc.html
https://scikit-learn.org/stable/modules/generated/sklearn.feature_extraction.text.TfidfTransformer.html

twitter dataset
http://cs.stanford.edu/people/alecmgo/trainingandtestdata.zip
bbc
http://mlg.ucd.ie/datasets/bbc.html
http://mlg.ucd.ie/files/datasets/bbc.zip

https://medium.com/@himanshu_23732/sentiment-analysis-with-sentiment140-e6b0c789e0ce
http://help.sentiment140.com/for-students/
https://github.com/ClimbsRocks/nlpSentiment
https://www.geeksforgeeks.org/twitter-sentiment-analysis-using-python/
https://towardsdatascience.com/another-twitter-sentiment-analysis-bb5b01ebad90


*/


// -----------------------------------------------------
// Phpml Install
// -----------------------------------------------------

/*
mkdir aitest && cd aitest
composer require php-ai/php-ml
*/

// -----------------------------------------------------
// Import Datasets
// -----------------------------------------------------


use Phpml\Dataset\MnistDataset;

$trainDataset = new MnistDataset('train-images-idx3-ubyte', 'train-labels-idx1-ubyte');
$dataset->getSamples();
$dataset->getTargets();

use Phpml\Dataset\Demo\IrisDataset;

$dataset = new IrisDataset();

use Phpml\Dataset\Demo\WineDataset;

$dataset = new WineDataset();

use Phpml\Dataset\Demo\GlassDataset;

$dataset = new GlassDataset();

$dataset = new CsvDataset('dataset.csv', 2, true);

use Phpml\Dataset\FilesDataset;

$dataset = new FilesDataset('path/to/data');
$dataset->getSamples()[0][0];  // content from file path/to/data/business/001.txt
$dataset->getTargets()[0];     // business
$dataset->getSamples()[40][0]; // content from file path/to/data/tech/001.txt
$dataset->getTargets()[0];     // tech

// -----------------------------------------------------
// NaiveBayes Classifier
// -----------------------------------------------------
$samples = [[5, 1, 1], [1, 5, 1], [1, 1, 5]];
$labels = ['a', 'b', 'c'];
$classifier = new NaiveBayes();
$classifier->train($samples, $labels);
$classifier->predict([3, 1, 1]);
// return 'a'
$classifier->predict([[3, 1, 1], [1, 4, 1]]);
// return ['a', 'b']


// -----------------------------------------------------
// KNearestNeighbors Classifier
// -----------------------------------------------------
use Phpml\Classification\KNearestNeighbors;
use Phpml\ModelManager;

$samples = [[1, 3], [1, 4], [2, 4], [3, 1], [4, 1], [4, 2]];
$labels = ['a', 'a', 'a', 'b', 'b', 'b'];
$classifier = new KNearestNeighbors();
$classifier->train($samples, $labels);
$filepath = '/path/to/store/the/model';
$modelManager = new ModelManager();
$modelManager->saveToFile($classifier, $filepath);
$restoredClassifier = $modelManager->restoreFromFile($filepath);
$restoredClassifier->predict([3, 2]);
// return 'b'


// -----------------------------------------------------
// NeuralNetwork Classifier
// -----------------------------------------------------
use Phpml\Classification\MLPClassifier;

$mlp = new MLPClassifier(4, [2], ['a', 'b', 'c']);

// 4 nodes in input layer, 2 nodes in first hidden layer and 3 possible labels.
use Phpml\NeuralNetwork\ActivationFunction\PReLU;
use Phpml\NeuralNetwork\ActivationFunction\Sigmoid;

$mlp = new MLPClassifier(4, [[2, new PReLU], [2, new Sigmoid]], ['a', 'b', 'c']);

use Phpml\NeuralNetwork\Layer;
use Phpml\NeuralNetwork\Node\Neuron;

$layer1 = new Layer(2, Neuron::class, new PReLU);
$layer2 = new Layer(2, Neuron::class, new Sigmoid);
$mlp = new MLPClassifier(4, [$layer1, $layer2], ['a', 'b', 'c']);
$mlp->train(
    $samples = [[1, 0, 0, 0], [0, 1, 1, 0], [1, 1, 1, 1], [0, 0, 0, 0]],
    $targets = ['a', 'a', 'b', 'c']
);
$mlp->partialTrain(
    $samples = [[1, 0, 0, 0], [0, 1, 1, 0]],
    $targets = ['a', 'a']
);
$mlp->partialTrain(
    $samples = [[1, 1, 1, 1], [0, 0, 0, 0]],
    $targets = ['b', 'c']
);
$mlp->setLearningRate(0.1);
$mlp->predict([[1, 1, 1, 1], [0, 0, 0, 0]]);
// return ['b', 'c'];


// -----------------------------------------------------
// RandomSplit
// -----------------------------------------------------
$randomSplit = new RandomSplit($dataset, 0.2);
$dataset = new RandomSplit($dataset, 0.3, 1234);
// train group
$dataset->getTrainSamples();
$dataset->getTrainLabels();
// test group
$dataset->getTestSamples();
$dataset->getTestLabels();


// -----------------------------------------------------
// transform string data csv to array
// -----------------------------------------------------
#declare(strict_types=1);
namespace \PhpmlExamples;

include 'vendor/autoload.php';

use Phpml\Dataset\CsvDataset;
use Phpml\Dataset\ArrayDataset;
use Phpml\FeatureExtraction\TokenCountVectorizer;
use Phpml\Tokenization\WordTokenizer;
use Phpml\CrossValidation\StratifiedRandomSplit;
use Phpml\FeatureExtraction\TfIdfTransformer;
use Phpml\Metric\Accuracy;
use Phpml\Classification\SVC;
use Phpml\SupportVectorMachine\Kernel;

$dataset = new CsvDataset('data/languages.csv', 1);
$vectorizer = new TokenCountVectorizer(new WordTokenizer());
$tfIdfTransformer = new TfIdfTransformer();
$samples = [];
foreach ($dataset->getSamples() as $sample) {
    $samples[] = $sample[0];
}

$vectorizer->fit($samples);
$vectorizer->transform($samples);
$tfIdfTransformer->fit($samples);
$tfIdfTransformer->transform($samples);
$dataset = new ArrayDataset($samples, $dataset->getTargets());
$randomSplit = new StratifiedRandomSplit($dataset, 0.1);
$classifier = new SVC(Kernel::RBF, 10000);
$classifier->train($randomSplit->getTrainSamples(), $randomSplit->getTrainLabels());
$predictedLabels = $classifier->predict($randomSplit->getTestSamples());
echo 'Accuracy: ' . Accuracy::score($randomSplit->getTestLabels(), $predictedLabels);