<?php

class Mapper_User_save_negative_passwordHash_Test extends Abstract_DB_TestCase
{
    public function test_notSet()
    {
        $user = new User_Model();
        $user->setID(37);
        $user->setUsername('steve');
        $user->setName('Steve Bo');
        $user->setSignature('Foo bar');
        $user->setEmail('steve@aw.org');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');
        $user->setCreatedAt('2016-03-19 06:47:41');

        $this->expectExceptionMessage('User "passwordHash" property null must be a string');
        $user = (new User_Mapper())->update($user);
    }

    public function test_isEmpty()
    {
        $user = new User_Model();
        $user->setID(37);
        $user->setUsername('steve');
        $user->setName('Steve Bo');
        $user->setSignature('Foo bar');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');
        $user->setCreatedAt('2016-03-19 06:47:41');

        $this->expectExceptionMessage('User "passwordHash" property "" must have a length between 55 and 65');
        $user = (new User_Mapper())->update($user);
    }

    public function test_tooShort()
    {
        $user = new User_Model();
        $user->setID(37);
        $user->setUsername('steve');
        $user->setName('Steve Bo');
        $user->setSignature('Foo bar');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('qwerty');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');
        $user->setCreatedAt('2016-03-19 06:47:41');

        $this->expectExceptionMessage('User "passwordHash" property "qwerty" must have a length between 55 and 65');
        $user = (new User_Mapper())->update($user);
    }

    public function test_tooLong()
    {
        $user = new User_Model();
        $user->setID(37);
        $user->setUsername('steve');
        $user->setName('Steve Bo');
        $user->setSignature('Foo bar');
        $user->setEmail('steve@aw.org');
        $user->setPasswordHash('qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty');
        $user->setAPIKey('4447243e3e1766375d23b06bf6dd1271');
        $user->setCreatedAt('2016-03-19 06:47:41');

        $this->expectExceptionMessage('User "passwordHash" property "qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty+qwerty" must have a length between 55 and 65');
        $user = (new User_Mapper())->update($user);
    }
}
