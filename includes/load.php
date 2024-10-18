<?php
/**
 * Este ficheiro serve como um "modularizador", responsável por agrupar e centralizar
 * todas as funções e classes comuns a serem utilizadas em diferentes partes do sistema.
 *
 * Qualquer arquivo que necessite de funcionalidades compartilhadas, como conexões de banco de dados,
 * funções utilitárias, constantes ou classes comuns, deve incluir este ficheiro.
 *
 * Ao manter as funcionalidades modulares, promove-se a reutilização de código, manutenção simplificada
 * e maior organização do projeto, evitando duplicação de lógica e facilitando o desenvolvimento.
 */


require_once("database.php");
require_once("session.php");