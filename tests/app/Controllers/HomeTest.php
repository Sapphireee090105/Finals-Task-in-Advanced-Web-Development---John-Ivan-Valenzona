<?php

namespace App;

use CodeIgniter\Test\CIUnitTestCase;
use CodeIgniter\Test\FeatureTestTrait;

class HomeTest extends CIUnitTestCase
{
    use FeatureTestTrait;

    public function testHomePage()
    {
        // Bibisitahin ang root url ('/') ng project mo at titingnan kung gagana
        $result = $this->get('/');
        $result->assertStatus(200);
    }
}