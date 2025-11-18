<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Pagamentos Realizados</title>
    <style>
        table {
            border-collapse: collapse;
            width: 80%;
            margin: 20px auto;
        }
        th, td {
            border: 1px solid #ccc;
            padding: 10px;
            text-align: center;
        }
        img {
            width: 100px;
            border-radius: 8px;
        }
        .card {
            margin: 20px auto;
            width: 300px;
            padding: 15px;
            border: 1px solid #aaa;
            border-radius: 10px;
            text-align: center;
        }
    </style>
</head>
<h2>Biblioteca</h2>

<?php foreach ($pagamentos as $pag): ?>
    <div style="margin-bottom: 25px; padding: 10px; border: 1px solid #ddd;">

        <h3><?= $pag['personagem_nome'] ?></h3>

        <p><?= $pag['personagem_descricao'] ?></p>

        <p><strong>Status:</strong> <?= $pag['status'] ?></p>

        <p><strong>Data:</strong> <?= $pag['created_at'] ?></p>

        <p><strong>Código:</strong> <?= $pag['codigo_identificacao'] ?></p>

        <?php if (!empty($pag['personagem_imagem'])): ?>
            <img src="/GitHub/whileplay_aez/whileplay_aez/back-end/uploads/<?= $pag['personagem_imagem'] ?>" 
                 width="200">
        <?php endif; ?>

    </div>
<?php endforeach; ?>

</html>
