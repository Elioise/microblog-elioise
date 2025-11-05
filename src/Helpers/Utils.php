<?php

//scr/Helpers/Utils.php


class Utils
{

    // Usamos mixed pra sinalisar que o metodo aceita/retorna tipos de dados variados (string, int, array, float, etc)
    public static function sanitizar(mixed $valor, string $tipoDeSanitizacao = 'texto'): mixed
    {
        switch ($tipoDeSanitizacao) {
            case 'inteiro':
                return  (int) filter_var($valor, FILTER_SANITIZE_NUMBER_INT);

            case 'email':

                return trim(filter_var($valor, FILTER_SANITIZE_EMAIL));

            default:
                return trim(filter_var($valor, FILTER_SANITIZE_SPECIAL_CHARS));
        }
    }



    public static function codificarSenha(string $valorSenha): string
    {
        return password_hash($valorSenha, PASSWORD_DEFAULT);

    }


    // Ao chamar o metodo verificarsenha, passamos pra ele a senha digitada no formulario e a senha existente no banco.

    public static function verificarSenha(
        string $senhaDigitadaNoFormulario, string $senhaArmazenadaNoBanco
    ){

        //usamos o password_verify pra comparar as duas senhas.

        if(password_verify($senhaDigitadaNoFormulario, $senhaArmazenadaNoBanco)){
            //sao iguais? então retorne a mesma senha já existente no banco

            return $senhaArmazenadaNoBanco;

        } else {
            // sao diferentes? então pega a senha digitada a faça um novo hash
            return self::codificarSenha($senhaDigitadaNoFormulario);
            // ou  return utils::codificarSenha($senhaDigitadaNoFormulario);
        }

    }

    public static function dump(mixed $dados): void
    {
        echo "<pre>";
        var_dump($dados);
        echo "</pre>";
    }

    public static function redirecionarPara(string $destino):void {
      header("location:" .$destino);
      exit;  
    }
}








//exercicio

// Crie um metodo chamada dump, faça ele receber um parâmetro chamados $dados, e faca aparecer o var_dump dentro da tag <pre>
