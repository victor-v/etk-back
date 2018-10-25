<?php

use App\Models\v1\Constants;
use App\Repositories\v1\ConstantsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ConstantsRepositoryTest extends TestCase
{
    use MakeConstantsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ConstantsRepository
     */
    protected $constantsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->constantsRepo = App::make(ConstantsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateConstants()
    {
        $constants = $this->fakeConstantsData();
        $createdConstants = $this->constantsRepo->create($constants);
        $createdConstants = $createdConstants->toArray();
        $this->assertArrayHasKey('id', $createdConstants);
        $this->assertNotNull($createdConstants['id'], 'Created Constants must have id specified');
        $this->assertNotNull(Constants::find($createdConstants['id']), 'Constants with given id must be in DB');
        $this->assertModelData($constants, $createdConstants);
    }

    /**
     * @test read
     */
    public function testReadConstants()
    {
        $constants = $this->makeConstants();
        $dbConstants = $this->constantsRepo->find($constants->id);
        $dbConstants = $dbConstants->toArray();
        $this->assertModelData($constants->toArray(), $dbConstants);
    }

    /**
     * @test update
     */
    public function testUpdateConstants()
    {
        $constants = $this->makeConstants();
        $fakeConstants = $this->fakeConstantsData();
        $updatedConstants = $this->constantsRepo->update($fakeConstants, $constants->id);
        $this->assertModelData($fakeConstants, $updatedConstants->toArray());
        $dbConstants = $this->constantsRepo->find($constants->id);
        $this->assertModelData($fakeConstants, $dbConstants->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteConstants()
    {
        $constants = $this->makeConstants();
        $resp = $this->constantsRepo->delete($constants->id);
        $this->assertTrue($resp);
        $this->assertNull(Constants::find($constants->id), 'Constants should not exist in DB');
    }
}
