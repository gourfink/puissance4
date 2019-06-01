<?php 

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testClear()
    {
        $client = static::createClient();
        $client->request('GET', '/clear');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testGrid()
    {
        $client = static::createClient();
        $client->request('GET', '/grid');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }

    public function testMove()
    {
        $client = static::createClient();
        $client->request('GET', '/move?p=1&m=25');
        $this->assertEquals(200, $client->getResponse()->getStatusCode());
    }
}