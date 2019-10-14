<?php

namespace Tests\APIController\PATCH\UsersIDSite;

class Test extends \Test\TestCase\Frontend
{
    protected $setUpDB = [
        'ru' => ['activities'],
        'users' => ['users']
    ];

    public function test__Rename_with_save_redirect()
    {
        $uri = '/api/v1/ru/users/3/site.json?api_key=7d21ebdbec3d4e396043c96b6ab44a6e&site=' . urlencode('https://answeropedia.org');

        $request = $this->createRequest('PATCH', $uri);
        $response = $this->request($request);
        $response_body = (string) $response->getBody();

        $expected_response = [
            'user' => [
                'id'       => 3,
                'name'     => 'Иван Коршунов',
                'site_old' => null,
                'site_new' => 'https://answeropedia.org',
            ],
            'message' => 'User site saved!',
        ];

        $this->assertEquals($expected_response, json_decode($response_body, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
