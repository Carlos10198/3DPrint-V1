<?php 

// carrega o composer
require_once __DIR__ . '/../vendor/autoload.php';

//atalho para Dotenv
use Dotenv\Dotenv;

try {

//abre o .env da raiz e carrega as variáveis no '$_ENV'
$dotenv = Dotenv::createImmutable(__DIR__ .'/../');
$dotenv->load();

// verifica se existe no .env
$dotenv->required(['DB_HOST', 'DB_PORT', 'DB_NAME', 'DB_USER', 'DB_PASS']);

$pdo = new PDO(
    "mysql:host={$_ENV['DB_HOST']};port={$_ENV['DB_PORT']};dbname={$_ENV['DB_NAME']};charset=utf8",
    $_ENV['DB_USER'],
    $_ENV['DB_PASS'],

    //ATTR_ERRMODE - como reage aos erros (vai exceptions)
    //ATTR_DEFAULT_FETCH_MODE - como receber os dados (nome da coluna)
    [
        PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]
);

} catch (PDOException $erropdo) {
    // erro de conexão com banco
    $logPath = __DIR__ . '/../storage/logs/errors.log';

    // PHP_EOL = quebra de linha no log
    $mensagem = '[' . date('Y-m-d H:i:s') . '] PDO: ' . $erropdo->getMessage() . PHP_EOL;

    // file_put_contents( onde gravar | o que gravar | adiciona ao final sem apagar o histórico )
    file_put_contents($logPath, $mensagem, FILE_APPEND);
    die('Erro ao conectar ao banco de dados.');

} catch (\Exception $erro) {
    // erro de variável faltando no .env ou outro erro geral
    $logPath = __DIR__ . '/../storage/logs/errors.log';
    $mensagem = '[' . date('Y-m-d H:i:s') . '] ENV: ' . $erro->getMessage() . PHP_EOL;
    file_put_contents($logPath, $mensagem, FILE_APPEND);
    die('Erro de configuração do sistema.');
}