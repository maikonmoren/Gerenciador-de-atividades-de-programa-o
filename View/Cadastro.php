<html>

<head>
    <meta charset="UTF-8">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet"></link>
    <link rel="stylesheet" href="../vedor/css/snippets.css">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/1000hz-bootstrap-validator/0.11.9/validator.min.js"></script>
    <link rel="shortcut icon" href="../Img/logo_size_1.jpg">
    <title>CD-Web Inscrição</title>
</head>
  <style>
        body {
            background: white;
            background: linear-gradient(to top, yellowgreen, greenyellow);
        }
        .has-error label,
        .has-error input,
        .has-error textarea {
            color: red;
            border-color: red;
        }

        .list-unstyled li {
            font-size: 13px;
            padding: 4px 0 0;
            color: red;
        }
    </style>
<body>
  
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="card card-signin my-5">
                    <div class="card-body">
                        <h1 class="card-title text-center" style="color: whitesmoke; background-color: yellowgreen">CD-WE- Inscrição</h1>
                        <form role="form" class="form-signin" action="../action/pessoaAction.php" method="POST" data-toggle="validator">
                    <div class="form-group">
                        <label>Nome</label>
                        <input type="text" class="form-control"  id="inputName" placeholder="Nome" name="nome" required>
                        <!-- Error -->
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        <label>Nome de usúario</label>
                        <input type="text" class="form-control" name="usuario" 
                        pattern="^[a-zA-Z0-9_.-]*$" id="inputUsername" placeholder="Usúario" required>

                        <!-- Error -->
                        <div class="help-block with-errors"></div>
                    </div>

                    <div class="form-group">
                        <label>E-mail</label>
                        <input type="email" class="form-control" name="email" id="inputEmail" placeholder="E-mail" required>

                        <!-- Error -->
                        <div class="help-block with-errors"></div>
                    </div>

                     <div class="form-row">
                    <div class="form-group col ">
                        <label>Senha</label>
                        <div class="form-group ">
                            <input type="password" name="senha" data-minlength="4" data-error="Minimo de 6 caracteres." minlength="6" class="form-control" id="inputPassword"
                                placeholder="Senha" required />

                            <!-- Error -->
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>

                    <div class="form-group col">
                        <label>Confirmar senha</label>
                        <div class="form-group">
                            <input type="password" class="form-control" id="inputConfirmPassword"
                                data-match="#inputPassword" data-match-error="Senhas diferentes "
                                placeholder="Confirmar senha" required />

                            <!-- Error -->
                            <div class="help-block with-errors"></div>
                        </div>
                    </div>
                         
                     </div>
                        <div class="form-group">
                                     <label>Caminho da JDK</label><br>
                                     <small>Coloque o caminho até a pasta onde se encontra os executáveis  do Java </small><br>
                        <input type="url" class="form-control" name="jdk" id="inputEmail" placeholder="Ex.C:\Program Files\Java\jdk1.8.0_111\bin" required>

                        <!-- Error -->
                        <div class="help-block with-errors"></div>
                    </div>
                    <div class="form-group">
                        <input name="opt" id="opt" value="registro" hidden/>
                            <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">Confirmar inscrição</button>
                            <hr class="my-4">
                    </div>
                
                </form>
                   <form action="../index.php" class="form-signin">
                            <button class="btn btn-lg btn-warning btn-block text-uppercase">Voltar para login</button>
                   </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
      
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <!-- Popper.JS -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.0/umd/popper.min.js" integrity="sha384-cs/chFZiN24E4KMATLdqdvsezGxaGsi4hLGOzlXwp5UZB1LY//20VyM2taTB4QvJ" crossorigin="anonymous"></script>
    <!-- Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.0/js/bootstrap.min.js" integrity="sha384-uefMccjFJAIv6A+rW+L4AHf99KvxDjWSu1z9VI8SKNVmz4sk7buKt/6v9KI65qnm" crossorigin="anonymous"></script>
  
    <script>  
    </script>
</body>

</html>
