<?php
class Conecta
{
    // Propriedades estáticas com as configurações de conexão
    private static string $servidor = "localhost";
    private static string $banco = "microblog_elioise";
    private static string $usuario = "root";
    private static string $senha = "";

    // Armazena a instância única da conexão
    private static ?PDO $conexao = null;

    // Método estático para obter a conexão
    public static function getConexao(): PDO
    {
        // Só cria a conexão uma vez
        if (self::$conexao === null) {
            try {
                self::$conexao = new PDO(
                    "mysql:host=" . self::$servidor . ";dbname=" . self::$banco . ";charset=utf8",
                    self::$usuario,
                    self::$senha
                );

                // Define os atributos padrão da conexão
                self::$conexao->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                self::$conexao->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
            } catch (PDOException $erro) {
                die("Erro ao conectar: " . $erro->getMessage());
            }
        }

        return self::$conexao;
    }
}

Conecta::getConexao();