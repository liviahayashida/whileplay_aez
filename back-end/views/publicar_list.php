<?php
require_once __DIR__ . '/../models/Publicar.php';

$publicar = new Publicar();
$dados = $publicar->listar();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Lista de Publicações</title>

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
        padding: 0;
        background-color: #262626; /* grafite escuro */
        background-image: url('../public/MEDIA/imagens/backgroundclean.png');
        background-size: cover;
        background-position: center;
    }

    header {
        text-align: center;
        padding: 25px 0;
        background: rgba(0, 0, 0, 0.45);
        backdrop-filter: blur(4px);
        margin-bottom: 40px;
        border-bottom: 1px solid #3a3a3a;
    }

    header h1 {
        color: #e6e6e6;
        text-transform: uppercase;
        font-size: 30px;
        letter-spacing: 2px;
    }

    main {
        max-width: 900px;
        margin: auto;
        padding: 20px;
    }

    /* BOTÃO "Nova Publicação" */
    a.add {
        display: inline-block;
        background-color: #48aaff;
        color: #000;
        font-weight: 800;
        padding: 14px 26px;
        border-radius: 10px;
        text-decoration: none;
        text-transform: uppercase;
        transition: 150ms ease;
        margin-bottom: 25px;
        letter-spacing: 1px;
        box-shadow: 0px 4px 10px rgba(72,170,255,0.4);
    }

    a.add:hover {
        background-color: #1da0ff;
        color: #fff;
        box-shadow: 0px 4px 20px rgba(72,170,255,0.7);
    }


    /* CARTÕES DE PUBLICAÇÕES */
    .card {
        background-color: #2e2e2e;
        padding: 25px 28px;
        border-radius: 14px;
        margin-bottom: 22px;

        box-shadow:
            0px 10px 20px rgba(255, 255, 255, 0.05),
            0px 25px 35px rgba(0, 0, 0, 0.5),
            0px 10px 20px rgba(255, 255, 255, 0.06);

        border-left: 4px solid #48aaff;
    }

    .card h3 {
        color: #e6e6e6;
        text-transform: uppercase;
        letter-spacing: 1px;
        margin-top: 0;
        margin-bottom: 12px;
    }

    .card p {
        color: #dcdcdc;
        line-height: 1.4;
        margin: 6px 0;
    }

    .card img {
        border-radius: 8px;
        margin-top: 10px;
        width: 100%;
        max-width: 240px;
        box-shadow: 0px 0px 12px rgba(72,170,255,0.45);
    }

    /* BOTÕES */
    .actions {
        margin-top: 18px;
    }

    .actions a.edit {
        background: #48aaff;
        color: #000;
        padding: 10px 18px;
        border-radius: 8px;
        text-decoration: none;
        font-weight: 700;
        text-transform: uppercase;
        margin-right: 10px;
        transition: 150ms ease-in-out;
        box-shadow: 0px 4px 10px rgba(72,170,255,0.4);
    }

    .actions a.edit:hover {
        background: #1da0ff;
        color: #fff;
        box-shadow: 0px 4px 20px rgba(72,170,255,0.7);
    }

    .actions button.delete {
        border: none;
        background: #ff4f4f;
        color: #fff;
        padding: 10px 18px;
        border-radius: 8px;
        cursor: pointer;
        font-weight: 700;
        text-transform: uppercase;
        transition: 150ms ease-in-out;
        box-shadow: 0px 4px 10px rgba(255,80,80,0.4);
    }

    .actions button.delete:hover {
        background: #ff2e2e;
        box-shadow: 0px 4px 15px rgba(255,60,60,0.6);
    }
</style>

</head>
<body>
    <header>
        <h1>Lista de Publicações</h1>
    </header>

    <main>
        <a class="add" href="/GitHub/whileplay_aez/whileplay_aez/back-end/views/publicar_form.php">➕ Nova Publicação</a>

        <section id="listaPublicacoes">
            <?php if (empty($dados)): ?>
                <p>Nenhuma publicação encontrada.</p>
            <?php else: ?>
                <?php foreach ($dados as $pub): ?>
                    <div class="card">
                        <h3><?php echo htmlspecialchars($pub['titulo'] ?? '(Sem título)'); ?></h3>
                        <p>
                            <b>ID:</b> <?php echo (int)($pub['id'] ?? 0); ?>
                            <b>Tipo:</b> <?php echo htmlspecialchars($pub['tipo'] ?? ''); ?>
                        </p>
                        <p><b>Status:</b> <?php echo htmlspecialchars($pub['status'] ?? ''); ?></p>
                        <p><b>Usuário:</b> <?php echo htmlspecialchars($pub['usuario_id'] ?? ''); ?></p>

                        <?php if (!empty($pub['arquivo_url'])): ?>
                            <?php
                                $arquivoVal = $pub['arquivo_url'];
                                $isAbsolute = preg_match('~^(https?:)?//~i', $arquivoVal) || strpos($arquivoVal, '/') === 0;
                                $imgSrc = $isAbsolute ? $arquivoVal : '/GitHub/whileplay_aez/whileplay_aez/front-end/public/MEDIA/imagens/' . $arquivoVal;
                            ?>
                            <p><img src="<?php echo htmlspecialchars($imgSrc); ?>" alt="imagem" style="max-width:200px; display:block; margin-bottom:8px;" /></p>
                        <?php endif; ?>

                        <p><?php echo nl2br(htmlspecialchars($pub['sinopse'] ?? '(Sem sinopse)')); ?></p>

                        <div class="actions">
                            <!-- Link de editar abre o formulário com ?id=... -->
                            <a class="edit" href="/GitHub/whileplay_aez/whileplay_aez/back-end/views/publicar_form.php?id=<?php echo (int)$pub['id']; ?>">
                                Editar
                            </a>

                            <!-- Formulário, deletar (envia id) -->
                            <form method="post" action="/GitHub/whileplay_aez/whileplay_aez/back-end/public/delete-publicar" style="display:inline" onsubmit="return confirm('Deseja realmente excluir esta publicação?')">
                                <input type="hidden" name="id" value="<?php echo (int)$pub['id']; ?>" />
                                <button type="submit" class="delete">Excluir</button>
                            </form>
                        </div>
                    </div>
                <?php endforeach; ?>
            <?php endif; ?>
        </section>
    </main>
</body>
</html>
