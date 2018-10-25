<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class VacancyApiTest extends TestCase
{
    use MakeVacancyTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateVacancy()
    {
        $vacancy = $this->fakeVacancyData();
        $this->json('POST', '/api/v1/vacancies', $vacancy);

        $this->assertApiResponse($vacancy);
    }

    /**
     * @test
     */
    public function testReadVacancy()
    {
        $vacancy = $this->makeVacancy();
        $this->json('GET', '/api/v1/vacancies/'.$vacancy->id);

        $this->assertApiResponse($vacancy->toArray());
    }

    /**
     * @test
     */
    public function testUpdateVacancy()
    {
        $vacancy = $this->makeVacancy();
        $editedVacancy = $this->fakeVacancyData();

        $this->json('PUT', '/api/v1/vacancies/'.$vacancy->id, $editedVacancy);

        $this->assertApiResponse($editedVacancy);
    }

    /**
     * @test
     */
    public function testDeleteVacancy()
    {
        $vacancy = $this->makeVacancy();
        $this->json('DELETE', '/api/v1/vacancies/'.$vacancy->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/vacancies/'.$vacancy->id);

        $this->assertResponseStatus(404);
    }
}
