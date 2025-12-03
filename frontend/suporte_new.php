<?php
// Página de suporte - versão compacta
if (!isset($_SESSION)) {
    session_start();
}
include_once "topo.php";
?>

<div class="parent">
    <div class="container4">
        <div class="baby">
            <div class="container3">
                <img class="ian6" src="assets/ChatGPT Image 2 de dez. de 2025, 19_30_17.png" alt="Suporte">
                <h1 class="textou2">Entre em contato conosco!</h1>
            </div>
        </div>
        <h1 class="titulo3">Central de Suporte</h1>
    </div>

    <?php if (isset($_SESSION['sucesso'])): ?>
        <div class="alerta-mensagem alerta-sucesso">
            ✓ <?php echo $_SESSION['sucesso']; unset($_SESSION['sucesso']); ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_SESSION['erro'])): ?>
        <div class="alerta-mensagem alerta-erro">
            ✗ <?php echo $_SESSION['erro']; unset($_SESSION['erro']); ?>
        </div>
    <?php endif; ?>

    <!-- Cartão compacto com contatos e link para o formulário -->
    <div class="suporte-compact">
        <div class="suporte-card">
            <h3 class="suporte-titulo">Formas de contato</h3>
            <div class="suporte-itens">
                <div><strong>Email:</strong> <a href="mailto:suporte@pesca.com.br">suporte@pesca.com.br</a></div>
                <div><strong>WhatsApp:</strong> <a href="https://wa.me/5511999998888" target="_blank">(11) 99999-8888</a></div>
                <div><strong>Telefone:</strong> <a href="tel:+551134567890">(11) 3456-7890</a></div>
            </div>
            <div style="margin-top:12px; text-align:center;">
                <a href="contato.php" class="button2" style="text-decoration:none; display:inline-block;">Abrir Formulário de Contato</a>
            </div>
        </div>
    </div>

</div>

</body>
</html>
