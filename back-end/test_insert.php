<?php
require_once __DIR__ . '/config/db.php';

$sql = "INSERT INTO perfil (nome_completo, username, email, senha)
        VALUES ('Teste Nome', 'testeuser', 'testeuser@email.com', '123456')";
$pdo->exec($sql);

echo "✅ Inserção de teste feita com sucesso!";
?>
