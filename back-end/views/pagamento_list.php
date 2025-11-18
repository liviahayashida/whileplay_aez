<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Biblioteca - Pagamentos Realizados</title>
    <link href="https://fonts.googleapis.com/css2?family=Adamina&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">

    <style>
        /* RESET BÁSICO */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: "Roboto", sans-serif;
            font-size: 16px;
            background-color: #222222; /* Cor de fundo da referência */
            color: #fff;
        }
        header {
            width: 100%;
            margin: 0;
            padding: 0;
        }
        .header-container {
            /* Imagem de fundo deve ser ajustada para o caminho correto */
            background-image: url('../../front-end/public/MEDIA/imagens/background.png');
            background-color: #333; /* Cor de fallback */
            background-size: cover;
            background-position: center;
            padding: 40px 0;
            width: 100%;
        }
        .navbar {
            display: flex;
            justify-content: space-around;
            align-items: center;
            flex-wrap: wrap;
            gap: 20px;
            padding: 0 20px;
        }
        .navbar a {
            color: rgb(255, 255, 255);
            text-decoration: none;
            font-weight: bold;
            font-size: 18px;
            padding: 10px 15px;
            transition: background 0.3s, color 0.3s;
        }
        .navbar a:hover {
            background-color: rgba(255, 255, 255, 0.2);
            border-radius: 8px;
        }
        .search-box {
            background: white;
            border-radius: 30px;
            padding: 10px 15px;
            display: flex;
            align-items: center;
        }
        .search-box input {
            border: none;
            outline: none;
            padding: 8px;
            font-size: 16px;
            font-family: 'Adamina', serif;
        }
        .search-box span {
            font-size: 18px;
            cursor: pointer;
            margin-left: 8px;
            color: #333; /* Ajuste para ser visível no fundo branco */
        }
                
        /* PERFIL */
        .user-profile-area {
        display: flex;
        align-items: center;
        gap: 10px;
        }

        .subscription-badge {
        background-color: rgba(255, 255, 255, 0.2);
        border-radius: 20px;
        padding: 5px 10px;
        display: flex;
        align-items: center;
        gap: 5px;
        color: #FFD700;
        font-size: 14px;
        font-weight: bold;
        }

        .subscription-badge .material-icons,
        .dropdown-content .premium-option .material-icons {
        font-size: 16px;
        color: #FFD700;
        }

        .profile-icon {
        background-color: white;
        color: #007bff;
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        justify-content: center;
        align-items: center;
        cursor: pointer;
        transition: background 0.3s, transform 0.2s;
        box-shadow: 0 2px 5px rgba(0,0,0,0.2);
        position: relative;
        }

        .profile-icon a {
        color: #007bff;
        text-decoration: none;
        display: flex;
        align-items: center;
        justify-content: center;
        width: 100%;
        height: 100%;
        }

        .profile-icon:hover {
        background-color: #e0e0e0;
        transform: scale(1.1);
        }

        .profile-icon .material-icons {
        font-size: 24px;
        }

        .verified-badge {
        position: absolute;
        bottom: -5px;
        right: -5px;
        background-color: #FFD700;
        border-radius: 50%;
        width: 20px;
        height: 20px;
        display: flex;
        justify-content: center;
        align-items: center;
        border: 2px solid white;
        }

        .verified-badge .material-icons {
        font-size: 14px;
        color: #333;
        }

        /* DROPDOWN PERFIL */
        .profile-dropdown {
        position: relative;
        display: inline-block;
        }

        .dropdown-content {
        display: none;
        position: absolute;
        right: 0;
        background-color: white;
        min-width: 200px;
        box-shadow: 0px 8px 16px rgba(0,0,0,0.2);
        z-index: 1;
        border-radius: 8px;
        margin-top: 10px;
        }

        .dropdown-content a {
        color: #333 !important;
        padding: 12px 16px;
        text-decoration: none;
        display: block;
        text-align: left;
        font-size: 16px;
        }

        .dropdown-content a:hover {
        background-color: #f1f1f1;
        border-radius: 0;
        }

        .dropdown-content .premium-option {
        display: flex;
        align-items: center;
        gap: 5px;
        }

        .profile-dropdown:hover .dropdown-content {
        display: block;
        }


        .container {
            background-color: rgb(63, 63, 63); 
            border: 1px solid #ccc; 
            border-radius: 20px;
            padding: 30px;
            margin: 40px auto;
            width: 90%;
            max-width: 1000px;
            min-height: 400px;
            color: white;
            display: flex;
            flex-direction: column;
            gap: 20px;
        }
        .container h2 {
            text-align: center;
            color: white;
            font-size: 32px;
            margin-bottom: 20px;
            font-family: 'Adamina', serif;
        }

        /* ESTILOS DA BIBLIOTECA - LISTA DE PAGAMENTOS */
        .no-items-card {
            padding: 30px;
            background: #ffe9e9;
            border: 2px solid #ffb3b3;
            color: #b30000;
            margin-top: 20px;
            border-radius: 15px;
            text-align: center;
            font-size: 18px;
            max-width: 600px;
            margin-left: auto;
            margin-right: auto;
        }
        .no-items-card strong {
            font-size: 22px;
            display: block;
            margin-bottom: 10px;
        }
        .button-group {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 25px;
        }
        .button-group a {
            padding: 12px 25px;
            border-radius: 8px;
            text-decoration: none;
            font-weight: bold;
            transition: 0.3s;
            color: white !important;
            box-shadow: 0 4px 6px rgba(0,0,0,0.2);
        }
        .btn-personagens {
            background: #b30000;
        }
        .btn-personagens:hover {
            background: #d90000 !important;
        }
        .btn-roteiros {
            background: #0044aa;
        }
        .btn-roteiros:hover {
            background: #005be0 !important;
        }

        /* Estilo do item da lista de pagamentos (quando EXISTE) */
        .payment-item {
            margin-bottom: 25px;
            padding: 20px;
            border: 1px solid #444;
            border-radius: 12px;
            background-color: #303030;
            box-shadow: 0 4px 8px rgba(0,0,0,0.3);
            display: flex;
            flex-direction: column;
        }
        .payment-item h3 {
            font-size: 24px;
            margin-bottom: 10px;
            color: #007bff;
            font-family: 'Adamina', serif;
        }
        .payment-item p {
            margin-bottom: 8px;
            font-size: 16px;
            line-height: 1.5;
        }
        .payment-item strong {
            color: #ccc;
        }
        .payment-item img {
            width: 150px;
            height: auto;
            border-radius: 8px;
            margin-top: 15px;
            align-self: flex-start;
            border: 1px solid #555;
        }

    /* RODAPÉ */
  .rodape {
      display: flex;
      justify-content: space-around;
      align-items: flex-start;
      padding: 40px;
      background-color: #1e1e1e;
      color: #ccc;
      flex-wrap: wrap;
      gap: 30px;
  }

  .rodape div {
      flex: 1;
      min-width: 200px;
  }

  .rodape h1 {
      font-size: 20px;
      margin-bottom: 10px;
  }

  .rodape a {
      display: block;
      color: #247fe6;
      text-decoration: none;
      margin: 5px 0;
  }

  .rodape a:hover {
      text-decoration: underline;
  }

  .rodape img {
      width: 50px;
      height: 50px;
      margin-right: 10px;
  }

  .contato {
      width: 100%;
      text-align: center;
      margin-top: 20px;
      font-size: 14px;
  }
    </style>
