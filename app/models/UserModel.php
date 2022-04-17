<?php
    require 'DB.php';

    class UserModel
    {
        private $login;
        private $email;
        private $pass;
        private $re_pass;

        private $_db = null;

        public function __construct()
        {
            $this->_db = DB::getInstence();
        }

        public function setData($login, $email, $pass, $re_pass)
        {
            $this->login = $login;
            $this->email = $email;
            $this->pass = $pass;
            $this->re_pass = $re_pass;
        }

        //проверим поля в форме
        public function validForm()
        {
            $user_login = $this->loginVerification($this->login);

            if (strlen($this->login) < 3)
                return "Логин слишком короткий";
            elseif ($user_login['login'] != [])
                return "Пользователь с таким логином уже существует";
            elseif (strlen($this->email) < 5)
                return "Email слишком короткий";
            elseif (strlen($this->pass) < 3)
                return "Пароль должен быть не менее 3-х символов";
            elseif ($this->pass != $this->re_pass)
                return "Пароли не совпадают";
            else
                return 'Верно';
        }

        public function loginVerification($login)
        {
            $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
            return $result->fetch(PDO::FETCH_ASSOC);

        }

        //добавление пользователя в базу данных
        public function addUser()
        {
            $sql = 'INSERT INTO users(login, email, pass) VALUES(:login, :email, :pass)';
            $query = $this->_db->prepare($sql);

            //Надо пароль хешировать
            //можно использовать функции md5() или sha1(), но они уже устарели
            //функция password_hash() новая, количество символов 60,
            //но функция password_hash() еще усовершенствуется, количество символов будет больше, поэтому можно поставить сразу 255
            $pass = password_hash($this->pass, PASSWORD_DEFAULT);
            $query->execute(['login' => $this->login, 'email' => $this->email, 'pass' => $pass]);

            $this->setAuth($this->login);
        }

        public function getUser()
        {
            $login = $_COOKIE['login'];
            $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
            return $result->fetch(PDO::FETCH_ASSOC);//преобразуем данные из базы данных в ассоциативный массив
        }

        public function logOut()
        {
            setcookie('login', $this->login, time() - 3600, '/');//удаляем cookie
            unset($_COOKIE['login']);
            header('Location: /user/auth');
        }

        public function auth($login, $pass)
        {
            $result = $this->_db->query("SELECT * FROM `users` WHERE `login` = '$login'");
            $user = $result->fetch(PDO::FETCH_ASSOC);

            //сделаем проверку - существует ли такой пользователь
            if ($user['login'] == '')
                return 'Пользователя с таким логином не существует';
            //проверим пароль - есть спец функция password_verify
            else if (password_verify($pass, $user['pass']))
                $this->setAuth($login);
            else
                return 'Неверный пароль';
        }

        public function setAuth($login)
        {
            setcookie('login', $login, time() + 3600, '/');
            header('Location: /user/dashboard');
        }
    }
