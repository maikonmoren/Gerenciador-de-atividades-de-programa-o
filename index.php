<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <link href="vedor/css/bootstrap.css" rel="stylesheet">
        <link href="vedor/css/snippets.css" rel="stylesheet">
        <link rel="shortcut icon" href="img/logo_size_1.jpg">
        
        <title></title>
    </head>
    <body>
  <div class="container">
    <div class="row">
      <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
        <div class="card card-signin my-5">
          <div class="card-body">
              <h1 class="card-title text-center" style="color: whitesmoke; background-color: yellowgreen">TCC-WEB</h1>
            <h5 class="card-title text-center">Login</h5>
            <form  action="action/pessoaAction.php" method="post" class="form-signin">
              <div class="form-label-group">
                  <input type="text" id="txt_usuario" name="usuario" class="form-control" placeholder="Nome de usúario" required autofocus>
                <label for="txt_usuario">Nome de usúario</label>
              </div>
              <div class="form-label-group">
                  <input type="password" name="senha" id="txt_senha" class="form-control" placeholder="Senha" required>
                <label for="txt_senha">Senha</label>
              </div>
                <input name="opt" id="opt" value="login" hidden/>
                <button class="btn btn-lg btn-success btn-block text-uppercase" type="submit">Entrar</button>
              
              <hr class="my-4">
             </form>
            <form action="View/Cadastro.php" class="form-signin">
            <button class="btn btn-lg btn-warning btn-block text-uppercase">Inscrever-se</button>           
            </form>
             
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
