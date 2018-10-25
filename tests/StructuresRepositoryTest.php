<?php

use App\Models\v1\Structures;
use App\Repositories\v1\StructuresRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class StructuresRepositoryTest extends TestCase
{
    use MakeStructuresTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var StructuresRepository
     */
    protected $structuresRepo;

    public function setUp()
    {
        parent::setUp();
        $this->structuresRepo = App::make(StructuresRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateStructures()
    {
        $structures = $this->fakeStructuresData();
        $createdStructures = $this->structuresRepo->create($structures);
        $createdStructures = $createdStructures->toArray();
        $this->assertArrayHasKey('id', $createdStructures);
        $this->assertNotNull($createdStructures['id'], 'Created Structures must have id specified');
        $this->assertNotNull(Structures::find($createdStructures['id']), 'Structures with given id must be in DB');
        $this->assertModelData($structures, $createdStructures);
    }

    /**
     * @test read
     */
    public function testReadStructures()
    {
        $structures = $this->makeStructures();
        $dbStructures = $this->structuresRepo->find($structures->id);
        $dbStructures = $dbStructures->toArray();
        $this->assertModelData($structures->toArray(), $dbStructures);
    }

    /**
     * @test update
     */
    public function testUpdateStructures()
    {
        $structures = $this->makeStructures();
        $fakeStructures = $this->fakeStructuresData();
        $updatedStructures = $this->structuresRepo->update($fakeStructures, $structures->id);
        $this->assertModelData($fakeStructures, $updatedStructures->toArray());
        $dbStructures = $this->structuresRepo->find($structures->id);
        $this->assertModelData($fakeStructures, $dbStructures->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteStructures()
    {
        $structures = $this->makeStructures();
        $resp = $this->structuresRepo->delete($structures->id);
        $this->assertTrue($resp);
        $this->assertNull(Structures::find($structures->id), 'Structures should not exist in DB');
    }
}
