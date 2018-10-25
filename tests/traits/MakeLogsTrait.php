<?php

use Faker\Factory as Faker;
use App\Models\v1\Logs;
use App\Repositories\v1\LogsRepository;

trait MakeLogsTrait
{
    /**
     * Create fake instance of Logs and save it in database
     *
     * @param array $logsFields
     * @return Logs
     */
    public function makeLogs($logsFields = [])
    {
        /** @var LogsRepository $logsRepo */
        $logsRepo = App::make(LogsRepository::class);
        $theme = $this->fakeLogsData($logsFields);
        return $logsRepo->create($theme);
    }

    /**
     * Get fake instance of Logs
     *
     * @param array $logsFields
     * @return Logs
     */
    public function fakeLogs($logsFields = [])
    {
        return new Logs($this->fakeLogsData($logsFields));
    }

    /**
     * Get fake data of Logs
     *
     * @param array $postFields
     * @return array
     */
    public function fakeLogsData($logsFields = [])
    {
        $fake = Faker::create();

        return array_merge([
            'created_at' => $fake->word,
            'updated_at' => $fake->word
        ], $logsFields);
    }
}
