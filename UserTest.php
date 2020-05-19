<?php

use Phalcon\Mvc\Model;
use Phalcon\Validation;
use Phalcon\Logger;
use Phalcon\Validation\Validator\Email;
use Phalcon\Validation\Validator\PresenceOf;
use Phalcon\Validation\Validator\Uniqueness as UniquenessValidator;
use Phalcon\Mvc\Model\Resultset\Simple;

/**
 * Types of Products
 */
class UserTest extends Model
{
    public function validation()
    {
        $validation = new Validation();

        $validation->add(
            'email',
            new Email([
                    'message' => 'The e-mail is not valid!',
            ]));

        $validation->add(
            'email',
            new UniquenessValidator([
                'message' => 'Sorry, the email was registered by another user!'
            ]));

        $validation->add(
            'email',
            new PresenceOf(
                [
                    'message' => 'The e-mail is required',
                ]
            )
        );

        $validation->add(
            'password',
            new PresenceOf(
                [
                    'message' => 'The password is required',
                ]
            )
        );

        $validation->add(
            'address',
            new PresenceOf(
                [
                    'message' => 'The address is required',
                ]
            )
        );

        $validation->add(
            'city',
            new PresenceOf(
                [
                    'message' => 'The city is required',
                ]
            )
        );

//        $validation->add(
//          'email',
//          new Logger(
//              [
//                  'message' => 'email is logged in...',
//              ]
//          )
//        );

        return $this->validate($validation);
    }

    public function initialize()
    {
        $this->setSource('user_test');
    }
}