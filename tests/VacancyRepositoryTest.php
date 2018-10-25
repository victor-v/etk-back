<?php

use App\Models\v1\Vacancy;
use App\Repositories\v1\VacancyRepository;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VacancyRepositoryTest extends TestCase
{
    use MakeVacancyTrait, ApiTestTrait, DatabaseTransactions;

    /**
     * @var VacancyRepository
     */
    protected $vacancyRepo;

    public function setUp()
    {
        parent::setUp();
        $this->vacancyRepo = App::make(VacancyRepository::class);
    }

    /**
     * @test create
     */
    public function testCreateVacancy()
    {
        $vacancy = $this->fakeVacancyData();
        $createdVacancy = $this->vacancyRepo->create($vacancy);
        $createdVacancy = $createdVacancy->toArray();
        $this->assertArrayHasKey('id', $createdVacancy);
        $this->assertNotNull($createdVacancy['id'], 'Created Vacancy must have id specified');
        $this->assertNotNull(Vacancy::find($createdVacancy['id']), 'Vacancy with given id must be in DB');
        $this->assertModelData($vacancy, $createdVacancy);
    }

    /**
     * @test read
     */
    public function testReadVacancy()
    {
        $vacancy = $this->makeVacancy();
        $dbVacancy = $this->vacancyRepo->find($vacancy->id);
        $dbVacancy = $dbVacancy->toArray();
        $this->assertModelData($vacancy->toArray(), $dbVacancy);
    }

    /**
     * @test update
     */
    public function testUpdateVacancy()
    {
        $vacancy = $this->makeVacancy();
        $fakeVacancy = $this->fakeVacancyData();
        $updatedVacancy = $this->vacancyRepo->update($fakeVacancy, $vacancy->id);
        $this->assertModelData($fakeVacancy, $updatedVacancy->toArray());
        $dbVacancy = $this->vacancyRepo->find($vacancy->id);
        $this->assertModelData($fakeVacancy, $dbVacancy->toArray());
    }

    /**
     * @test delete
     */
    public function testDeleteVacancy()
    {
        $vacancy = $this->makeVacancy();
        $resp = $this->vacancyRepo->delete($vacancy->id);
        $this->assertTrue($resp);
        $this->assertNull(Vacancy::find($vacancy->id), 'Vacancy should not exist in DB');
    }
}
