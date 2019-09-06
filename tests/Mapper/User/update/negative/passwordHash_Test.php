<?php

class Mapper_User__save__negative__password_hash__Test extends Abstract_DB_TestCase
{
    public function test_notSet()
    {
        $user = new User_Model();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "passwordHash" property null must be a string');
        $user = (new User_Mapper())->update($user);
    }

    public function test_isEmpty()
    {
        $user = new User_Model();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = '';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "passwordHash" property "" must have a length between 55 and 65');
        $user = (new User_Mapper())->update($user);
    }

    public function test_tooShort()
    {
        $user = new User_Model();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = 'qwerty';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "passwordHash" property "qwerty" must have a length between 55 and 65');
        $user = (new User_Mapper())->update($user);
    }

    public function test_tooLong()
    {
        $user = new User_Model();
        $user->id = 37;
        $user->username = 'steve';
        $user->name = 'Steve Bo';
        $user->signature = 'Foo bar';
        $user->email = 'steve@aw.org';
        $user->passwordHash = 'qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty';
        $user->apiKey = '4447243e3e1766375d23b06bf6dd1271';
        $user->createdAt = '2016-03-19 06:47:41';

        $this->expectExceptionMessage('User "passwordHash" property "qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty" must have a length between 55 and 65');
        $user = (new User_Mapper())->update($user);
    }
}
