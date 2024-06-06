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
            <!-- head E -->

            <!-- row S -->
            <div class="row">
                <!-- col S -->
                <div class="col-md-12">
                    <!-- card S -->
                    <div class="card-body fw-bold">
                        <!-- form S -->
                        <!-- action= -> destino de dados do form -->
                        <!-- method= -> post, para esconder dados -->

                        <!-- name= -> Campo necessário para a recuperação de dados do programa -->
                        <form action="../assets/processa_envio.php" method='post'>
                            <div class="form-group mb-4">
                                <label for="para">Para</label>
                                <input name='para' type="text" class="form-control" id='para' placeholder='teste@teste.com'>
                            </div>

                            <div class="form-group mb-4">
                                <label for="assunto">Assunto</label>
                                <input name='assunto' type="text" class="form-control" id='assunto' placeholder='Assunto do e-mail'>
                            </div>

                            <div class="form-group mb-4">
                                <label for="mensagem">Mensagem</label>
                                <textarea name="mensagem" id="mensagem" class="form-control"></textarea>
                            </div>

                            <!-- btn -->
                            <button class="btn btn-primary btn-lg" type='submit'>Enviar e-mail</button>
                        </form>
                        <!-- form E -->
                    </div>
                    <!-- card E -->
                </div>
                <!-- col E -->
            </div>
            <!-- row E -->
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
