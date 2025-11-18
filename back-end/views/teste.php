<?php
require_once __DIR__ . '/../models/Perfil.php';
require_once __DIR__ . '/../models/Publicar.php';

$publicar = new Publicar();
$perfil = new Perfil(); // modelo que acessa tabela "perfil"

// Handle POST create/update
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post = $_POST;
    $id = !empty($post['id']) ? (int)$post['id'] : null;

    // Buscar usuario_id pelo email
    $email = trim($post['email'] ?? '');
    $usuario = $perfil->buscarPorEmail($email);

    if (!$usuario) {
        echo '<p style="color:red">Erro: Nenhum usuário encontrado com este email.</p>';
        exit;
    }

    $usuario_id = $usuario['id'];

    $dados = [
        'usuario_id' => $usuario_id,
        'titulo' => $post['titulo'] ?? null,
        'sinopse' => $post['sinopse'] ?? null,
        'tipo' => $post['tipo'] ?? null,
        'arquivo_url' => $post['arquivo_url'] ?? null,
        'publicado' => isset($post['publicado']) ? (int)$post['publicado'] : 1,
        'status' => $post['status'] ?? 'rascunho'
    ];

    try {
        if ($id) {
            $publicar->atualizar($id, $dados);
        } else {
            $publicar->criar($dados);
        }
    } catch (Exception $e) {
        echo '<p style="color:red">Erro ao salvar publicação: ' . htmlspecialchars($e->getMessage()) . '</p>';
        exit;
    }

    // Redireciona para a lista (arquivo real)
    header('Location: /GitHub/whileplay_aez/whileplay_aez/back-end/views/publicar_list.php');
    exit;
}

// If editing, load item
$editing = false;
$item = null;
if (isset($_GET['id'])) {
    $editing = true;
    $item = $publicar->buscarPorId((int)$_GET['id']);
}
?>

<style>
html {
  box-sizing: border-box;
  font-family: 'Open Sans', sans-serif;
}
*, *:before, *:after {
  box-sizing: inherit;
}

body {
  margin: 0;
  background-color: #262626; /* grafite sólido */
}

.background {
  padding: 20px;
  min-height: 100vh;
  width: 100%;

  background-image: url('../public/MEDIA/imagens/backgroundclean.png');
  background-size: cover;
  background-position: center;

  display: flex;
  justify-content: center;
  align-items: center;

  backdrop-filter: brightness(1.15);
}

.form-panel {
  background: #2f2f2f; /* grafite mais claro */
  width: 100%;
  max-width: 560px;
  padding: 40px 45px;
  border-radius: 14px;

  box-shadow:
    0 8px 20px rgba(255,255,255,0.12),
    0 25px 35px rgba(0,0,0,0.4),
    0 5px 15px rgba(255,255,255,0.1);
}

h1 {
  color: #3e3e3eff;
  text-align: center;
  margin-top: 0;
  margin-bottom: 32px;
  text-transform: uppercase;
  font-size: 28px;
  letter-spacing: 1px;
}


label {
  color: #6bc6ff;
  font-weight: 700;
  font-size: 13px;
  letter-spacing: 1px;
  text-transform: uppercase;

  display: block;
  margin-top: 18px;
  margin-bottom: 6px;
}


input,
textarea,
select {
  width: 100%;
  padding: 14px;
  background-color: #3a3a3a;
  border: 1px solid #5c5c5c;
  color: #f3f3f3;
  border-radius: 8px;
  font-size: 15px;
  transition: all .2s ease;
}

input::placeholder {
  color: #c7c7c7;
}

input:focus,
select:focus,
textarea:focus {
  background-color: #454545;
  border-color: #48aaff;
  box-shadow: 0 0 8px rgba(72,170,255,0.4);
}

input[type="submit"] {
  background-color: #48aaff;
  border: none;
  margin-top: 30px;
  padding: 16px 40px;
  border-radius: 10px;

  font-size: 16px;
  font-weight: 800;
  text-transform: uppercase;
  letter-spacing: 1px;
  color: #000;
  cursor: pointer;

  transition: all .2s ease-in-out;
}

