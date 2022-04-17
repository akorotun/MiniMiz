<?php
    require 'DB.php';

    class LinksModel
    {
        private $link_long;
        private $link_short;

        private $_db = null;


        public function __construct()
        {
            $this->_db = DB::getInstence();
        }


        public function setData($link_long, $link_short)
        {
            $this->link_long = $link_long;
            $this->link_short = $link_short;
        }

        public function validLink()
        {
//          $link_x = $this->linkVerification($_SERVER["SERVER_NAME"] . '/s/' . $this->link_short);
            $link_x = $this->linkVerification($this->link_short);

            if ($link_x['link_short'] != [])
                return "Такая сокращенная ссылка уже есть в базе";
            else
                return 'Верно';
        }

        public function linkVerification($link_short)
        {
            $result = $this->_db->query("SELECT * FROM `links` WHERE `link_short` = '$link_short'");
            return $result->fetch(PDO::FETCH_ASSOC);
        }


        public function addLinks()
        {
                $sql = 'INSERT INTO links(link_long, link_short, user_id) VALUES(:link_long, :link_short, :user_id)';
                $query = $this->_db->prepare($sql);

                $user_id = $this->getAuthUser();

//              $user_id = 1;// временно для проверки
//              $link_short = $_SERVER["SERVER_NAME"] . '/s/' . $this->link_short;
                $link_short = $this->link_short;
                $query->execute(['link_long' => $this->link_long, 'link_short' => $link_short, 'user_id' => $user_id]);
        }

        public function getAuthUser()
        {
            $login = $_COOKIE['login'];
            $result = $this->_db->query("SELECT `id`, `login` FROM `users` WHERE `login` = '$login'");
            $user_login = $result->fetch(PDO::FETCH_ASSOC);//преобразуем данные из базы данных в ассоциативный массив
            return $user_login['id'];
        }

        public function getLinks()
        {
            $user_id = $this->getAuthUser();
            $result2 = $this->_db->query("SELECT * FROM `links` WHERE `user_id` = '$user_id'ORDER BY `id` DESC ");
            return $result2->fetchAll(PDO::FETCH_ASSOC);//преобразуем данные из базы данных в ассоциативный массив
        }

        public function deleteLinks($id)
        {
            $sql = 'DELETE FROM links WHERE `id` = ?';
            $query = $this->_db->prepare($sql);
//            var_dump($id);
//            die();
            $query->execute([$id]);
        }
    }


