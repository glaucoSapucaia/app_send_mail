<?php
    // super global $_POST
    // Armazena dados enviados pelo usuário atravé sde formulários
    // print_r($_POST);

    // importando LIBS
    require "./php_mailer/Exception.php";
    require "./php_mailer/OAuthTokenProvider.php";
    require "./php_mailer/OAuth.php";
    require "./php_mailer/PHPMailer.php";
    require "./php_mailer/POP3.php";
    require "./php_mailer/SMTP.php";

    // namespace
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    // Objeto EMAIL
    class Mensagem {
        // attrs
        private $para = null;
        private $assunto = null;
        private $mensagem = null;

        // getters | setters
        public function __get($attr) {
            return $this->$attr;
        }

        public function __set($attr, $valor) {
            $this->$attr = $valor;
        }

        // metodos
        public function mensagemValida() {
            // validando emails
            if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
                return false;
            }
            return true;
        }
    }

    // instancias
    $msg = new Mensagem();

    // aplicando valores
    $msg->__set('para', $_POST['para']);
    $msg->__set('assunto', $_POST['assunto']);
    $msg->__set('mensagem', $_POST['mensagem']);

    // Valdinado mensagens
    if(!$msg->mensagemValida()) {
        echo 'Mensagem não Válida';

        // die() -> encerra a aplicação imediatamente
        die();
    }

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'nulltreads@gmail.com';                     //SMTP username
        $mail->Password   = 'yvbd cmpe wqdy jbkm';                               //SMTP password
        $mail->SMTPSecure = 'tls';                               //Enable implicit TLS encryption | PHPMailer::ENCRYPTION_SMTPS
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('nulltreads@gmail.com', 'Remetente PHPMailer');
        $mail->addAddress('nulltreads@gmail.com', 'Destinatario PHPMailer');     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');   Encaminhar mais respostas para uma terceira pessoa
        // $mail->addCC('cc@example.com');           destinatario em cópia
        // $mail->addBCC('bcc@example.com');         destinataio em cópia OCULTA

        //Attachments | anexos
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Assunto do email';
        $mail->Body    = 'Conteudo do <strong>e-mail</strong>';
        $mail->AltBody = 'Conteudo do e-mail';

        $mail->send();
        echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Não foi possivel enviar o email. Detalhes do erro: {$mail->ErrorInfo}";
    }

    // testes
    // print_r($msg);
?>