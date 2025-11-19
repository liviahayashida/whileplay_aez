# 🎬 WhilePlay AEZ

![Logo AEZ](front-end/public/MEDIA/imagens/Logo-AEZ.png)

## 📋 Sobre o Projeto

**WhilePlay AEZ** é uma plataforma web inovadora criada para dar visibilidade a roteiristas e criadores de conteúdo pouco reconhecidos. O projeto permite que artistas publiquem, compartilhem e vendam seus roteiros e criações, conectando talentos emergentes com potenciais compradores e entusiastas da indústria cinematográfica.

### 🎯 Objetivo

Transformar ideias em arte, oferecendo uma plataforma acessível onde roteiristas iniciantes e criadores de personagens possam:
- Publicar seus roteiros e ideias originais
- Ganhar visibilidade no mercado
- Monetizar suas criações através de assinaturas
- Conectar-se com outros profissionais da indústria
- Receber avaliações e feedback da comunidade

---

## ✨ Funcionalidades

### Para Usuários Não Autenticados
- 🏠 Página inicial informativa
- 📝 Cadastro de novos usuários
- 🔐 Login seguro com autenticação
- 🔄 Recuperação de senha

### Para Usuários Autenticados
- 👤 Gerenciamento de perfil pessoal
- 📖 Navegação por roteiros disponíveis
- ⭐ Sistema de avaliação de roteiros
- 🎭 Exploração de personagens
- 🏆 Sistema de prêmios
- 👥 Página "Sobre Nós"

### Para Assinantes Premium
- ✍️ Publicação de roteiros próprios
- 💰 Gestão de pagamentos e assinaturas
- 📊 Acesso completo a todas as funcionalidades
- 🎨 Criação e publicação de personagens

### Funcionalidades Administrativas
- 📢 Sistema de publicação de conteúdo
- 💳 Gerenciamento de pagamentos
- 🎫 Controle de assinaturas
- 🛠️ Suporte ao usuário

---

## 🚀 Tecnologias Utilizadas

### Back-end
- **PHP** - Linguagem principal do servidor
- **MySQL** - Banco de dados relacional
- **PDO** - Interface de acesso ao banco de dados
- **MVC Pattern** - Arquitetura Model-View-Controller

### Front-end
- **HTML5** - Estruturação das páginas
- **CSS3** - Estilização e layout responsivo
- **JavaScript** - Interatividade e requisições AJAX
- **Owl Carousel** - Carrosséis e sliders
- **Material Icons** - Ícones do Google

### Ferramentas de Desenvolvimento
- **Git/GitHub** - Controle de versão
- **XAMPP/WAMP** - Servidor local de desenvolvimento

---

## 📁 Estrutura do Projeto

```
whileplay_aez/
│
├── back-end/
│   ├── config/
│   │   ├── Conexao.php          # Configuração do banco de dados
│   │   └── db.php                # Conexão PDO
│   │
│   ├── controllers/
│   │   ├── AssinaturaController.php
│   │   ├── AuthController.php
│   │   ├── cadastroController.php
│   │   ├── loginController.php
│   │   ├── PagamentoController.php
│   │   ├── PerfilController.php
│   │   ├── PublicarController.php
│   │   └── SuporteController.php
│   │
│   ├── models/
│   │   ├── Assinatura.php
│   │   ├── Pagamento.php
│   │   ├── Perfil.php
│   │   ├── Publicar.php
│   │   ├── Suporte.php
│   │   └── Usuario.php
│   │
│   ├── views/
│   │   ├── assinatura_form.php
│   │   ├── auth_check.php
│   │   ├── pagamento_form.php
│   │   ├── pagamento_list.php
│   │   ├── perfil_form.php
│   │   ├── publicar_form.php
│   │   ├── publicar_list.php
│   │   └── suporte_form.php
│   │
│   ├── data/
│   │   └── users.sql             # Script SQL do banco
│   │
│   └── public/
│       ├── index.php             # Roteador principal
│       └── .htaccess             # Configuração Apache
│
├── front-end/
│   ├── public/
│   │   ├── js/
│   │   │   ├── api.js            # Funções de API
│   │   │   └── auth.js           # Autenticação
│   │   └── MEDIA/
│   │       └── imagens/          # Imagens do projeto
│   │
│   └── views/
│       ├── assinatura.html
│       ├── cadastro.html
│       ├── carregando.html
│       ├── homepage1.html
│       ├── homepage2_com_assinatura.html
│       ├── homepage2_com_login.html
│       ├── login.html
│       ├── pagamento.html
│       ├── personagens_com_assinatura.html
│       ├── personagens_com_login.html
│       ├── premios_com_assinatura.html
│       ├── premios_com_login.html
│       ├── recuperar_senha.html
│       ├── roteiros_com_assinatura.html
│       ├── roteiros_com_login.html
│       ├── sobrenos_com_assinatura.html
│       ├── sobrenos_com_login.html
│       └── .htaccess
│
└── README.md
```

---

## 🛠️ Instalação e Configuração

### Pré-requisitos

