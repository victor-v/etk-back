<?php

use App\Models\v1\Errors;
use App\Repositories\v1\ErrorsRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ErrorsRepositoryTest extends TestCase
{
    use MakeErrorsTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var ErrorsRepository
     */
    protected $errorsRepo;

    public function setUp()
    {
        parent::setUp();
        $this->errorsRepo = App::make(ErrorsRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateErrors()
    {
        $errors = $this->fakeErrorsData();
        $createdErrors = $this->errorsRepo->create($errors);
        $createdErrors = $createdErrors->toArray();
        $this->assertArrayHasKey('id', $createdErrors);
        $this->assertNotNull($createdErrors['id'], 'Created Errors must have id specified');
        $this->assertNotNull(Errors::find($createdErrors['id']), 'Errors with given id must be in DB');
        $this->assertModelData($errors, $createdErrors);
    }

    /**
     * @test read
     */
    public function testReadErrors()
    {
        $errors = $this->makeErrors();
        $dbErrors = $this->errorsRepo->find($errors->id);
        $dbErrors = $dbErrors->toArray();
        $this->assertModelData($errors->toArray(), $dbErrors);
    }

    /**
     * @test update
     */
    public function testUpdateErrors()
    {
        $errors = $this->makeErrors();
        $fakeErrors = $this->fakeErrorsData();
        $updatedErrors = $this->errorsRepo->update($fakeErrors, $errors->id);
        $this->assertModelData($fakeErrors, $updatedErrors->toArray());
        $dbErrors = $this->errorsRepo->find($errors->id);
        $this->assertModelData($fakeErrors, $dbErrors->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteErrors()
    {
        $errors = $this->makeErrors();
        $resp = $this->errorsRepo->delete($errors->id);
        $this->assertTrue($resp);
        $this->assertNull(Errors::find($errors->id), 'Errors should not exist in DB');
    }
}
