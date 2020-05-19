<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Controller;
use Phalcon\Filter;
//use Phalcon\Logger;
use Phalcon\Security;

class UserTestController extends ControllerBase
{
    public function initialize()
    {
        $this->tag->setTitle('UserTest');
        $this->auth = $this->session->get('auth');
        $this->filter = new Filter();
        parent::initialize();
    }

    public function registerAction()
    {
        //1st checks in Session - startAction(){}
        if ($this->request->isPost()) {

            $this->db->begin();

            /* the fields */
            $email      = $this->request->getPost('email');
            $password   = $this->request->getPost('password');
            $address    = $this->request->getPost('address');
            $address2   = $this->request->getPost('address2');
            $city       = $this->request->getPost('city');
            $state      = $this->request->getPost('state');
            $zip        = $this->request->getPost('zip');
            $status     = $this->request->getPost('check') == 'on' ? 1 : 0;

            $newUser = new UserTest();

            $newUser->date_added = time();
            $newUser->email = $email;
            $newUser->password = $this->security->hash($password);

//            var_dump(hash($password)); exit();
            $newUser->address = $address;

            if (isset($address2)) {
                $newUser->address2 = $address2;
            }

            $newUser->city = $city;
            $newUser->state = $state;
            $newUser->zip = $zip;
            $newUser->status = $status;

            if ($newUser->save()) {

                $this->db->commit();

                $this->flashSession->success("You successful added new user's information");

//                return $this->response->redirect('user_test/index');

                return $this->dispatcher->forward(
                [
                    "controller" => "user_test",
                    "action"    => "index",
                ]
            );

            } else {

                $this->db->rollback();

                $errors = $newUser->getMessages();

                foreach ($errors as $error) {
                    $this->flashSession->error($error->getMessage());
                }
            }
        }

        $this->view->users_test = $this->getAllAddresses()->toArray();
    }

    public function loginAction()
    {
        if($this->request->isPost())
        {
            $this->db->begin();

            $email      = $this->request->getPost('email');
            $password   = $this->request->getPost('password');

            $newUser = UserTest::findFirst(
              [
                  "email = :email:",
                  'bind' => ['email' => $email],
              ]
            );

            //   F08ijokl

            if ($newUser != false)
            {
                $passwordVerify = password_verify($password, $newUser->password);
                $this->db->commit();

//                var_dump($passwordVerify->getMessages()); exit();

                $this->session->set('auth', [
                    'id'    => $newUser->id,
                    'email' => $newUser->email,
                ]);

                $this->flashSession->success("Welcome! You successful logged into the information");

                return $this->dispatcher->forward(
                  [
                      "controller"  => "user_test",
                      "action"      => "index"
                  ]
                );
            } else {

                $this->db->rollback();

                $this->flashSession->error("Wrong email/password!");

                return $this->dispatcher->forward(
                    [
                        "controller"  => "user_test",
                        "action"      => "login",
                    ]
                );
            }
        }
        $this->view->users_test = $this->getAllAddresses()->toArray();
    }

    public function indexAction()
    {
        $this->view->users_test = $this->getAllAddresses()->toArray();
    }

    public function deleteAction($id)
    {
        $addressPosted = UserTest::findFirstById($id);

        if($addressPosted) {
            $addressPosted->delete();

            return $this->dispatcher->forward(
                [
                    "controller"  => "user_test",
                    "action"      => "index"
                ]
            );
//            return $this->response->redirect('user_test/index');
        } else {
            $this->flashSession->error('There is no address with this ID');
        }
    }

    public function logoutAction()
    {
        $this->session->remove('auth');
        $this->flash->success('Goodbye!');

        return $this->dispatcher->forward(
            [
                'controller' => 'index',
                'action' => 'index'
            ]
        );
    }

    private function getAllAddresses()
    {
        $addressPosted = UserTest::find([
            'order' => 'id DESC'
        ]);
        return $addressPosted;
    }
}







