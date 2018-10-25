<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LogsApiTest extends TestCase
{
    use MakeLogsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateLogs()
    {
        $logs = $this->fakeLogsData();
        $this->json('POST', '/api/v1/logs', $logs);

        $this->assertApiResponse($logs);
    }

    /**
     * @test
     */
    public function testReadLogs()
    {
        $logs = $this->makeLogs();
        $this->json('GET', '/api/v1/logs/'.$logs->id);

        $this->assertApiResponse($logs->toArray());
    }

    /**
     * @test
     */
    public function testUpdateLogs()
    {
        $logs = $this->makeLogs();
        $editedLogs = $this->fakeLogsData();

        $this->json('PUT', '/api/v1/logs/'.$logs->id, $editedLogs);

        $this->assertApiResponse($editedLogs);
    }

    /**
     * @test
     */
    public function testDeleteLogs()
    {
        $logs = $this->makeLogs();
        $this->json('DELETE', '/api/v1/logs/'.$logs->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/logs/'.$logs->id);

        $this->assertResponseStatus(404);
    }
}
