<?php /** @noinspection PhpUndefinedFunctionInspection */
/** @noinspection PhpUndefinedClassInspection */
/** @noinspection PhpUndefinedNamespaceInspection */

###################################################
#
#	Elasticsearch PHP PYTHON
#
###################################################

/*
https://www.elastic.co/downloads/elasticsearch
https://artifacts.elastic.co/downloads/elasticsearch/elasticsearch-6.6.2.deb

https://github.com/elastic/elasticsearch
https://elasticsearch-py.readthedocs.io/en/master/
https://elasticsearch-py.readthedocs.io/en/0.4.3/
https://www.web-development-blog.com/archives/using-elasticsearch-with-php/
https://github.com/elastic/elasticsearch-php

https://www.elastic.co/de/blog/elastic-stack-6-6-0-released?elektra=products&storm=main
https://www.elastic.co/guide/en/elasticsearch/guide/current/running-elasticsearch.html
https://www.elastic.co/guide/en/elasticsearch/reference/2.1/setup-service.html

*/

/*
# Installation via Composer

Elasticsearch-PHP Branch	PHP Version
6.0							>= 7.0.0
5.0							>= 5.6.6
2.0							>= 5.4.0
0.4, 1.0					>= 5.3.9

############# version 6 #############################################

// elasticsearch/elasticsearch/composer.json

{
    "require": {
        "elasticsearch/elasticsearch": "~6.0"
    }
}
curl -s http://getcomposer.org/installer | php
php composer.phar install
*/

# ----------------------------
# Connect
# ----------------------------

use Elasticsearch\ClientBuilder;

require 'vendor/autoload.php';
$client = ClientBuilder::create()->build();

# ----------------------------
# Add to index
# ----------------------------
$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id',
    'body' => ['testField' => 'abc']
];

$response = $client->index($params);
#print_r($response);

# ----------------------------
# Get
# ----------------------------

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id'
];

$response = $client->get($params);
#print_r($response);

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id'
];

$source = $client->getSource($params);
doSomething($source);

# ----------------------------
# Search for a document
# ----------------------------
$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'body' => [
        'query' => [
            'match' => [
                'testField' => 'abc'
            ]
        ]
    ]
];

$response = $client->search($params);
#print_r($response);


# ----------------------------
# Delete a document
# ----------------------------

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id'
];

$response = $client->delete($params);
#print_r($response);

# ----------------------------
# Delete an index
# ----------------------------

$deleteParams = [
    'index' => 'my_index'
];
$response = $client->indices()->delete($deleteParams);
#print_r($response);

# ----------------------------
# Create an index
# ----------------------------

$params = [
    'index' => 'my_index',
    'body' => [
        'settings' => [
            'number_of_shards' => 2,
            'number_of_replicas' => 0
        ]
    ]
];

$response = $client->indices()->create($params);
#print_r($response);

# ----------------------------
# Unit Testing using Mock a Elastic Client
# ----------------------------

use GuzzleHttp\Ring\Client\MockHandler;
use Elasticsearch\ClientBuilder;

// The connection class requires 'body' to be a file stream handle
// Depending on what kind of request you do, you may need to set more values here
$handler = new MockHandler([
    'status' => 200,
    'transfer_stats' => [
        'total_time' => 100
    ],
    'body' => fopen('somefile.json')
]);
$builder = ClientBuilder::create();
$builder->setHosts(['somehost']);
$builder->setHandler($handler);
$client = $builder->build();
// Do a request and you'll get back the 'body' response above


############# version 2 #############################################

/*
{
 	"require": {
 		"elasticsearch/elasticsearch": "~2.0"
 	}
}*/

# Connecting Elasticsearch with PHP
require 'vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();

if ($client) {
    echo 'connected';
}

# Indexing data in Elasticsearch
require 'vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id2',
    'body' => [
        'first field' => 'Adding My First Field In Elasticsearch'
    ],
];
$response = $client->index($params);
echo $response['created'];

# Getting data from Elasticsearch
require 'vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'id' => 'my_id',
];

$response = $client->get($params);
echo $response['_source']['first field'];

# Searching in Elasticsearch
require 'vendor/autoload.php';
$client = Elasticsearch\ClientBuilder::create()->build();

$params = [
    'index' => 'my_index',
    'type' => 'my_type',
    'body' => [
        'query' => [
            'match' => [
                'first field' => 'first fiel'
            ],
        ],
    ],
];

$response = $client->search($params);
$hits = count($response['hits']['hits']);
$result = null;
$i = 0;

while ($i < $hits) {
    $result[$i] = $response['hits']['hits'][$i]['_source'];
    $i++;
}
foreach ($result as $key => $value) {
    echo $value['first field'] . "<br>";
}



