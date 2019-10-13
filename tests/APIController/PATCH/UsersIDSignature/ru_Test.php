<?php

class UsersIDSignature_PATCH_APIController__ru__Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test_RenameWithSaveRedirect_Ok()
    {
        $query_string = '/api/v1/ru/users/3/signature.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&signature=' . urlencode('Enterpreneur, writer.');

        $request = $this->createRequest('PATCH', $query_string);
        $response = $this->request($request);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'user' => [
                'id'            => 3,
                'name'          => 'Иван Коршунов',
                'signature_old' => 'Old signature',
                'signature_new' => 'Enterpreneur, writer.',
            ],
            'message' => 'Signature saved!',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
