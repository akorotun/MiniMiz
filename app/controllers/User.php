<?php
    class User extends Controller
    {
        public function reg() {
            $data = [];
            if (isset($_POST['login'])) {
                //создаем объект user на основе класса UserModel
                $user = $this->model('UserModel');
                $user->setData($_POST['login'], $_POST['email'], $_POST['pass'], $_POST['re_pass']);

                //проверяем форму - обращаемся к функции validForm в UserModel
                $isValid = $user->validForm();
                if ($isValid == "Верно")
                    $user->addUser();// обращаемся к функции addUser в UserModel
                //если были ошибки, то в элемент message укажет ту ошибку, которая была записана в переменную $isValid
                else
                    $data['message'] = $isValid;
            }

            $this->view('user/reg', $data);
        }

        public function auth() {
            $data = [];
            if (isset($_POST['login'])) {
                $user = $this->model('UserModel');
                $data['message'] = $user->auth($_POST['login'], $_POST['pass']);
            }

            $this->view('user/auth', $data);

        }

        public function dashboard() {
            $user = $this->model('UserModel');
            //выйти из кабинета
            if (isset($_POST['exit_btn'])) {
                $user->logOut();
                exit();
            }

            $data ['user_info'] = $user->getUser();
            $this->view('user/dashboard', $data);
        }
    }
