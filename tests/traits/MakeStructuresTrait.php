<?php

use Faker\Factory as Faker;
use App\Models\v1\Structures;
use App\Repositories\v1\StructuresRepository;

trait MakeStructuresTrait
{
    /**
     * Create fake instance of Structures and save it in database
     *
     * @param array $structuresFields
     * @return Structures
     */
    public function makeStructures($structuresFields = [])
    {
        /** @var StructuresRepository $structuresRepo */
        $structuresRepo = App::make(StructuresRepository::class);
        $theme = $this->fakeStructuresData($structuresFields);
        return $structuresRepo->create($theme);
    }

    /**
     * Get fake instance of Structures
     *
     * @param array $structuresFields
     * @return Structures
     */
    public function fakeStructures($structuresFields = [])
    {
        return new Structures($this->fakeStructuresData($structuresFields));
    }

    /**
     * Get fake data of Structures
     *
     * @param array $postFields
     * @return array
     */
    public function fakeStructuresData($structuresFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $structuresFields);
    }
}
