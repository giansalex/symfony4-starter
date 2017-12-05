<?php
/**
 * Created by PhpStorm.
 * User: Administrador
 * Date: 05/12/2017
 * Time: 03:24 PM
 */

namespace App\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomeControllerTest extends WebTestCase
{
    public function testIndexAnonymus()
    {
        $client = static::createClient();

        $client->request('GET', '/');

        $this->assertEquals(401, $client->getResponse()->getStatusCode());
    }

    public function testIndexAuthenticate()
    {
        $client = static::createClient([], [
            'PHP_AUTH_USER' => 'ryan',
            'PHP_AUTH_PW'   => 'ryanpass',
        ]);

        $crawler = $client->request('GET', '/');

        $this->assertEquals(200, $client->getResponse()->getStatusCode());
        $this->assertGreaterThan(
            0,
            $crawler->filter('html:contains("ryan")')->count()
        );
    }
}