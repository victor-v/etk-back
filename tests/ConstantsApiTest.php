<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConstantsApiTest extends TestCase
{
    use MakeConstantsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateConstants()
    {
        $constants = $this->fakeConstantsData();
        $this->json('POST', '/api/v1/constants', $constants);

        $this->assertApiResponse($constants);
    }

    /**
     * @test
     */
    public function testReadConstants()
    {
        $constants = $this->makeConstants();
        $this->json('GET', '/api/v1/constants/'.$constants->id);

        $this->assertApiResponse($constants->toArray());
    }

    /**
     * @test
     */
    public function testUpdateConstants()
    {
        $constants = $this->makeConstants();
        $editedConstants = $this->fakeConstantsData();

        $this->json('PUT', '/api/v1/constants/'.$constants->id, $editedConstants);

        $this->assertApiResponse($editedConstants);
    }

    /**
     * @test
     */
    public function testDeleteConstants()
    {
        $constants = $this->makeConstants();
        $this->json('DELETE', '/api/v1/constants/'.$constants->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/constants/'.$constants->id);

        $this->assertResponseStatus(404);
    }
}
