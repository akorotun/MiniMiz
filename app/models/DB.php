<?php
    class DB {
        private static $_db = null;
        //реализуем шаблон подключения - одиночка
        public static function getInstence() {
            //проверяем - установлено ли соединение с базой данных. Если не установлено, то подключаем
            if (self::$_db == null) {
                self::$_db = new PDO('mysql:host=localhost;dbname=minimiz', 'root', '');
            }
            return self::$_db;
        }

        private function __construct() {}//к конструктору никто не имеет доступ
        private function __clone() {}//никто не сможет клонировать
        private function __wakeup() {}//запрет доступа к функции wakeup

    }
