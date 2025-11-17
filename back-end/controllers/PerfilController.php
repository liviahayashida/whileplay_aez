<?php
require_once __DIR__ . '/../models/Perfil.php';

class PerfilController {

    public function atualizar() {

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {

            // Dados recebidos do formulário
            $email = $_POST['email'] ?? '';
            $nome = $_POST['nome_completo'] ?? '';
            $username = $_POST['username'] ?? '';
            $bio = $_POST['biografia'] ?? '';
            $senha = $_POST['senha'] ?? '';
            $data = $_POST['data_criacao'] ?? '';
            $imagem = $_FILES['imagem']['name'] ?? null;

            $perfil = new Perfil();

            // Buscar ID pelo e-mail
            $id = $perfil->buscarIdPorEmail($email);

            if (!$id) {
                echo "<script>alert('Erro: Nenhum perfil encontrado com este e-mail.'); window.history.back();</script>";
                exit;
            }

            // Upload da imagem (opcional)
            if ($imagem) {
                $caminho = "../uploads/" . basename($imagem);
                move_uploaded_file($_FILES['imagem']['tmp_name'], $caminho);
            } else {
                $caminho = null;
            }

            // Atualizar no banco
            $ok = $perfil->atualizar($id, $nome, $username, $bio, $email, $senha, $data, $caminho);

            if ($ok) {
                echo "<script>
                        alert('Perfil atualizado com sucesso!');
                        window.location.href = document.referrer;
                      </script>";
                exit;
            } else {
                echo "<script>alert('Erro ao atualizar perfil.'); window.history.back();</script>";
            }
        }
    }
}
