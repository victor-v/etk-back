<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PositionsApiTest extends TestCase
{
    use MakePositionsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreatePositions()
    {
        $positions = $this->fakePositionsData();
        $this->json('POST', '/api/v1/positions', $positions);

        $this->assertApiResponse($positions);
    }

    /**
     * @test
     */
    public function testReadPositions()
    {
        $positions = $this->makePositions();
        $this->json('GET', '/api/v1/positions/'.$positions->id);

        $this->assertApiResponse($positions->toArray());
    }

    /**
     * @test
     */
    public function testUpdatePositions()
    {
        $positions = $this->makePositions();
        $editedPositions = $this->fakePositionsData();

        $this->json('PUT', '/api/v1/positions/'.$positions->id, $editedPositions);

        $this->assertApiResponse($editedPositions);
    }

    /**
     * @test
     */
    public function testDeletePositions()
    {
        $positions = $this->makePositions();
        $this->json('DELETE', '/api/v1/positions/'.$positions->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/positions/'.$positions->id);

        $this->assertResponseStatus(404);
    }
}
