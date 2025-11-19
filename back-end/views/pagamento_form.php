<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<title>Pagamento</title>

<link href="https://fonts.googleapis.com/css2?family=Adamina&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=PT+Mono|Quicksand:400,700&display=swap" rel="stylesheet">

<style>
:root {
    --coral: #EF533D;
    --navy: #0F1626;
    --leather: #AB987A;
    --eggshell: #F5F5F5;
}

body {
    margin: 0;
    padding: 0;
    font-family: 'Quicksand', sans-serif;

    background: url('../public/MEDIA/imagens/backgroundclean.png') 
        no-repeat center center fixed;
    background-size: cover;

    display: flex;
    justify-content: center;
    align-items: center;

    min-height: 100vh;
    overflow-x: hidden;
}

.ContainerPagamento {
    overflow: hidden;
    display: flex;
    gap: 40px;
    align-items: center;
    justify-content: center;
    max-width: 100vw;  
    flex-wrap: wrap; 
    padding: 20px;
    box-sizing: border-box;
}

.Card {
    width: min(480px, 80vw);
    height: min(300px, 50vw);

    border-radius: 0.9rem;
    background: linear-gradient(110deg, var(--coral) 60%, var(--navy) 60%);
    color: white;
    position: relative;
    font-size: 0.75rem;
    padding: 1rem;
    box-shadow: 0 4px 18px rgba(0,0,0,0.2);
    cursor: pointer;
    transition: transform 0.4s ease-in-out;
}

.Card .front,
.Card .back {
    position: absolute;
    inset: 0;
    padding: 1.5rem;
    transition: opacity 0.2s, transform 0.2s;
}

.Card .back {
    opacity: 0;
    transform: rotateY(180deg);
}

.Card.flipped {
    transform: rotateY(180deg);
}

.Card.flipped .front {
    opacity: 0;
}

.Card.flipped .back {
    opacity: 1;
}

/* ELEMENTOS DO CARTÃO */
.card-chip {
    width: 3.5rem;
    height: 2.5rem;
    background: linear-gradient(135deg, #fefcea, gold);
    border-radius: 0.3rem;
}

.card-number .mono,
.card-holder .mono,
.card-date .mono,
.card-code .mono {
    font-family: 'PT Mono', monospace;
    font-size: 1.9rem;
}

/* FORMULÁRIO */

form {
    background: white;
    padding: 30px;
    width: 100%;
    max-width: 480px; 
    box-sizing: border-box;
    border-radius: 15px;
    margin: 0 auto; 
    box-shadow:
        2px 2px 8px rgba(0,0,0,0.05),
        0 0 64px rgba(0,0,0,0.15);
}


form h2 {
    text-align: center;
    margin-bottom: 10px;
    font-family: 'Adamina', serif;
}

input {
    width: 100%;
    padding: 12px;
    margin-bottom: 12px;
    border-radius: 6px;
    border: 1px solid #ccc;
    font-size: 1rem;
}

button {
    background: var(--coral);
    color: white;
    padding: 12px;
    font-size: 1.1rem;
    border: none;
    border-radius: 6px;
    width: 100%;
    cursor: pointer;
    letter-spacing: 1px;
    transition: background 0.2s ease-in-out;
}

button:hover {
    background: var(--navy);
}
</style>
</head>

<body>

<div class="ContainerPagamento">

    <div class="Card" id="card">
        <div class="front">
            <div class="card-chip"></div>

            <div class="card-number">
                <label>Número</label>
                <div class="mono" id="card-number">0000 0000 0000 0000</div>
            </div>

            <div class="card-holder">
                <label>Nome</label>
                <div class="mono" id="card-holder">Nome completo</div>
            </div>

            <div class="card-date">
                <label>Validade</label>
                <div class="mono" id="card-date">00/0000</div>
            </div>
        </div>

        <div class="back">
            <div style="background:black; width:100%; height:40px;"></div>

            <div class="card-code">
                <label>CVV</label>
                <div class="mono" id="card-cvv">000</div>
            </div>
        </div>
    </div>

    <form action="/GitHub/whileplay_aez/whileplay_aez/back-end/public/save-pagamento" method="POST">
        <h2>Pagamento</h2>

        <input type="email" name="email" placeholder="Digite seu e-mail" required>

        <input type="text" name="codigo_identificacao" placeholder="Código de identificação do produto" required>

        <input type="text" id="nome_cartao" name="nome_cartao" placeholder="Nome no cartão" required>

        <input type="text" id="numero_cartao" name="numero_cartao" placeholder="Número do cartão" required maxlength="19">

        <label>Data de vencimento</label>
        <input type="date" id="data_vencimento" name="data_vencimento" required>

        <input type="text" id="codigo" name="codigo" placeholder="Código (CVV)" maxlength="3" required>

        <button type="submit">Pagar</button>
    </form>

</div>

<script>

const card = document.getElementById("card");

card.addEventListener("click", () => {
    card.classList.toggle("flipped");
});

document.getElementById("numero_cartao").addEventListener("input", e => {
    let v = e.target.value.replace(/\D/g, "").substring(0, 16);
    v = v.replace(/(.{4})/g, "$1 ").trim();
    e.target.value = v;
    document.getElementById("card-number").textContent = v || "0000 0000 0000 0000";
});

// Nome do cartão
document.getElementById("nome_cartao").addEventListener("input", e => {
    let nome = e.target.value.toUpperCase();
    e.target.value = nome;
    document.getElementById("card-holder").textContent = nome || "NOME COMPLETO";
});

// Data
document.getElementById("data_vencimento").addEventListener("input", e => {
    let parts = e.target.value.split("-");
    if (parts.length === 3) {
        document.getElementById("card-date").textContent = `${parts[2]}/${parts[1]}/${parts[0]}`;
    }
});

// CVV
document.getElementById("codigo").addEventListener("input", e => {
    const cvv = e.target.value.replace(/\D/g, "").substring(0, 3);
    e.target.value = cvv;
    document.getElementById("card-cvv").textContent = cvv || "000";
});
</script>

</body>
</html>
