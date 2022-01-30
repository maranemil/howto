<?php /** @noinspection DuplicatedCode */
/** @noinspection PhpUnused */
/*
----------------------------------------------------------------------------------

https://richardathome.wordpress.com/2006/01/25/a-php-linear-regression-function/
https://github.com/mcordingley/Regression
http://php.net/manual/en/function.trader-linearreg-slope.php
https://php-ml.readthedocs.io/en/latest/machine-learning/regression/least-squares/
https://halfelf.org/2017/linear-regressions-php/
https://github.com/carbocation/PHP-Multivariate-Regression
https://mnshankar.wordpress.com/2011/05/01/regression-analysis-using-php/
http://polynomialregression.drque.net/
https://github.com/robotomize/regression-php
https://github.com/mnshankar/linear-regression

http://daynebatten.com/2015/06/random-forest-web-service-php/
https://gist.github.com/daynebatten/ae97118078ab1e80cb7e


https://medium.freecodecamp.org/data-science-with-python-8-ways-to-do-linear-regression-and-measure-their-speed-b5577d75f8b
https://bigdata-madesimple.com/how-to-run-linear-regression-in-python-scikit-learn/
https://towardsdatascience.com/simple-and-multiple-linear-regression-in-python-c928425168f9
https://jakevdp.github.io/PythonDataScienceHandbook/05.06-linear-regression.html ###########
http://devarea.com/python-machine-learning-example-linear-regression/ ###########
https://www.geeksforgeeks.org/linear-regression-python-implementation/ ###########
https://stackabuse.com/linear-regression-in-python-with-scikit-learn/ ##########
*/


//independent variables.
$x = array(1, 2, 3, 4, 5, 6, 7, 8, 9);
//dependent variables
$y = array(4.5, 22.5, 2, 0.5, 18, 2, 32, 4.5, 40.5);


/**
 * linear regression function
 * @param $x array x-coords
 * @param $y array y-coords
 * @returns array() m=>slope, b=>intercept
 */
function linear_regression(array $x, array $y): array
{

    // calculate number points
    $n = count($x);
    // ensure both arrays of points are the same size
    if ($n !== count($y)) {
        trigger_error("linear_regression(): Number of elements in coordinate arrays do not match.", E_USER_ERROR);

    }
    // calculate sums
    $x_sum = array_sum($x);
    $y_sum = array_sum($y);
    $xx_sum = 0;
    $xy_sum = 0;
    for ($i = 0; $i < $n; $i++) {
        $xy_sum += ($x[$i] * $y[$i]);
        $xx_sum += ($x[$i] * $x[$i]);
    }

    // calculate slope
    $m = (($n * $xy_sum) - ($x_sum * $y_sum)) / (($n * $xx_sum) - ($x_sum * $x_sum));
    // calculate intercept
    $b = ($y_sum - ($m * $x_sum)) / $n;
    // return result
    return array("m" => $m, "b" => $b);

}

#var_dump(linear_regression(array(1, 2, 3, 4), array(1.5, 1.6, 2.1, 3.0)));
#echo "<br>";

function linear_regression_fc($x, $y): array
{

    $n = count($x);     // number of items in the array
    $x_sum = array_sum($x); // sum of all X values
    $y_sum = array_sum($y); // sum of all Y values
    $xx_sum = 0;
    $xy_sum = 0;
    for ($i = 0; $i < $n; $i++) {
        $xy_sum += ($x[$i] * $y[$i]);
        $xx_sum += ($x[$i] * $x[$i]);
    }

    // Slope
    $slope = (($n * $xy_sum) - ($x_sum * $y_sum)) / (($n * $xx_sum) - ($x_sum * $x_sum));
    // calculate intercept
    $intercept = ($y_sum - ($slope * $x_sum)) / $n;
    return array(
        'slope' => round($slope, 2),
        'intercept' => round($intercept, 2),
    );
}


#var_dump(linear_regression_fc($x, $y));






