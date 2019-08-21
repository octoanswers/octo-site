<?php

class UsersIDName_PATCH_APIController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test_RenameWithSaveRedirect_Ok()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&name=' . urlencode('Вова Малышов');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/users/3/name.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'user' => [
                'id'       => 3,
                'name'     => 'Вова Малышов',
                'name_old' => 'Иван Коршунов',
            ],
            'message' => 'Name saved!',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
