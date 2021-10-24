

<?php

 

   $dsn = 'mysql:host=localhost;dbname=php_com_pdo';
   $usuario = 'root';
   $senha = '';

 

    try{

    	 $conexao = new PDO($dsn,$usuario,$senha);

    	 // executando instruções SQL 
    	 // a instruçao IF NOT EXISTS é necessaria pra evitar a tentativa de criaçao de uma tabela toda vez que o codigo for executado.

    	 $query ="

    	 CREATE TABLE IF NOT EXISTS tb_usuarios(
                  id int not null primary key auto_increment,
                  nome varchar(50) not null,
                  email varchar(100) not null,
                  senha varchar(32) not null
    	 )

    	 ";

    	 // agora pra executar tem que chamar o metodo exec e indicar a ele a varivel que esta com query

    	 $retorno = $conexao -> exec($query);

    	 // neste coso ele vai retonar 0 porque essa opraçao nao vai afetar linhas
    	 // mas essa opraçao fosse um delete, update, ele retornaria o numero de linhas afetadas
    	 // ate se fosse um select ele retonaria 0 porque sele so seleciona e nao afeta nada. 

    	 echo $retorno;


    	 $query =" 

    	   DELETE  FROM tb_usuarios;            
    	 ";

    	 $retorno = $conexao -> exec($query); 
    	 //ele retorna 5 porque 5 linhas foram afetadas
    	  echo $retorno;










    }catch(PDOException $e){
      


       echo "Erro: ".$e -> getCode()."mensagem: ".$e->getMessage();


    }


?>