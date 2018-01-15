<?php

/**
 * Created by PhpStorm.
 * User: Xtrazyx
 * Date: 14/01/2018
 * Time: 17:39
 */

namespace Tests\Api;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ApiTest extends WebTestCase
{
    /**
     * Create a client with a default Authorization header.
     *
     * @return \Symfony\Bundle\FrameworkBundle\Client
     */
    protected function createAuthenticatedClient()
    {
        $client = static::createClient();

        $client->request(
            'POST',
            '/api/login_check',
            array(
                '_username' => 'myphone',
                '_password' => 'phono'
            )
        );

        $data = json_decode($client->getResponse()->getContent(), true);

        $client = static::createClient();
        $client->setServerParameter('HTTP_Authorization', sprintf('Bearer %s', $data['token']));

        return $client;
    }

    public function testGetCompany()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/companies/33');

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals(200, $statusCode);

        $content = json_decode($client->getResponse()->getContent(), true);
        $this->assertInternalType('array', $content);
    }

    public function testGetCustomers()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/companies/33/customers');

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals($statusCode, 200);

        $content = json_decode($client->getResponse()->getContent(), true);
        $this->assertInternalType('array', $content);
    }

    public function testGetPhones()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/phones');

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals($statusCode, 200);

        $content = json_decode($client->getResponse()->getContent(), true);
        $this->assertInternalType('array', $content);
    }

    public function testGetPhone()
    {
        $client = $this->createAuthenticatedClient();
        $client->request('GET', '/api/phones/1');

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals($statusCode, 200);

        $content = json_decode($client->getResponse()->getContent(), true);
        $this->assertInternalType('array', $content);
    }

    public function testGetDocs()
    {
        $client = static::createClient();
        $client->request('GET', '/api/docs');

        $statusCode = $client->getResponse()->getStatusCode();
        $this->assertEquals($statusCode, 200);

    }

}
