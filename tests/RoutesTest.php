<?php

class RoutesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * A basic functional test example.
     *
     * @return void
     */
    public function testForum()
    {
        $response = $this->call('GET', '/forums');
        $this->assertEquals(200, $response->getStatusCode());
    }
}
