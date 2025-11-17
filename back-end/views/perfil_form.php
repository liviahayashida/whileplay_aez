
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Alterar Perfil</title>
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
    background-color: #3f3e3eff; /* Fundo mais escuro */
    color: #e0e0e0; /* Cor de texto mais clara */
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
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
    max-width: 800px;
    padding: 40px 30px; /* Mais padding */
    background: #1e1e1e; /* Contêiner escuro */
    border: 1px solid #333333;
    border-radius: 16px; /* Borda mais arredondada */
    box-shadow: 0 8px 30px rgba(0, 0, 0, 0.5); /* Sombra suave */
}

/* NOVO: Estiliza o formulário com layout de grid para colunas */
form {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 25px 30px;
}

/* NOVO: Faz a Biografia e o Botão ocuparem as duas colunas */
form label:nth-of-type(3), 
form textarea,
form button {
    grid-column: 1 / -1; 
}

.form-section {
    display: flex;
    gap: 40px;
    flex-wrap: wrap;
}

.coluna-esquerda,
.coluna-direita {
    flex: 1;
    display: flex;
    flex-direction: column;
}

.campo {
    display: flex;
    flex-direction: column;
    margin-bottom: 0;
}

label {
    font-weight: 500; /* Levemente mais fino */
    margin-bottom: 8px; /* Mais espaço */
    color: #cccccc;
    font-size: 15px;
    display: block;
}

input, textarea {
    padding: 12px 15px;
    border: 1px solid #444444; /* Borda escura */
    border-radius: 8px;
    font-size: 15px;
    resize: vertical;
    background-color: #2a2a2a; /* Fundo do campo sutilmente mais claro */
    color: #f0f0f0;
    transition: border-color 0.3s ease, box-shadow 0.3s ease;
}

input:focus, textarea:focus {
    border-color: #6a5acd; /* Cor roxa/azul no foco */
    outline: none;
    box-shadow: 0 0 0 3px rgba(106, 90, 205, 0.3); /* Brilho suave */
    background-color: #333333;
}

/* Estilo específico para input[type="file"] */
input[type="file"] {
    padding: 10px 15px;
    background-color: #3a3a3a;
    color: #e0e0e0;
}


button {
    padding: 14px;
    background: #6a5acd; /* Azul/Roxo vibrante */
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 17px;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease, transform 0.1s ease;
    margin-top: 20px;
    letter-spacing: 0.5px;
}

button:hover {
    background: #7a68e6; /* Cor ligeiramente mais clara no hover */
    transform: translateY(-2px); /* Efeito de elevação */
}

@media (max-width: 700px) {
    .container {
        padding: 30px 20px;
    }
    
    form {
        grid-template-columns: 1fr;
        gap: 20px;
    }
}
    </style>
</head>
<body>

    <div class="container">
        <h2>Alterar Perfil</h2>

       <form action="/GitHub/whileplay_aez/whileplay_aez/back-end/public/perfil/atualizar"
      method="POST"
      enctype="multipart/form-data">


    <label>Nome completo</label>
    <input type="text" name="nome_completo" required>

    <label>Username</label>
    <input type="text" name="username" required>

    <label>Biografia</label>
    <textarea name="biografia"></textarea>

    <label>Email</label>
    <input type="email" name="email" required>

    <label>Senha</label>
    <input type="password" name="senha" required>

    <label>Data criação</label>
    <input type="date" name="data_criacao" required>

    <label>Imagem</label>
    <input type="file" name="imagem">

    <button type="submit">Salvar alterações</button>
</form>

</body>
</html>