</head>
<body>
    <header>
        <div class="header-container">
            <div class="navbar">
                <div class="search-box">
                    <input type="text" id="searchInput" placeholder="Pesquisar">
                    <span onclick="clearSearch()">❌</span>
                </div>

                <a href="../../front-end/views/sobrenos_com_assinatura.html">Sobre Nós</a>
                <a href="../../front-end/views/premios_com_assinatura.html">Prêmios</a>
                <a href="../../front-end/views/roteiros_com_assinatura.html">Roteiro</a>
                <a href="../../front-end/views/homepage2_com_assinatura.html">Homepage</a>
                <a href="pagamento_list.php">Biblioteca</a>
                <a href="../../front-end/views/personagens_com_assinatura.html">Personagens</a>
                <a href="publicar_form.php">Publicar</a>

                <div class="profile-dropdown">
          <div class="profile-icon" onclick="window.location.href='../../back-end/views/perfil_form.php'">
              <span class="material-icons">person</span>
              <div class="verified-badge">
                <span class="material-icons">verified</span>
              </div>
          </div>
          <div class="dropdown-content">
            <a href="#" class="premium-option">
              <span class="material-icons">verified</span>
              Membro Premium
            </a>
          </div>
        </div>
            </div>
        </div>
        
        <script>
            function clearSearch() {
                document.getElementById('searchInput').value = '';
            }
        </script>
    </header>

    <div class="logo">
        </div>
    
    <div class="container">
        <h2>Biblioteca</h2>

        <?php if (empty($pagamentos)): ?>
            
            <div class="no-items-card">
                <strong>Você ainda não possui nenhum item!</strong>
                <br><br>
                Faça a compra de um personagem ou roteiro para que apareçam aqui.
                <br><br>

                <div class="button-group">

                    <a href="/GitHub/whileplay_aez/whileplay_aez/front-end/views/personagens_com_assinatura.html" 
                        class="btn-personagens"
                        onmouseover="this.style.background='#d90000'"
                        onmouseout="this.style.background='#b30000'">
                        Ver personagens
                    </a>

                    <a href="/GitHub/whileplay_aez/whileplay_aez/front-end/views/roteiros_com_assinatura.html" 
                        class="btn-roteiros"
                        onmouseover="this.style.background='#005be0'"
                        onmouseout="this.style.background='#0044aa'">
                        Ver roteiros
                    </a>

                </div>
            </div>

        <?php else: ?>

            <?php foreach ($pagamentos as $pag): ?>
                <div class="payment-item">
                    <h3><?= $pag['personagem_nome'] ?></h3>

                    <p><?= $pag['personagem_descricao'] ?></p>

                    <p><strong>Status:</strong> <?= $pag['status'] ?></p>

                    <p><strong>Data:</strong> <?= $pag['created_at'] ?></p>

                    <p><strong>Código:</strong> <?= $pag['codigo_identificacao'] ?></p>

                    <!-- <?php if (!empty($pag['personagem_imagem'])): ?>
                        <img src="/GitHub/whileplay_aez/whileplay_aez/back-end/uploads/<?= $pag['personagem_imagem'] ?>" 
                            alt="<?= $pag['personagem_nome'] ?>">
                    <?php endif; ?> -->
                </div>
            <?php endforeach; ?>

        <?php endif; ?>
    </div>

    <div class="rodape">
      <div class="producao">
        <h1>Produtores</h1>
        <p><br>Diego Alves Gomes<br>Geovana Clemente Cruz<br>Livia Mayumi Hayashida<br>Victor do Vale Souza</p>
      </div>
      <div class="suporte">
        <h1>Precisa de Suporte?</h1>
        <a href="https://www.google.com.br/">E-mail</a>
        <a href="../../back-end/views/suporte_form.php">Fale Conosco</a>
      </div>

      <div class="siga-nos">
      <h1>Siga-nos!</h1>
      <a href="https://www.instagram.com/"><img src="../../front-end/public/MEDIA/imagens/instagram.png" alt="Instagram"></a>
      <a href="https://www.tiktok.com/login?lang=pt-BR&redirect_url=https%3A%2F%2Fwww.tiktok.com%2Fupload%3Flang%3Dpt-BR"><img src="../../front-end/public/MEDIA/imagens/tiktok.png" alt="TikTok"></a>
    </div>

      <p class="contato">Contato: aez.whileplay@gmail.com</p>
    </div>
</body>
</html>