<?php

namespace Tests\APIController\PATCH\UsersIDSignature;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = ['ru' => ['activities'], 'users' => ['users']];

    public function test_RenameWithSaveRedirect_Ok()
    {
        $uri = '/api/v1/ru/users/3/signature.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&signature=' . urlencode('Enterpreneur, writer.');

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'user' => [
                'id'            => 3,
                'name'          => 'Иван Коршунов',
                'signature_old' => 'Old signature',
                'signature_new' => 'Enterpreneur, writer.',
            ],
            'message' => 'Signature saved!',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
