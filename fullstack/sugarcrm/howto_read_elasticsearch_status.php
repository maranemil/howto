<?php
	/**
	 * Created by PhpStorm.
	 * User: emil
	 * Date: 05.02.16
	 * Time: 13:08
	 */

	###################################
	# Get ElasticSearch Object in PHP Elastica
	###################################

	// http://uzzai.com/95Oe1J0Z/how-to-properly-run-a-count-query-using-elastica.html
	// http://www.unknownerror.org/opensource/ruflin/Elastica/q/stackoverflow/19416578/how-to-properly-run-a-count-query-using-elastica

	// Define a Query. E.g. a string query.
	$elasticaQueryString = new \Elastica\Query\QueryString();
	//'And' or 'Or' default : 'Or'
	$elasticaQueryString->setDefaultOperator('AND');
	$elasticaQueryString->setQuery('Tox');
	// Create the actual search query object with some data.
	$elasticaQuery = new \Elastica\Query();
	$elasticaQuery->setQuery($elasticaQueryString);
	// Setup elastica client connection to your easticsearch server (with default host and port)
	//$elasticaClient = new \Elastica\Client();
	//// Setup elastica client connection to your elasticsearch server

	// http://elastica.io/getting-started/installation.html
	// http://elastica.io/example/raw-array-query.html
	// https://github.com/ruflin/Elastica
	// https://github.com/jolicode/elasticsearch-php-benchmark

	$elasticaClient = new \Elastica\Client(array(
		//'servers' => array(
		//	array('host' => 'localhost', 'port' => 9200),
		//	array('host' => 'localhost', 'port' => 9201)
		//),
		'host' => 'localhost',
		'port' => 9200,
		'timeout' => 60,
		'persistent' => true
	));
	// Create an elastica search object
	$elasticaSearch = new \Elastica\Search($elasticaClient);
	// Call count method on search object to run a
	$count = $elasticaSearch->count($elasticaQuery);
	// output count
	echo "<p>$count<p>";
	print "<pre>";
	print_r($elasticaSearch);

	/*
	 *
    ###################################
    # Log Requests in Elastica
    ###################################
    http://www.ruflin.com/2011/11/20/how-to-log-requests-in-elastica/

	$client = new Elastica_Client(array('log' => true));
	$log = new Elastica_Log($client);
	$log->log('hello world');

	$client = new Elastica_Client(array('log' => '/tmp/php.log'));
	$log = new Elastica_Log($client);
	$log->log('hello world');

	curl -XPUT http://localhost:9200/test/_settings -d '{"index":{"number_of_replicas":0}}'
	*/

	/*
	 * http://elastica.io/example/raw-array-query.html
	 * \Elastica\Client::request($path, $method = Request::GET, $data = array(), array $query = array())

	$client = new Client();

	$index = $client->getIndex('test');
	$index->create(array(), true);
	$type = $index->getType('test');
	$type->addDocument(new Document(1, array('username' => 'ruflin')));
	$index->refresh();

	$query = array(
	    'query' => array(
	        'query_string' => array(
	            'query' => 'ruflin',
	        )
	    )
	);

	$path = $index->getName() . '/' . $type->getName() . '/_search';

	$response = $client->request($path, Request::GET, $query);
	$responseArray = $response->getData();
	$totalHits = $responseArray['hits']['total']);

	*/


	/*
	# Search
	# https://dpb587.me/blog/2013/06/01/search-engine-based-on-structured-data.html
	<?php
		$bool = (new \Elastica\Query\Bool())
	        ->addMust(
	            (new \Elastica\Query\Bool())
	                ->setParam('minimum_number_should_match', 1)
	                ->addShould(
	                    (new \Elastica\Query\QueryString())
	                        ->setParam('default_field', 'keywords')
	                    )
			->addShould(
				(new \Elastica\Query\QueryString())
					->setParam('default_field', 'title')
				)
			->addShould(
				(new \Elastica\Query\QueryString())
					->setParam('default_field', 'content')
		        )
		);

		$query = new \Elastica\Query($bool);

		$query->setHighlight(
	    array(
	        'pre_tags' => array('<strong>'),
	        'post_tags' => array('</strong>'),
	        'fields' => array(
	            'title' => array(
	                'fragment_size' => 256,
	                'number_of_fragments' => 1 ),
	            'content' => array(
	                'fragment_size' => 64,
	                'number_of_fragments' => 3 ) ) ) );

	 */

