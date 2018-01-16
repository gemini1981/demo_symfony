<?php

namespace AppBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ProductControllerTest extends WebTestCase
{
    public function testCreate()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'product/create');
    }

    public function testList()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'product/list');
    }

    public function testEdit()
    {
        $client = static::createClient();

        $crawler = $client->request('GET', 'product/{product}/edit');
    }

}
