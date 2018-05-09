<?php

require_once 'RestApiBaseTestCase.php';

class SubmissionsEndpointTest extends RestApiBaseTestCase {
	
	public function testWithoutToken() {
		$this->expectException(GuzzleHttp\Exception\ClientException::class);
		$response = $this->sendRequest('GET', '/submissions', array(), false);
	}
	public function testGet() {
		$response = $this->sendRequest('GET', '/submissions');
		$this->assertEquals(200, $response->getStatusCode());
	}
}