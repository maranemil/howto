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
$dataset->getSamples()[0][0]  // content from file path/to/data/business/001.txt
$dataset->getTargets()[0]     // business
$dataset->getSamples()[40][0] // content from file path/to/data/tech/001.txt
$dataset->getTargets()[0]     // tech

// -----------------------------------------------------
// NaiveBayes Classifier
// -----------------------------------------------------
$samples = [[5, 1, 1], [1, 5, 1], [1, 1, 5]];
$labels = ['a', 'b', 'c'];
$classifier = new NaiveBayes();
$classifier->train($samples, $labels);
$classifier->predict([3, 1, 1]);
// return 'a'
$classifier->predict([[3, 1, 1], [1, 4, 1]);
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

