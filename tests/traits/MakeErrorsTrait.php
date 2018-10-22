<?php

use Faker\Factory as Faker;
use App\Models\v1\Errors;
use App\Repositories\v1\ErrorsRepository;

trait MakeErrorsTrait
{
    /**
     * Create fake instance of Errors and save it in database
     *
     * @param array $errorsFields
     * @return Errors
     */
    public function makeErrors($errorsFields = [])
    {
        /** @var ErrorsRepository $errorsRepo */
        $errorsRepo = App::make(ErrorsRepository::class);
        $theme = $this->fakeErrorsData($errorsFields);
        return $errorsRepo->create($theme);
    }

    /**
     * Get fake instance of Errors
     *
     * @param array $errorsFields
     * @return Errors
     */
    public function fakeErrors($errorsFields = [])
    {
        return new Errors($this->fakeErrorsData($errorsFields));
    }

    /**
     * Get fake data of Errors
     *
     * @param array $postFields
     * @return array
     */
    public function fakeErrorsData($errorsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'id_err' => $fake->word,
            'desc_err_ru' => $fake->word,
            'desc_err_uz' => $fake->word,
            'code' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $errorsFields);
    }
}
