<?php

class UsersIDSite_PATCH_APIController__ru__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test_RenameWithSaveRedirect_Ok()
    {
        $query_string = '/api/v1/ru/users/3/site.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&site=' . urlencode('https://answeropedia.org');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'user' => [
                'id'       => 3,
                'name'     => 'Иван Коршунов',
                'site_old' => null,
                'site_new' => 'https://answeropedia.org',
            ],
            'message' => 'User site saved!',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
