<?php

class Signup_POST_APIController__Password_Test extends Abstract_Frontend_TestCase
{
    public function testPasswordTooShort()
    {
        $request = $this->__getTestRequest('POST', '/api/v1/ru/signup.json', 'email=new@answeropedia.org&password=1234&username=ivanivanov', true);

        $this->app->getContainer()['request'] = $request;

        $response = $this->app->run(true);
        $responseBody = (string) $response->getBody();

        $expectedResponse = [
            'error_code'    => 0,
            'error_message' => 'User "password" property "1234" must have a length between 6 and 32',
        ];

        $this->assertEquals($expectedResponse, json_decode($responseBody, true));
        $this->assertSame(200, $response->getStatusCode());
    }
}