//            $newUser->password = password_hash($password, PASSWORD_DEFAULT);

//            $passwordHashed = password_hash($password, PASSWORD_DEFAULT);
//            $password = sha1($password);
//            var_dump($password);
//            var_dump($passwordHashed); exit();

//            $newUser = new UserTest();
//
//            $newUser->date_added = time();
//            $newUser->email = $email;
//            $newUser->password = $password;
//            $newUser->password = $passwordHashed;



//                return $this->response->redirect('user_test/index');

//                return $this->response->redirect('user_test/login');

//        /* the fields */
//        $email      = $this->request->getPost('email');
//        $password   = $this->request->getPost('password');
//        $address    = $this->request->getPost('address');
//        $address2   = $this->request->getPost('address2');
//        $city       = $this->request->getPost('city');
//        $state      = $this->request->getPost('state');
//        $zip        = $this->request->getPost('zip');
//        $status     = $this->request->getPost('check') == 'on' ? 1 : 0;
//        $submit     = $this->request->getPost('submit');

//2nd check in Session - startAction()
//        if (isset($submit)) {


//            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
//                $this->flash->error('Your email is not valid');
//                return true;
//            }
//
//            if (strlen($password) < 5) {
//                $this->flash->error('Your password is too short');
//                return true;
//            }

//            $newUserTest = new UserTest();
//            var_dump($newUserTest->getMessages()); exit();

//            $newUserTest->date_added = time();
//            $newUserTest->email = $email;
//            $newUserTest->password = $password;
//            $newUserTest->address = $address;
//
//            if (isset($address2)) {
//                $newUserTest->address2 = $address2;
//            }
//
//            $newUserTest->city = $city;
//            $newUserTest->state = $state;
//            $newUserTest->zip = $zip;
//            $newUserTest->status = $status;

//            if ($newUserTest->login()) {
//
//            } else {
//
//                $errors = $newUserTest->getMessages();
//
//                foreach ($errors as $error) {
//                    $this->flash->error($error->getMessage());
//                }
//
//                return $this->response->redirect("user_test/create");
//            }
//        }


//public function startAction()
//    {
//
//        if ($this->request->isPost())
//        {
//            /* the fields */
//            $email      = $this->request->getPost('email');
//            $password   = $this->request->getPost('password');
//            $address    = $this->request->getPost('address');
//            $address2   = $this->request->getPost('address2');
//            $city       = $this->request->getPost('city');
//            $state      = $this->request->getPost('state');
//            $zip        = $this->request->getPost('zip');
//            $status     = $this->request->getPost('check') == 'on' ? 1 : 0;
//
//        }
//
//        if(isset($submit))
//        {
//            $userTest = new UserTest();
//
//            $userTest->date_added = time();
//            $userTest->email = $email;
//            $userTest->password = $password;
//            $userTest->address = $address;
//
//            if (isset($address2)) {
//                $userTest->address2 = $address2;
//            }
//
//            $userTest->city = $city;
//            $userTest->state = $state;
//            $userTest->zip = $zip;
//            $userTest->status = $status;
//        }
//
//        $userTest = UserTest::findFirst(
//            [
//                "email = :email: AND password = :password: AND active = 'Y'",
//                'bind' => ['email' => $email, 'password' => shal1($password)],
//            ]
//        );
//
//        if($userTest)
//        {
//            $this->session->set('auth', [
//                'id'    => $userTest->id,
//                'email' => $userTest->email,
//            ]);
//
//            $this->flashSession->success("You successful register new user!");
//
//            return $this->dispatcher->forward(
//                [
//                    "controller" => 'user_test',
//                    'action'    => 'index',
//                ]
//            );
//        } else {
//            $this->flashSession->error("You have to try again!");
//            return $this->dispatcher->forward(
//                [
//                    "controller" => 'user_test',
//                    'action'    => 'create',
//                ]
//            );
//        }
//
//    }
