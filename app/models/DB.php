<?php
    class DB {
        private static $_db = null;
        //реализуем шаблон подключения - одиночка
        public static function getInstence() {
            //проверяем - установлено ли соединение с базой данных. Если не установлено, то подключаем
            if (self::$_db == null) {
                $configPath = __DIR__ . '/../../config/db.php';

                try {
                    if (!is_file($configPath) || !is_readable($configPath)) {
                        throw new RuntimeException();
                    }

                    $config = @include $configPath;
                    if (!is_array($config)
                        || !isset($config['dsn'], $config['username'], $config['password'])
                        || !is_string($config['dsn']) || $config['dsn'] === ''
                        || !is_string($config['username']) || !is_string($config['password'])) {
                        throw new RuntimeException();
                    }

                    self::$_db = new PDO($config['dsn'], $config['username'], $config['password']);
                } catch (Throwable $exception) {
                    http_response_code(500);
                    exit('Service temporarily unavailable.');
                }
            }
            return self::$_db;
        }

        private function __construct() {}//к конструктору никто не имеет доступ
        private function __clone() {}//никто не сможет клонировать
        private function __wakeup() {}//запрет доступа к функции wakeup

    }
