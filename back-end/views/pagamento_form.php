<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pagamento</title>
    <style>
        body { font-family: Arial; background:#f7f7f7; padding:20px; }
        form { background:#fff; padding:20px; width:380px; margin:auto; border-radius:10px; }
        input { width:100%; padding:10px; margin-bottom:12px; border-radius:5px; border:1px solid #ccc; }
        button { background:#4CAF50; color:white; padding:10px; width:100%; border:none; border-radius:5px; cursor:pointer; }
        button:hover { background:#45a049; }
    </style>
</head>
<body>

<h2 style="text-align:center;">Pagamento</h2>

<form action="/GitHub/whileplay_aez/whileplay_aez/back-end/public/save-pagamento" method="POST">

    <input type="email" name="email" placeholder="Digite seu e-mail" required>

    <input type="text" name="codigo_identificacao" placeholder="Código de identificação do produto" required>

    <input type="text" name="nome_cartao" placeholder="Nome no cartão" required>

    <input type="text" name="numero_cartao" placeholder="Número do cartão" required>

    <label>Data de vencimento</label>
    <input type="date" name="data_vencimento" required>

    <input type="text" name="codigo" placeholder="Código (CVV)" maxlength="4" required>

    <button type="submit">Pagar</button>
</form>

</body>
</html>
