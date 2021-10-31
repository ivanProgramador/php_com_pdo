<?php

  

   if (!empty($_POST['usuario']) && !empty($_POST['senha'])){
 

   $dsn = 'mysql:host=localhost;dbname=php_com_pdo';
   $usuario = 'root';
   $senha = '';

 

    try{

       $conexao = new PDO($dsn,$usuario,$senha);

       $query = "select * from tb_usuarios";
       $query .=" where email = :usuario";
       $query .=" and   senha = :senha";

      // tratando o risco de sql injection 

       $stmt = $conexao->prepare($query);

      // existe um metodo chamado bindValue('','') que trata as questões em rela a sql injection
      // ele faz a analise do comendo recebido e trata as variveis recebidas
       // no primeiro parametro ele recebe uma variavel ue vai representar o valor vendo do campo
       // no segundo ele recebe o valor de fato ou seja ele analisa o valor que veio
       // o binValue tambem permite configurar que tipo de dado sera considerado ou desconsiderado
       // NO CASO ABAIXO O TERCEIRO PARAMETRO DIZ QUE ELE VAI CONSIDERAR SOMENTE NUMEROS E IGNORAR QUALQUER OUTRA COISA QUE VENHA DESTE CAMPO.

       //   $stmt->bindValue(':senha',$_POST['senha'],PDO::PARAM_INT);



       $stmt->bindValue(':usuario',$_POST['usuario']);
       $stmt->bindValue(':senha',$_POST['senha']);

       // executando a querye

       $stmt -> execute();
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