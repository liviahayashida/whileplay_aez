<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Cadastrar Assinatura</title>

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
      background-color: #262626; /* grafite leve */
    }

    /* Fundo clareado */
    .background {
      padding: 0 25px 25px;
      position: relative;
      width: 100%;
      min-height: 100vh;
      background-image: url('../public/MEDIA/imagens/backgroundclean.png');
      background-size: cover;
      background-position: center;

      display: flex;
      align-items: center;
      justify-content: center;

      backdrop-filter: brightness(1.2);
    }

    /* Card mais claro */
    .form-panel {
      background-color: #2e2e2e; /* tom grafite claro */
      border-radius: 14px;
      padding: 35px 40px;
      width: 100%;
      max-width: 540px;

      box-shadow:
        0px 10px 20px rgba(255, 255, 255, 0.12),
        0px 25px 35px rgba(0, 0, 0, 0.35),
        0px 10px 20px rgba(255, 255, 255, 0.1);
    }

    h1 {
      text-align: center;
      color: #e6e6e6;
      font-size: 28px;
      margin-bottom: 28px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    label {
      color: #6bc6ff;
      font-weight: 700;
      letter-spacing: 1px;
      display: block;
      margin-bottom: 8px;
      margin-top: 18px;
      font-size: 14px;
      text-transform: uppercase;
    }

    /* Inputs mais claros */
    input, select {
      width: 100%;
      padding: 14px;
      background-color: #3a3a3a; /* tom claro */
      border: 1px solid #5c5c5c;
      color: #f0f0f0;
      border-radius: 8px;
      font-size: 15px;
      outline: none;
      transition: all 0.2s ease;
    }

    input:focus, select:focus {
      border-color: #48aaff;
      background-color: #444; /* leve clareamento no foco */
    }

    /* Botão mais destacado */
    input[type="submit"] {
      margin-top: 32px;
      background-color: #48aaff;
      color: #000;
      font-weight: 800;
      border-radius: 10px;
      border: none;
      cursor: pointer;
      padding: 16px 40px;
      text-transform: uppercase;
      transition: all 150ms ease-in-out;
      font-size: 15px;
    }

    input[type="submit"]:hover {
      background-color: #1da0ff;
      color: #fff;
      box-shadow: 0px 4px 20px rgba(72, 170, 255, 0.5);
    }

    .voltar {
      margin-top: 25px;
      text-align: center;
    }

    .voltar a {
      color: #6bc6ff;
      text-decoration: none;
      font-size: 14px;
      text-transform: uppercase;
      letter-spacing: 1px;
    }

    .voltar a:hover {
      text-decoration: underline;
    }

  </style>
</head>
<body>

<div class="background">

  <div class="form-panel">
    
    <h1>Nova Assinatura</h1>

    <form action="/GitHub/whileplay_aez/whileplay_aez/back-end/public/save-assinatura" method="POST">

      <label for="email">Email do usuário</label>
      <input type="email" id="email" name="email" required placeholder="Digite o email">

      <label for="cidade">Cidade</label>
      <input type="text" id="cidade" name="cidade" maxlength="100" required placeholder="Digite a cidade">

      <label for="endereco">Endereço</label>
      <input type="text" id="endereco" name="endereco" maxlength="255" required placeholder="Rua, número, bairro...">

      <label for="cep">CEP</label>
      <input type="text" id="cep" name="cep" pattern="\d{5}-?\d{3}" placeholder="00000-000" maxlength="9">

      <label for="cpf">CPF</label>
      <input type="text" id="cpf" name="cpf" required pattern="\d{3}\.\d{3}\.\d{3}-\d{2}" placeholder="000.000.000-00" maxlength="14">

      <label for="status">Status</label>
      <select id="status" name="status" required>
        <option value="ativa">Ativa</option>
        <option value="inativa">Inativa</option>
        <option value="cancelada">Cancelada</option>
      </select>

      <label for="data_assinatura">Data da Assinatura</label>
      <input type="date" id="data_assinatura" name="data_assinatura">

      <label for="data_cancelamento">Data de Cancelamento</label>
      <input type="date" id="data_cancelamento" name="data_cancelamento">

      <input type="submit" value="Salvar Assinatura">

    </form>

    <div class="voltar">
      <a href="../homepage2_com_login.html">Voltar</a>
    </div>

  </div>
</div>

</body>
</html>
