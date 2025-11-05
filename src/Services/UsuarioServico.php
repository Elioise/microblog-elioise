<?php


//src/Services/UsuarioServico.php

class UsuarioServico
{
    private PDO $conexao;


    // Toda vez criamos um objeto baseado na clase UsuarioServico, este objeto  fará ao método de conexao na clase Conecta.
    public function __construct()
    {
        $this->conexao = Conecta::getConexao();
    }

    // Métodos CRUD pra usuarios

    // inserir (INSERT)

    public function inserir(Usuario $dadosUsuario): void
    {
        $sql = "INSERT INTO usuarios(nome, email, tipo, senha)
                    VALUES(:nome, :email, :tipo,:senha)";

        $consulta = $this->conexao->prepare($sql);

        $consulta->bindValue(":nome", $dadosUsuario->getNome());
        $consulta->bindValue(":email", $dadosUsuario->getEmail());
        $consulta->bindValue(":tipo", $dadosUsuario->getTipo());
        $consulta->bindValue(":senha", $dadosUsuario->getSenha());

        $consulta->execute();
    }


    //buscar (SELECT)
    public function buscar(): array
    {
        $sql = "SELECT * FROM usuarios ORDER BY nome";
        $consulta = $this->conexao->query($sql);
        return $consulta->fetchAll();
    }


    //buscar porID (SELECT/WHERE)

    public function buscarPorId(int $valorId):?array {

       $sql = "SELECT * FROM usuarios WHERE id = :id";
       $consulta = $this->conexao->prepare($sql);
       $consulta->bindValue(":id", $valorId);
       $consulta->execute();

       //Usando o "Elvis operator"
    //    Sobre o ?: conhecido com "Elvis Operator"
        //É uma condicional simplificada/abreviada em que, se a condição/expressão for valida (ou seja, tem dados), 
        //ela mesma é retornada. Caso contrário, é retornado null
      
 

       return $consulta->fetch() ?: null;
    }



    // atualisar (UPDATE/WHERE)

    public function atualisar(Usuario $dadosDoUsuario):void {
        $sql = "UPDATE usuarios SET nome = :nome,
        email= :email,
        tipo= :tipo,
        senha= :senha

        WHERE id = :id ";

        $consulta = $this->conexao->prepare($sql);
        $consulta->bindValue(":nome", $dadosDoUsuario->getNome());
        $consulta->bindValue(":email", $dadosDoUsuario->getEmail());
        $consulta->bindValue(":tipo", $dadosDoUsuario->getTipo());
        $consulta->bindValue(":senha", $dadosDoUsuario->getSenha());
        $consulta->bindValue(":id", $dadosDoUsuario->getId());


        $consulta->execute();






    }

}
