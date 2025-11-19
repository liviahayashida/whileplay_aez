CREATE DATABASE IF NOT EXISTS while_play;
USE while_play;

CREATE TABLE IF NOT EXISTS perfil (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nome_completo VARCHAR(255) NOT NULL,
    username VARCHAR(100) UNIQUE NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    senha VARCHAR(255) NOT NULL,
    biografia TEXT,
    foto_url VARCHAR(255),
    status ENUM('ativo', 'inativo', 'banido') DEFAULT 'ativo',
    token_recuperacao VARCHAR(255),
    ultimo_login DATETIME,
    data_criacao DATETIME DEFAULT CURRENT_TIMESTAMP,
    INDEX idx_email (email),
    INDEX idx_username (username)
);

CREATE TABLE IF NOT EXISTS assinaturas (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    cidade VARCHAR(100),
    endereco VARCHAR(255),
    cep VARCHAR(20),
    cpf VARCHAR(14),
    status ENUM('ativa', 'inativa', 'cancelada') DEFAULT 'ativa',
    data_assinatura DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_cancelamento DATETIME,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE,
    INDEX idx_usuario_id (usuario_id)
);

CREATE TABLE IF NOT EXISTS publicar (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT NOT NULL,
    titulo VARCHAR(255) NOT NULL,
    sinopse TEXT,
    tipo ENUM('roteiro', 'personagem') NOT NULL,
    arquivo_url VARCHAR(255),
    data_criacao TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    publicado TINYINT(1) DEFAULT 0,
    status ENUM('rascunho', 'publicado', 'rejeitado') DEFAULT 'rascunho',
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS suportes (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    mensagem TEXT,
    resposta TEXT,
    data_envio DATETIME DEFAULT CURRENT_TIMESTAMP,
    data_resposta DATETIME,
    status ENUM('aberto', 'respondido', 'fechado') DEFAULT 'aberto',
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS cadastro (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    data_cadastro DATETIME DEFAULT CURRENT_TIMESTAMP,
    ip_cadastro VARCHAR(45),
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS login (
    id INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    data_login DATETIME DEFAULT CURRENT_TIMESTAMP,
    ip_login VARCHAR(45),
    sucesso TINYINT(1) DEFAULT 1,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS pagamento (
    id_pagamento INT AUTO_INCREMENT PRIMARY KEY,
    usuario_id INT,
    codigo_identificacao VARCHAR(50) NOT NULL,
    nome_do_cartao VARCHAR(300),
    numero_do_cartao VARCHAR(150),
    data_de_vencimento DATE,
    codigo VARCHAR(4),
    status ENUM('pago', 'pendente', 'recusado') DEFAULT 'pendente',
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (usuario_id) REFERENCES perfil(id) ON DELETE SET NULL,
    FOREIGN KEY (codigo_identificacao) REFERENCES personagens(codigo_identificacao) ON DELETE CASCADE
);

CREATE TABLE IF NOT EXISTS personagens (
    id INT AUTO_INCREMENT PRIMARY KEY,
    codigo_identificacao VARCHAR(50) NOT NULL UNIQUE,
    nome VARCHAR(100) NOT NULL,
    descricao TEXT NOT NULL,
    imagem VARCHAR(255) NOT NULL
);

INSERT INTO personagens (codigo_identificacao, nome, descricao, imagem) VALUES
('CAR001', 'Carter', 'Artista de rage rap, ele é misterioso e tem um dos shows mais animados do mundo.', '../public/MEDIA/imagens/PlayboiCaripersonagem.jpg'),
('WEB002', 'Webster', 'Um jovem modelo, com seu sonho de ser rapper. Ele tem um talento incrível porém a vergonha de tentar vestir algo seu fala maior que seu sonho.', '../public/MEDIA/imagens/Travisscott.png'),
('ECH003', 'Echoes', 'Boneco esquecido de um garoto que sofria bullyng e ele gastava sua raiva criando histórias para o boneco.', '../public/MEDIA/imagens/Beyonce.jpg'),
('THE004', 'Thesvanes', 'Nicky é um jovem negro que após morrer em um acidente, ele é reencarnado em outro homem já tendo sua vida pela metade.', '../public/MEDIA/imagens/heroesAndVillans.png'),
('STO005', 'Stoner', 'Homem de aço que sofreu após uma queda em uma contrução de seu trabalho, voltando para se vingar de todos.', '../public/MEDIA/imagens/future.jpg'),
('SOL006', 'Solar', 'Após 100 anos de sono, ela acorda e vê que a humanidade não há mais salvação, então ela decide acabar com todos, porém acaba sendo parada por si mesma.', '../public/MEDIA/imagens/jayzjpg.jpg');

INSERT INTO personagens (codigo_identificacao, nome, descricao, imagem) VALUES
('MAR007', 'March', 'Em uma distopia, ele é um caçador de recompensa frio, porém por dentro é apenas um homem normal querendo mudar de vida.', '../public/MEDIA/imagens/magodegelo.png'),
('THR008', 'Threenth', 'Pai das árvores que comanda todas as florestas da região do Amazonas.', '../public/MEDIA/imagens/curupira.jpg'),
('YAS009', 'Yasuke', 'Após a destruição de seu planeta samurai, o último deles busca vingança e sede por sangue.', '../public/MEDIA/imagens/yasuke.jpg'),
('FAD010', 'Fada Scarlleth', 'Fada que protege as crianças órfãs de noite em orfanatos, pretendendo protegê-las de violências e outros problemas.', '../public/MEDIA/imagens/fada.jpg'),
('ULT011', 'Ultimo cavalheiro', 'Defende seu deserto de invasores na procura de adicionar a terra para seu arsenal.', '../public/MEDIA/imagens/cavalheiro.jpg'),
('NOI012', 'Última noiva', 'Após ser traída em seu noivado e sofrer um ataque mortal, ela assombra todos os casais que desejam casar em sua igreja.', '../public/MEDIA/imagens/noiva.jpg');

INSERT INTO personagens (nome, descricao, imagem, codigo_identificacao) VALUES
('Phill e Jhonson', 'Quando dois agentes aposentados, sofrem por uma volta de um vilão antigo da dupla, eles voltam a tona com mais uma missão de tirar o fôlego.', '../public/MEDIA/imagens/agentessecretos.jpg', 'PERS031'),
('Mãe padrasta', 'Quando se vê individada e golpeada por seu marido, ela decide fazer de tudo para sustentar a filha de seu ex marido, em uma jornada emocionante e trágica.', '../public/MEDIA/imagens/pais.jpg', 'PERS032'),
('Cats, a descoberta', 'Lili, é uma gata de uma dona meiga e simples, porém após a morte de sua dona, o gato é jogado para viver a rua, onde aprende a se virar e vivenciar a maldade humana.', '../public/MEDIA/imagens/cat.png', 'PERS033'),
('Free Throw', 'Uma escola pobre consegue uma vaga na liga nacional pela desistência de uma antiga universidade, eles precisam ser campeões para se provarem que são dignos de continuarem na liga.', '../public/MEDIA/imagens/freebasquete.jpg', 'PERS034'),
('Phillipe', 'Em um mundo diatópico, onde os animais são estrelas, ele enfrenta dificuldades na vida da fama e em ser um animal de estimação. Ele se vê em uma jornada de autodescoberta e aceitação.', '../public/MEDIA/imagens/dog.jpg', 'PERS035'),
('The door', 'A porta sempre se tantém fechada, porém de noite após Maik e seu grupo de amigos invadir a escola em busca da prova do professor para colarem no dia do teste final, eles entram em uma jornada em uma escola distópica que se muda a cada dia.', '../public/MEDIA/imagens/porta.png', 'PERS036');