input[type="submit"]:hover {
  background-color: #1da0ff;
  color: #fff;
  box-shadow: 0 4px 22px rgba(72,170,255,0.55);
  transform: scale(1.03);
}

.voltar {
  margin-top: 25px;
  text-align: center;
}

.voltar a {
  color: #6bc6ff;
  font-size: 14px;
  text-transform: uppercase;
  text-decoration: none;
  letter-spacing: 1px;
}

.voltar a:hover {
  text-decoration: underline;
}
</style>

<!DOCTYPE html>
<html lang="pt-br">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title><?php echo $editing ? 'Editar Publicação' : 'Nova Publicação'; ?></title>
  <style>
    body { font-family: 'Segoe UI', sans-serif; background: #f5f6fa; margin:0; padding:0; }
    main { max-width:800px; margin:2rem auto; background:#fff; padding:2rem; border-radius:8px; }
    input, textarea, select { width:100%; padding:0.6rem; margin-bottom:0.8rem; box-sizing: border-box; }
    .actions { display:flex; gap:10px; align-items:center; }
    button { background:#0097e6; color:#fff; padding:0.7rem 1rem; border:none; border-radius:4px; cursor:pointer; }
    a.button-like { display:inline-block; padding:0.7rem 1rem; border-radius:4px; text-decoration:none; background:#dcdde1; color:#2f3640; }
    a { color:#0097e6; }
  </style>
</head>
<body>
  <main>
    <h1><?php echo $editing ? 'Editar Publicação' : 'Nova Publicação'; ?></h1>

    <!-- Form envia sempre para o save-publicar (que cria ou atualiza conforme existe id) -->
    <form method="post" action="/GitHub/whileplay_aez/whileplay_aez/back-end/public/save-publicar">

      <!-- hidden id da publicação para permitir UPDATE -->
      <?php if ($editing && isset($item['id'])): ?>
          <input type="hidden" name="id" value="<?php echo (int)$item['id']; ?>">
      <?php endif; ?>

      <input type="email" name="email" placeholder="Digite seu Email" required
           value="<?php echo $editing ? htmlspecialchars($item['email'] ?? '') : ''; ?>" />

      <input type="text" name="titulo" placeholder="Título" required
           value="<?php echo $editing ? htmlspecialchars($item['titulo'] ?? '') : ''; ?>" />

      <textarea name="sinopse" placeholder="Sinopse"><?php
          echo $editing ? htmlspecialchars($item['sinopse'] ?? '') : ''; ?></textarea>

      <select name="tipo">
          <option value="roteiro" <?php echo ($editing && ($item['tipo'] ?? '') === 'roteiro') ? 'selected' : ''; ?>>Roteiro</option>
          <option value="personagem" <?php echo ($editing && ($item['tipo'] ?? '') === 'personagem') ? 'selected' : ''; ?>>Personagem</option>
      </select>

      <input type="text" name="arquivo_url" placeholder="URL do arquivo (opcional)"
           value="<?php echo $editing ? htmlspecialchars($item['arquivo_url'] ?? '') : ''; ?>" />

      <select name="status">
          <option value="rascunho" <?php echo ($editing && ($item['status'] ?? '') === 'rascunho') ? 'selected' : ''; ?>>Rascunho</option>
          <option value="publicado" <?php echo ($editing && ($item['status'] ?? '') === 'publicado') ? 'selected' : ''; ?>>Publicado</option>
          <option value="rejeitado" <?php echo ($editing && ($item['status'] ?? '') === 'rejeitado') ? 'selected' : ''; ?>>Rejeitado</option>
      </select>

      <input type="hidden" name="publicado" value="1" />

      <div class="actions">
          <button type="submit">Salvar</button>

          <a class="button-like" href="/GitHub/whileplay_aez/whileplay_aez/front-end/views/homepage2_com_assinatura.html">
              Voltar
          </a>
      </div>
    </form>
  </main>
</body>
</html>
