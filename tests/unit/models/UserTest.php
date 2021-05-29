<?php

namespace tests\unit\models;

use app\models\User;

class UserTest extends \Codeception\Test\Unit
{
    public function testFindUserById()
    {
        expect_that($user = User::findIdentity(1));
        expect($user->username)->equals('benmtz97');

        expect_not(User::findIdentity(999));
    }


    public function testFindUserByUsername()
    {
        expect_that($user = User::findByUsername('benmtz97'));
        expect_not(User::findByUsername('not-admin'));
    }

    /**
     * @depends testFindUserByUsername
     */
    public function testValidateUser($user)
    {
        $user = User::findByUsername('benmtz97');

        expect_that($user->validatePassword('123456'));
        expect_not($user->validatePassword('123456789'));
    }

}
