<?php
// contato.php - Processamento básico do formulário

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nome = htmlspecialchars(trim($_POST['nome'] ?? ''));
    $email = htmlspecialchars(trim($_POST['email'] ?? ''));
    $mensagem = htmlspecialchars(trim($_POST['mensagem'] ?? ''));

    // Validação básica
    $erros = [];
    
    if (empty($nome) || strlen($nome) < 3) {
        $erros[] = "Nome inválido.";
    }
    
    if (empty($email) || !filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Email inválido.";
    }
    
    if (empty($mensagem) || strlen($mensagem) < 10) {
        $erros[] = "Mensagem muito curta (mínimo 10 caracteres).";
    }

    if (!empty($erros)) {
        echo "<h2>Erros encontrados:</h2><ul>";
        foreach ($erros as $erro) {
            echo "<li>$erro</li>";
        }
        echo "</ul>";
        echo '<p><a href="index.html">Voltar ao formulário</a></p>';
        exit;
    }

    // Aqui você poderia implementar envio de email real:
    // mail("seuemail@exemplo.com", "Nova mensagem de $nome", $mensagem, "From: $email");
    
    // Por enquanto, exibe confirmação
    echo "<!DOCTYPE html>
    <html lang='pt-BR'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Mensagem Enviada</title>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body style='font-family: Arial, sans-serif; text-align: center; padding: 50px;'>
        <h1 style='color: #27ae60;'>Mensagem Enviada com Sucesso!</h1>
        <p>Obrigado, <strong>$nome</strong>! Sua mensagem foi recebida.</p>
        <p>Em uma implementação real, o email seria enviado para o proprietário do currículo.</p>
        <a href='index.html' class='btn' style='display: inline-block; margin-top: 20px;'>Voltar ao Currículo</a>
    </body>
    </html>";
} else {
    header("Location: index.html");
    exit;
}
?>