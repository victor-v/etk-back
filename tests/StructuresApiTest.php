<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StructuresApiTest extends TestCase
{
    use MakeStructuresTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateStructures()
    {
        $structures = $this->fakeStructuresData();
        $this->json('POST', '/api/v1/structures', $structures);

        $this->assertApiResponse($structures);
    }

    /**
     * @test
     */
    public function testReadStructures()
    {
        $structures = $this->makeStructures();
        $this->json('GET', '/api/v1/structures/'.$structures->id);

        $this->assertApiResponse($structures->toArray());
    }

    /**
     * @test
     */
    public function testUpdateStructures()
    {
        $structures = $this->makeStructures();
        $editedStructures = $this->fakeStructuresData();

        $this->json('PUT', '/api/v1/structures/'.$structures->id, $editedStructures);

        $this->assertApiResponse($editedStructures);
    }

    /**
     * @test
     */
    public function testDeleteStructures()
    {
        $structures = $this->makeStructures();
        $this->json('DELETE', '/api/v1/structures/'.$structures->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/structures/'.$structures->id);

        $this->assertResponseStatus(404);
    }
}
