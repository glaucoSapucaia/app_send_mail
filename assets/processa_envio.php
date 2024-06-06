<?php
// super global $_POST
// Armazena dados enviados pelo usuário atravé sde formulários
    // print_r($_POST);

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
    if($msg->mensagemValida()) {
        echo 'Mensagem Válida';
    } else {
        echo 'Mensagem Inválida';
    }

    // testes
    // print_r($msg);
?>