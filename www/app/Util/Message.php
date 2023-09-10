<?php

namespace App\Util;

class Message
{
    public const NAME_REQUIRED = 'Forneça um nome!';
    public const PASSWORD_REQUIRED = 'Forneça uma senha!';
    public const EMAIL_REQUIRED = 'Forneça um e-mail!';
    public const DIFFERENT_PASSWORD = 'As senhas devem ser iguais!';
    public const NOT_A_POST = 'A solicitação deve ser do tipo post!';
    public const NOT_SAVE = 'Não foi possivel salvar os dados!';
    public const SAVED_SUCCESSFULLY = 'Dados salvos com sucesso!';
    public const NOT_DELETED = 'Falha ao deletar!';
    public const NOT_RESTORE = 'Falha ao restaurar!';
    public const REGISTER_NOT_FOUND = 'Registro não encontrado!';
    public const INCORRECT_PASSWORD = 'Senha incorreta!';
}