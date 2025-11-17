<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Suporte</title>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
            background-color: #121212; /* Fundo escuro */
            color: #e0e0e0; 
            display: flex;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
            padding: 20px;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            color: #ffffff;
            font-size: 28px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .container {
            width: 100%;
            max-width: 450px; /* Tamanho ideal para um formulário de coluna única */
            padding: 40px 30px; 
            background: #1e1e1e; /* Contêiner escuro */
            border: 1px solid #333333;
            border-radius: 16px; 
            box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5); 
        }

        /* O formulário original usa <br> e não tem divs para agrupar, então 
           aplicamos o espaçamento diretamente nos elementos de bloco */
        form {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }
        
        /* Remove o comportamento visual do <br> (para evitar espaços extras, 
           mas mantendo-os no HTML original) */
        form br {
            display: none;
        }

        label {
            font-weight: 500; 
            margin-bottom: 0; /* O gap do flexbox cuida do espaçamento */
            color: #cccccc;
            font-size: 15px;
            display: block;
        }

        input[type="email"], textarea {
            /* Sobrescreve os estilos inline (width:280px;) */
            width: 100% !important; 
            height: auto !important; 

            padding: 12px 15px;
            border: 1px solid #444444; 
            border-radius: 8px;
            font-size: 15px;
            resize: vertical;
            background-color: #2a2a2a; 
            color: #f0f0f0;
            transition: border-color 0.3s ease, box-shadow 0.3s ease;
        }

        input:focus, textarea:focus {
            border-color: #6a5acd; /* Cor roxa/azul no foco */
            outline: none;
            box-shadow: 0 0 0 3px rgba(106, 90, 205, 0.3); 
            background-color: #333333;
        }
        
        /* Ajuste de margin para a textarea, pois ela tem <br><br> no HTML */
        textarea {
            margin-bottom: 10px;
        }

        /* NOVO: Agrupa e alinha os botões */
        .footer-actions {
            display: flex;
            justify-content: space-between;
            gap: 15px;
            margin-top: 15px;
        }

        button {
            padding: 14px;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 17px;
            font-weight: bold;
            cursor: pointer;
            transition: background 0.3s ease, transform 0.1s ease;
            letter-spacing: 0.5px;
            flex: 1; /* Ambos os botões ocupam a mesma largura */
            margin-top: 0; /* Remove margin-top antiga */
        }

        /* Estilo para o botão principal (Enviar) */
        .footer-actions button[type="submit"] {
            background: #6a5acd; /* Azul/Roxo vibrante */
        }
        
        .footer-actions button[type="submit"]:hover {
            background: #7a68e6; 
            transform: translateY(-2px); 
        }

        /* Estilo para o botão Voltar */
        .back-button {
            background: #4a4a4a; /* Cinza escuro */
        }
        
        .back-button:hover {
            background: #5a5a5a; /* Cinza mais claro no hover */
            transform: translateY(-2px);
        }

        @media (max-width: 500px) {
            .container {
                padding: 30px 15px;
            }
            .footer-actions {
                flex-direction: column; /* Em telas muito pequenas, empilha os botões */
            }
        }
    </style>
</head>
<body>

    <div class="container">
        <h2>Enviar Solicitação de Suporte</h2>

        <form action="/GitHub/whileplay_aez/whileplay_aez/back-end/public/save-suporte" method="POST">

            <label>Informe seu e-mail:</label><br>
            <input type="email" name="email" required style="width:280px;"><br><br>

            <label>Mensagem:</label><br>
            <textarea name="mensagem" required style="width:280px; height:120px;"></textarea><br><br>

            <div class="footer-actions">
                <button type="button" class="back-button" onclick="history.back()">Voltar</button>
                <button type="submit">Enviar Solicitação</button>
            </div>

        </form>
    </div>

</body>
</html>