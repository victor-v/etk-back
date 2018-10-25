<?php

use Faker\Factory as Faker;
use App\Models\v1\Vacancy;
use App\Repositories\v1\VacancyRepository;

trait MakeVacancyTrait
{
    /**
     * Create fake instance of Vacancy and save it in database
     *
     * @param array $vacancyFields
     * @return Vacancy
     */
    public function makeVacancy($vacancyFields = [])
    {
        /** @var VacancyRepository $vacancyRepo */
        $vacancyRepo = App::make(VacancyRepository::class);
        $theme = $this->fakeVacancyData($vacancyFields);
        return $vacancyRepo->create($theme);
    }

    /**
     * Get fake instance of Vacancy
     *
     * @param array $vacancyFields
     * @return Vacancy
     */
    public function fakeVacancy($vacancyFields = [])
    {
        return new Vacancy($this->fakeVacancyData($vacancyFields));
    }

    /**
     * Get fake data of Vacancy
     *
     * @param array $postFields
     * @return array
     */
    public function fakeVacancyData($vacancyFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $vacancyFields);
    }
}
