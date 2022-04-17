<?php
    //Подключаем autoloader
    require 'vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    class ContactModel {
        private $name;
        private $email;
        private $age;
        private $message;

        public function setData($name, $email, $age, $message)
        {
            $this->name = $name;
            $this->email = $email;
            $this->age = $age;
            $this->message = $message;
        }

        //проверим поля в форме
        public function validForm() {
            if (strlen($this->name) < 3)
                return "Имя слишком короткое";
            elseif (strlen($this->email) < 3)
                return "Email слишком короткий";
            elseif (!is_numeric($this->age) || $this->age <= 0 || $this->age > 90)
                //если пользователь ввел не число или ноль или число больше 90, то будет выдавать ошибку
                return "Вы ввели не возраст";
            elseif (strlen($this->message) < 10)
                return "Сообщение слишком короткое";
            else
                return 'Верно';
        }

        //отправка сообщения на электронный адрес
        public function phpMailer()
        {

            $mail = new PHPMailer(true);

            $Parsedown = new Parsedown();
            $text1 = $this->message;

            try {
                $mail->isSMTP(); //Send using SMTP
                $mail->Host = 'smtp.mailtrap.io'; //Set the SMTP server to send through
                $mail->SMTPAuth = true; //Enable SMTP authentication
                $mail->Username = 'c6ee5ab5aa6623'; //SMTP username
                $mail->Password = '87904bc45c78e8'; //SMTP password
                //$mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS; //Enable implicit TLS encryption
                $mail->Port = 2525; //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                //Recipients
                $mail->setFrom($this->email);
                $mail->addAddress('korotun.it@gmail.com'); //Add a recipient

                //Content
                $mail->isHTML(true);
                $mail->Subject = 'Here is the subject';
                $mail->Body    = $Parsedown->text($text1);
                $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

                $mail->send();
                $mes = '<b>Message has been sent.</b> 
                    <br>Отправка сообщений временно работает в режиме тестирования через mailtrap. 
                    <br>Для реальной отправки сообщения можете написать письмо по адресу korotun.it@gmail.com';
            } catch (Exception $e) {
                echo $e->getMessage();
                $mes = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
            return $mes;
        }

    }