- **PHP** >= 7.4
- **MySQL** >= 5.7
- **Apache** ou **Nginx**
- **Composer** (opcional)
- **XAMPP** ou **WAMP** (recomendado para Windows)

### Passo a Passo

1. **Clone o repositório**
   ```bash
   git clone https://github.com/liviahayashida/whileplay_aez.git
   cd whileplay_aez
   ```

2. **Configure o banco de dados**
   
   Edite o arquivo `back-end/config/Conexao.php`:
   ```php
   self::$instance = new PDO(
       "mysql:host=localhost;dbname=while_play;charset=utf8",
       "root",      // Seu usuário MySQL
       ""           // Sua senha MySQL
   );
   ```

3. **Crie o banco de dados**
   ```sql
   CREATE DATABASE while_play;
   USE while_play;
   ```

4. **Importe as tabelas necessárias**
   
   Execute o script SQL localizado em `back-end/data/users.sql` ou crie manualmente as tabelas necessárias:
   - `perfil` - Dados dos usuários
   - `publicar` - Roteiros publicados
   - `assinatura` - Planos de assinatura
   - `pagamento` - Transações de pagamento
   - `suporte` - Tickets de suporte

5. **Configure o caminho base**
   
   Edite `back-end/public/index.php` e ajuste o `$basePath`:
   ```php
   $basePath = '/seu-caminho/whileplay_aez/back-end/public';
   ```

6. **Configure a URL da API**
   
   Edite `front-end/public/js/api.js`:
   ```javascript
   const API_URL = "http://localhost/seu-caminho/back-end/public/index.php?path=";
   ```

7. **Inicie o servidor**
   
   Se estiver usando XAMPP/WAMP:
   - Coloque o projeto na pasta `htdocs`
   - Inicie o Apache e MySQL
   - Acesse: `http://localhost/whileplay_aez/front-end/views/homepage1.html`

   Ou use o servidor embutido do PHP:
   ```bash
   cd back-end/public
   php -S localhost:8000
   ```

---

## 🔐 Segurança

O projeto implementa diversas medidas de segurança:

- ✅ **Senhas criptografadas** com `password_hash()` e `PASSWORD_DEFAULT`
- ✅ **Prepared Statements** (PDO) para prevenir SQL Injection
- ✅ **Validação de duplicação** de emails no cadastro
- ✅ **Autenticação segura** com verificação de senha via `password_verify()`
- ✅ **Tratamento de exceções** PDO para erros de banco de dados

---

## 📡 API - Endpoints Principais

### Autenticação
- `POST /save-cadastro` - Registro de novo usuário
- `POST /login` - Autenticação de usuário

### Publicação
- `POST /save-publicar` - Criar nova publicação
- `GET /list-publicar` - Listar todas as publicações
- `POST /update-publicar` - Atualizar publicação
- `POST /delete-publicar` - Deletar publicação
- `GET /publicar-form` - Formulário de publicação

### Assinatura
- `GET /assinatura-form` - Formulário de assinatura
- `POST /save-assinatura` - Processar assinatura

### Pagamento
- `POST /save-pagamento` - Processar pagamento
- `GET /list-pagamentos` - Listar pagamentos

---

## 👥 Contribuindo

Contribuições são bem-vindas! Para contribuir:

1. Faça um Fork do projeto
2. Crie uma branch para sua feature (`git checkout -b feature/NovaFuncionalidade`)
3. Commit suas mudanças (`git commit -m 'Adiciona nova funcionalidade'`)
4. Push para a branch (`git push origin feature/NovaFuncionalidade`)
5. Abra um Pull Request

---

## 📝 Licença

Este projeto está sob a licença MIT. Veja o arquivo `LICENSE` para mais detalhes.

---

## 👨‍💻 Equipe de Desenvolvimento

Desenvolvido por estudantes do SENAI como projeto educacional.

**Branch Atual:** Diego  
**Repositório:** [github.com/liviahayashida/whileplay_aez](https://github.com/liviahayashida/whileplay_aez)

---

## 📞 Suporte

Para suporte, abra uma issue no GitHub ou entre em contato através do sistema de suporte integrado na plataforma.

---

## 🎯 Roadmap

- [ ] Sistema de avaliações e comentários
- [ ] Sistema de busca avançada de roteiros
- [ ] Integração com gateway de pagamento real
- [ ] Sistema de mensagens entre usuários
- [ ] Dashboard administrativo completo
- [ ] API RESTful completa
- [ ] Aplicativo mobile
- [ ] Sistema de notificações
- [ ] Exportação de roteiros em PDF

---

## 📚 Recursos Adicionais

- [Documentação PHP](https://www.php.net/docs.php)
- [MySQL Documentation](https://dev.mysql.com/doc/)
- [PDO Tutorial](https://www.php.net/manual/pt_BR/book.pdo.php)
- [MVC Pattern](https://en.wikipedia.org/wiki/Model%E2%80%93view%E2%80%93controller)

---

<div align="center">
  
**Transforme suas Ideias em Arte** 🎬✨

Feito com ❤️ pela equipe WhilePlay AEZ

</div>
