<?php 

require_once dirname(dirname(__FILE__)) . '/vendor/autoload.php';

use PHPUnit\Framework\TestCase;

abstract class RestApiBaseTestCase extends TestCase {
	protected $client = null;
	protected $config = null;
	
	public function setUp()
	{
		$this->config = require_once  dirname(dirname(__FILE__)) . '/config.php';
		$this->client = new GuzzleHttp\Client([
			'base_uri' => $this->config['host'],
		]);
	}
	
	public function tearDown() {
		$this->client = null;
	}
	
	protected function sendRequest($method, $endpoint, $params = array(), $protected = true) {
		if ($protected) {
			$params['apiToken'] = $this->config['apiKey'];
		}
		$endpoint = trim("{$this->config['prefix']}{$endpoint}", "/");
		return $this->client->request(
			$method, 
			$endpoint, 
			array(
				'query' => $params,
			)
		);
	}
}