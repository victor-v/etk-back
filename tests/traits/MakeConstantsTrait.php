<?php

use Faker\Factory as Faker;
use App\Models\v1\Constants;
use App\Repositories\v1\ConstantsRepository;

trait MakeConstantsTrait
{
    /**
     * Create fake instance of Constants and save it in database
     *
     * @param array $constantsFields
     * @return Constants
     */
    public function makeConstants($constantsFields = [])
    {
        /** @var ConstantsRepository $constantsRepo */
        $constantsRepo = App::make(ConstantsRepository::class);
        $theme = $this->fakeConstantsData($constantsFields);
        return $constantsRepo->create($theme);
    }

    /**
     * Get fake instance of Constants
     *
     * @param array $constantsFields
     * @return Constants
     */
    public function fakeConstants($constantsFields = [])
    {
        return new Constants($this->fakeConstantsData($constantsFields));
    }

    /**
     * Get fake data of Constants
     *
     * @param array $postFields
     * @return array
     */
    public function fakeConstantsData($constantsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'group_const' => $fake->randomDigitNotNull,
            'code_const' => $fake->word,
            'type_const' => $fake->randomDigitNotNull,
            'value_const_ru' => $fake->word,
            'value_const_uz' => $fake->word,
            'commentconst' => $fake->word,
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $constantsFields);
    }
}
