<?php
require_once __DIR__ . '/../models/Suporte.php';

class SuporteController {

    public function showForm() {
        require __DIR__ . '/../views/suporte_form.php';
    }

    public function saveSuporte() {

        $email = $_POST['email'] ?? null;
        $mensagem = $_POST['mensagem'] ?? null;

        if (!$email || !$mensagem) {
            echo "Erro: dados incompletos.";
            return;
        }

        $suporte = new Suporte();

        // Buscar ID pelo e-mail
        $usuario_id = $suporte->buscarUsuarioIdPorEmail($email);

        if (!$usuario_id) {
            echo "<script>alert('Nenhum usuário encontrado com este e-mail!');</script>";
            require __DIR__ . '/../views/suporte_form.php';
            return;
        }

        // Salvar suporte
        if ($suporte->salvarSuporte($usuario_id, $mensagem)) {
            $this->popupSucesso();
        } else {
            echo "Erro ao salvar suporte.";
        }

        require __DIR__ . '/../views/suporte_form.php';
    }

    private function popupSucesso() {
        echo "
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                const box = document.createElement('div');
                box.innerText = 'Sucesso! Sua solicitação foi enviada e será avaliada.';
                box.style.position = 'fixed';
                box.style.top = '20px';
                box.style.right = '20px';
                box.style.padding = '15px';
                box.style.background = '#4CAF50';
                box.style.color = 'white';
                box.style.borderRadius = '10px';
                box.style.fontSize = '16px';
                box.style.boxShadow = '0 3px 10px rgba(0,0,0,0.2)';
                box.style.zIndex = '99999';
                document.body.appendChild(box);

                setTimeout(() => box.remove(), 3000);
            });
        </script>
        ";
    }
}
?>
