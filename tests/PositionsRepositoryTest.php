<?php

use App\Models\v1\Positions;
use App\Repositories\v1\PositionsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class PositionsRepositoryTest extends TestCase
{
    use MakePositionsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var PositionsRepository
     */
    protected $positionsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->positionsRepo = App::make(PositionsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreatePositions()
    {
        $positions = $this->fakePositionsData();
        $createdPositions = $this->positionsRepo->create($positions);
        $createdPositions = $createdPositions->toArray();
        $this->assertArrayHasKey('id', $createdPositions);
        $this->assertNotNull($createdPositions['id'], 'Created Positions must have id specified');
        $this->assertNotNull(Positions::find($createdPositions['id']), 'Positions with given id must be in DB');
        $this->assertModelData($positions, $createdPositions);
    }

    /**
     * @test read
     */
    public function testReadPositions()
    {
        $positions = $this->makePositions();
        $dbPositions = $this->positionsRepo->find($positions->id);
        $dbPositions = $dbPositions->toArray();
        $this->assertModelData($positions->toArray(), $dbPositions);
    }

    /**
     * @test update
     */
    public function testUpdatePositions()
    {
        $positions = $this->makePositions();
        $fakePositions = $this->fakePositionsData();
        $updatedPositions = $this->positionsRepo->update($fakePositions, $positions->id);
        $this->assertModelData($fakePositions, $updatedPositions->toArray());
        $dbPositions = $this->positionsRepo->find($positions->id);
        $this->assertModelData($fakePositions, $dbPositions->toArray());
    }

    /**
     * @test delete
     */
    public function testDeletePositions()
    {
        $positions = $this->makePositions();
        $resp = $this->positionsRepo->delete($positions->id);
        $this->assertTrue($resp);
        $this->assertNull(Positions::find($positions->id), 'Positions should not exist in DB');
    }
}
