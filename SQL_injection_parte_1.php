<?php

   // Neste exemplo sera criada uma aplicação de login e sera entendido como funciona o ataque de 
  // sql injection.

  // Com a logica de login pronta vou executar um sqlinjection

  // na tela de login aperta f12 para abrir as ferramentas de desenvolvimento
  // depois alterar o type do campo de password para text 
  // como a leitura da senha compoe uma instruçao SQL
  // depois da senha digitada coloca uma aspa simples e um ;
  // para inicar o fim de uma consulta e iniciar outra
 // se o ataque for para apagar os usuarios da tabela basta escrever um instrução de delete 
 // no caso texto contido no campo fica assim 
 // a senha deve ser valida pr acionar a logica que executa a querie a comparaçao de 'a'='a
 // e pra ter um retorno de true na querie
 // a ultima aspa simples não foi colocada de proposito porue ela ja existe na sintaxe
 // interna entao o pirmiro a tem duas aspas eo segundo so tem 1
 //123456';delete from tb_usuarios where 'a'='a

  

   if (!empty($_POST['usuario']) && !empty($_POST['senha'])){
 

   $dsn = 'mysql:host=localhost;dbname=php_com_pdo';
   $usuario = 'root';
   $senha = '';

 
 

    try{

       $conexao = new PDO($dsn,$usuario,$senha);

       // query

       $query ="  select * from tb_usuarios where ";
       $query .=" email ='{$_POST['usuario']}'";
       $query .=" and senha ='{$_POST['senha']}'";

       

       $stmt = $conexao->query($query);
       $usuario = $stmt->fetch();

       echo "<pre>";
      print_r($usuario);
       echo "</pre>";

       

      


    }catch(PDOException $e){
      


       echo "Erro: ".$e -> getCode()."mensagem: ".$e->getMessage();


    }

  }


?>

<!DOCTYPE html>
<html>
<head>
  <title>Login</title>
</head>
<body>

  <form method="POST" action="index.php">

    <input type="text" name="usuario" placeholder="usuario">
    <br>
    <input type="password" name="senha" placeholder="senha">
    <br>
    <input type="submit" value="Entrar">
  </form>

</body>
</html>