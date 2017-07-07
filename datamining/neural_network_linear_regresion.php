<?php
/**
 * Created by PhpStorm.
 * User: emil
 * Date: 14.01.17
 * Time: 21:52
 */

// https://gist.github.com/andreiz/4642209

//error_reporting(E_ALL);

define('NUM_FEATURES', 3);

// My dataset describes cities around the world where I might consider living.
// Each sample (city) consists of 3 features:
//  * Feature 1: average low winter temperature in the city
//  * Feature 2: city population, in millions
//  * Feature 3: does the city have an airport I can fly to from USA directly?
//
// The labels (categories) are 1 (yes) and 0 (no).
// All the data is floating-point.

$training = array(
	array(-11., 2.6,  1.),
	array(  8., 0.78, 1.),
	array( 15., 4.2,  0.),
	array(-16., 0.18, 0.),
	array(  3., 1.1,  0.),
	array(  7., 1.4,  1.),
	array( -3., 1.44, 1.),
	array( -7., 0.52, 0.),
	array( 30., 0.82, 1.),
	array( 20., 1.32, 0.),
);

$labels = array(
	0.,
	1.,
	0.,
	0.,
	1.,
	1.,
	1.,
	0.,
	0.,
	1
);

$NUM_SAMPLES = sizeof($training);

// Initialize the weights array to random starting values.
// There are always 1+NUM_FEATURES weights, because the first weight
// does not correspond to a feature value, since:
//   weights * features = weight0 + weight1 * feature1 + weight2 * feature2 + ...
$weights = array();
for ($j=0; $j < NUM_FEATURES+1; $j++)
	$weights[$j] = mt_rand()/mt_getrandmax()*5.0;

// Calculate the data we need for feature scaling (mean/variance)
$scaling = calc_feature_scaling($training);

$learning_rate = 0.05;
$steps = 20000; // number of steps to take for gradient descent

$temp = array(); // temp array to hold updates for weights during the loop
for ($n = 0; $n < $steps; $n++) {

	// For each weight, perform the gradient descent step and save the result to temp
	for ($j = 0; $j < NUM_FEATURES+1; $j++) {
		$sum_m = 0.0;
		for ($i = 0; $i < $NUM_SAMPLES; $i++) {
			$scaled_data = scale($training[$i], $scaling);
			$h = hypothesis($scaled_data, $weights);
			// The first weight has a dummy 1 "feature" value
			$part = ($h - $labels[$i]) * ($j==0 ? 1.0 : $scaled_data[$j-1]);
			$sum_m = $sum_m + $part;
		}
		$temp[$j] = $weights[$j] - $learning_rate * $sum_m/$NUM_SAMPLES;
	}

	$weights = $temp;
}





echo "Executed $n steps\n";
echo "Weights: ", vector_to_str($weights), "\n";

// Validate the results
print "\nValidating training\n";
$correct = 0;
for ($i = 0; $i < $NUM_SAMPLES; $i++) {
	$predict = predict(scale($training[$i], $scaling), $weights);
	printf("<br>Input: %-16s actual: %d, predict: %d", vector_to_str($training[$i]), $labels[$i], $predict);
	if ($labels[$i] != $predict)
		print " - miss";
	print "\n";
	if ($predict == $labels[$i])
		$correct++;
}
printf("<br>Correctness = %.0f%%\n", $correct/$NUM_SAMPLES*100.0);

// Try some predictions
print "\nTesting the model\n";
$test = array(
	array(-1., 1.1, 1.),
	array(23., 0.9, 0.),
	array( 4., 1.9, 0.),
	array(-14., 1.1, 1.),
);
for ($i = 0; $i < sizeof($test); $i++) {
	$predict = predict(scale($test[$i], $scaling), $weights);
	printf("<br>Input: %-16s predict: %d\n", vector_to_str($test[$i]), $predict);
}







function hypothesis($x, $weights)
{
	$score = $weights[0]; // free weight
	$k = sizeof($x);
	// Calculate dot product
	for ($i = 0; $i < $k; $i++)
		$score += $weights[$i+1] * $x[$i];
	// Run through the sigmoid (logistic) function
	return 1.0/(1.0 + exp(-$score));
}

function predict($input, $weights)
{
	$output = hypothesis($input, $weights);
	// Threshold on 0.5
	if ($output >= 0.50)
		$predict = 1;
	else
		$predict = 0;
	return $predict;
}

function scale($input, $scaling)
{
	foreach ($input as $f => &$value) {
		$value = ($value - $scaling['mean'][$f]) /
			$scaling['variance'][$f];
	}
	return $input;
}

function calc_feature_scaling($data)
{
	$mins = array_fill(0, NUM_FEATURES, INF);
	$maxs = array_fill(0, NUM_FEATURES, -INF);
	$sums = array_fill(0, NUM_FEATURES, 0);
	$scaling = array('mean' => array(),
		'variance' => array());
	$N = sizeof($data);
	foreach ($data as $i => $row) {
		foreach ($row as $f => $value) {
			if ($value > $maxs[$f])
				$maxs[$f] = $value;
			if ($value < $mins[$f])
				$mins[$f] = $value;
			$sums[$f] += $value;
		}
	}

	for ($f = 0; $f < NUM_FEATURES; $f++) {
		$scaling['mean'][$f] = $sums[$f] / $N;
		$scaling['variance'][$f] = $maxs[$f] - $mins[$f];
		if ($scaling['variance'][$f] == 0)
			throw new Exception("Feature #$f has the same value in all the samples, invalid data");
	}

	return $scaling;
}

function vector_to_str($x)
{
	return '['.implode(", ", $x).']';
}