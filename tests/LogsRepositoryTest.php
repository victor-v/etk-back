<?php

use App\Models\v1\Logs;
use App\Repositories\v1\LogsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class LogsRepositoryTest extends TestCase
{
    use MakeLogsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var LogsRepository
     */
    protected $logsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->logsRepo = App::make(LogsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateLogs()
    {
        $logs = $this->fakeLogsData();
        $createdLogs = $this->logsRepo->create($logs);
        $createdLogs = $createdLogs->toArray();
        $this->assertArrayHasKey('id', $createdLogs);
        $this->assertNotNull($createdLogs['id'], 'Created Logs must have id specified');
        $this->assertNotNull(Logs::find($createdLogs['id']), 'Logs with given id must be in DB');
        $this->assertModelData($logs, $createdLogs);
    }

    /**
     * @test read
     */
    public function testReadLogs()
    {
        $logs = $this->makeLogs();
        $dbLogs = $this->logsRepo->find($logs->id);
        $dbLogs = $dbLogs->toArray();
        $this->assertModelData($logs->toArray(), $dbLogs);
    }

    /**
     * @test update
     */
    public function testUpdateLogs()
    {
        $logs = $this->makeLogs();
        $fakeLogs = $this->fakeLogsData();
        $updatedLogs = $this->logsRepo->update($fakeLogs, $logs->id);
        $this->assertModelData($fakeLogs, $updatedLogs->toArray());
        $dbLogs = $this->logsRepo->find($logs->id);
        $this->assertModelData($fakeLogs, $dbLogs->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteLogs()
    {
        $logs = $this->makeLogs();
        $resp = $this->logsRepo->delete($logs->id);
        $this->assertTrue($resp);
        $this->assertNull(Logs::find($logs->id), 'Logs should not exist in DB');
    }
}
