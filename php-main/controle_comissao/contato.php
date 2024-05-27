<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contato</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <style>
        label {
            color: blue;
            font-weight: bold;
        }

        textarea {
            resize: none;
        }
    </style>
</head>

<body>
    <div class="container">
        <h3 class="text-center text-info">Controle de Comissão - Contato</h3>
        <form name="contato" method="post" action="">
            <p><label>Nome:</label><br>
                <input type="text" name="nome" size="50" maxlength="50" required>
            </p>
            <p><label>E-mail:</label><br>
                <input type="email" name="email" size="30" maxlength="30" required>
            </p>
            <p><label>Cidade:</label><br>
                <input type="text" name="cidade" size="35" maxlength="35" required>
            </p>
            <p><label>Assunto:</label><br>
                <input type="text" name="assunto" size="30" maxlength="30" required>
            </p>
            <label>Mensagem:</label><br>
            <textarea name="mensagem" id="" cols="50" rows="4"></textarea>
            <p>
                <input type="submit" class="btn btn-primary" name="enviar" value="Enviar">
                <a href='principal.php' class="btn btn-danger">Voltar</a>
            </p>
        </form>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Obtém os dados do formulário
            $nome = $_POST['nome'];
            $email = $_POST['email'];
            $cidade = $_POST['cidade'];
            $assunto = $_POST['assunto'];
            $mensagem = $_POST['mensagem'];

            // Conteúdo do email
            $to = $email; // Envia para o email fornecido no formulário
            $subject = "Re: $assunto";
            $body = "Olá $nome,\n\n";
            $body .= "Obrigado por entrar em contato conosco. Aqui estão os detalhes que você forneceu:\n\n";
            $body .= "Nome: $nome\n";
            $body .= "Cidade: $cidade\n\n";
            $body .= "Mensagem:\n$mensagem\n\n";
            $body .= "Atenciosamente,\nSistema de Comissão";

            // Cabeçalhos do email
            $headers = "From: seu_email@dominio.com" . "\r\n" .
                "Reply-To: seu_email@dominio.com" . "\r\n" .
                "X-Mailer: PHP/" . phpversion();

            // Envia o email
            if (mail($to, $subject, $body, $headers)) {
                echo "Email enviado com sucesso para $email";
            } else {
                echo "Falha ao enviar email.";
            }
        } else {
            echo "Método de requisição inválido.";
        }
        ?>
    </div>
</body>

</html>