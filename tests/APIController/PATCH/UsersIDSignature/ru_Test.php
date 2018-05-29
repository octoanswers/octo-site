<?php

class UsersIDSignature_PATCH_APIController__ru__Test extends Abstract_Frontend_TestCase
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test_RenameWithSaveRedirect_Ok()
    {
        $queryString = 'api_key=7d21ebdbec3d4e396043c96b6ab44a6e&signature='.urlencode('Enterpreneur, writer.');
        $request = $this->__getTestRequest('PATCH', '/api/v1/ru/users/3/signature.json', $queryString, true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'user' => [
                'id' => 3,
                'name' => 'Иван Коршунов',
                'signature_old' => 'Old signature',
                'signature_new' => 'Enterpreneur, writer.',
            ],
            'message' => 'Signature saved!',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
