<?php

class UsersIDName_PATCH_APIController__ru__Test extends \Tests\Frontend\TestCase
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test_RenameWithSaveRedirect_Ok()
    {
        $query_string = '/api/v1/ru/users/3/name.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&name=' . urlencode('Вова Малышов');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
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
