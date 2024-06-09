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

        public $status = array('codigo_status' => null, 'descricao_status' => '');

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
        // die();

        // redirecionando usuario
        header('Location: ../pages/index.php');
    }

    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try {
        //Server settings
        $mail->SMTPDebug = false;                      //Enable verbose debug output | SMTP::DEBUG_SERVER
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'nulltreads@gmail.com';                     //SMTP username
        $mail->Password   = 'yvbd cmpe wqdy jbkm';                               //SMTP password
        $mail->SMTPSecure = 'tls';                               //Enable implicit TLS encryption | PHPMailer::ENCRYPTION_SMTPS
        $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

        //Recipients
        $mail->setFrom('nulltreads@gmail.com', 'Remetente PHPMailer');
        $mail->addAddress($msg->__get('para'));     //Add a recipient
        // $mail->addAddress('ellen@example.com');               //Name is optional
        // $mail->addReplyTo('info@example.com', 'Information');   Encaminhar mais respostas para uma terceira pessoa
        // $mail->addCC('cc@example.com');           destinatario em cópia
        // $mail->addBCC('bcc@example.com');         destinataio em cópia OCULTA

        //Attachments | anexos
        // $mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
        // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name

        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $msg->__get('assunto');
        $mail->Body    = $msg->__get('mensagem');
        $mail->AltBody = 'Infelizmente seu email não aceita a renderização de HTML.';

        $mail->send();

        // definindo novo attr status
        $msg->status['codigo_status'] = 1;
        $msg->status['descricao_status'] = 'E-mail enviado com sucesso!';

    } catch (Exception $e) {

        // definindo novo attr status
        $msg->status['codigo_status'] = 2;
        $msg->status['descricao_status'] = 'Não foi possivel enviar o email. Detalhes do erro: ' . $mail->ErrorInfo;

        // Podemos usar aqui alguma logica para armazenar os erros!
    }

    // testes
    // print_r($msg);
?>

<!doctype html>
<html lang="en">
    <head>
        <title>Send Mail</title>
        <!-- Required meta tags -->
        <meta charset="utf-8" />
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no"
        />

        <!-- Bootstrap CSS v5.2.1 -->
        <link
            href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
            rel="stylesheet"
            integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
            crossorigin="anonymous"
        />
    </head>

    <body>
        <!-- container S -->
        <div class="container">
            <!-- head S -->
            <div class="py-3 text-center">
                <img src="../imgs/logo.jpg" alt="" class="d-block mx-auto mb-2" width='10%' height='10%'>
                <h2>Send Mail</h2>
                <p class="lead">Seu app de envio de e-mails!</p>
            </div>

            <!-- row S -->
                <div class="row">
                    <!-- col S -->
                    <div class="col-md-12">
                        <!-- fluxo sucesso -->
                        <?php
                            if($msg->status['codigo_status'] == 1) {
                        ?>
                            <div class="container">
                                <h1 class="display-4 text-success">Sucesso</h1>
                                <p><?= $msg->status['descricao_status'] ?></p>
                                <a href="../pages/index.php" class='btn btn-success btn-lg mt-5 text-white'>Voltar</a>
                            </div>
                        <?php } ?>

                        <!-- fluxo erro -->
                        <?php
                            if($msg->status['codigo_status'] == 2) {
                        ?>
                            <div class="container">
                                <h1 class="display-4 text-danger">Ops...</h1>
                                <p><?= $msg->status['descricao_status'] ?></p>
                                <a href="../pages/index.php" class='btn btn-success btn-lg mt-5 text-white'>Voltar</a>
                            </div>
                        <?php } ?>
                    </div>
                    <!-- col E -->

                </div>
            <!-- row E -->

            <!-- head E -->
        </div>
        <!-- container E -->

        <!-- Bootstrap JavaScript Libraries -->
        <script
            src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
            integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
            crossorigin="anonymous"
        ></script>

        <script
            src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
            integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
            crossorigin="anonymous"
        ></script>
    </body>
</html>
