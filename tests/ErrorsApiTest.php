<?php

use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ErrorsApiTest extends TestCase
{
    use MakeErrorsTrait, ApiTestTrait, WithoutMiddleware, DatabaseTransactions;

    /**
     * @test
     */
    public function testCreateErrors()
    {
        $errors = $this->fakeErrorsData();
        $this->json('POST', '/api/v1/errors', $errors);

        $this->assertApiResponse($errors);
    }

    /**
     * @test
     */
    public function testReadErrors()
    {
        $errors = $this->makeErrors();
        $this->json('GET', '/api/v1/errors/'.$errors->id);

        $this->assertApiResponse($errors->toArray());
    }

    /**
     * @test
     */
    public function testUpdateErrors()
    {
        $errors = $this->makeErrors();
        $editedErrors = $this->fakeErrorsData();

        $this->json('PUT', '/api/v1/errors/'.$errors->id, $editedErrors);

        $this->assertApiResponse($editedErrors);
    }

    /**
     * @test
     */
    public function testDeleteErrors()
    {
        $errors = $this->makeErrors();
        $this->json('DELETE', '/api/v1/errors/'.$errors->id);

        $this->assertApiSuccess();
        $this->json('GET', '/api/v1/errors/'.$errors->id);

        $this->assertResponseStatus(404);
    }
}
