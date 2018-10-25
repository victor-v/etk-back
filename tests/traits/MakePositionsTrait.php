<?php

use Faker\Factory as Faker;
use App\Models\v1\Positions;
use App\Repositories\v1\PositionsRepository;

trait MakePositionsTrait
{
    /**
     * Create fake instance of Positions and save it in database
     *
     * @param array $positionsFields
     * @return Positions
     */
    public function makePositions($positionsFields = [])
    {
        /** @var PositionsRepository $positionsRepo */
        $positionsRepo = App::make(PositionsRepository::class);
        $theme = $this->fakePositionsData($positionsFields);
        return $positionsRepo->create($theme);
    }

    /**
     * Get fake instance of Positions
     *
     * @param array $positionsFields
     * @return Positions
     */
    public function fakePositions($positionsFields = [])
    {
        return new Positions($this->fakePositionsData($positionsFields));
    }

    /**
     * Get fake data of Positions
     *
     * @param array $postFields
     * @return array
     */
    public function fakePositionsData($positionsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $positionsFields);
    }
}
