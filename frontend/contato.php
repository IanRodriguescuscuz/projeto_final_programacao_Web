<?php
// Página dedicada ao formulário de contato
if (!isset($_SESSION)) {
    session_start();
}
include_once "topo.php";
?>

<div class="parent">
    <div class="container4">
        <div class="baby">
            <div class="container3">
                <img class="ian6" src="assets/ChatGPT Image 2 de dez. de 2025, 19_30_17.png" alt="Contato">
                <h1 class="textou2">Formulário de Contato</h1>
            </div>
        </div>
        <h1 class="titulo3">Fale com a nossa equipe</h1>
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

    <div class="formulario-container">
        <h2 class="subtitulo-suporte">📝 Envie sua Mensagem</h2>

        <form method="POST" action="processar_suporte.php" class="formulario-suporte">
            <input type="hidden" name="redirect" value="contato.php">

            <div class="form-group">
                <label for="nome" class="label-form">Nome:</label>
                <input type="text" id="nome" name="nome" class="campo" required>
            </div>

            <div class="form-group">
                <label for="email" class="label-form">Email:</label>
                <input type="email" id="email" name="email" class="campo" required>
            </div>

            <div class="form-group">
                <label for="telefone" class="label-form">Telefone (opcional):</label>
                <input type="tel" id="telefone" name="telefone" class="campo">
            </div>

            <div class="form-group">
                <label for="assunto" class="label-form">Assunto:</label>
                <select id="assunto" name="assunto" class="campo" required>
                    <option value="">Selecione um assunto</option>
                    <option value="duvida">Dúvida sobre o site</option>
                    <option value="problema">Problema técnico</option>
                    <option value="sugestao">Sugestão de melhoria</option>
                    <option value="reclamacao">Reclamação</option>
                    <option value="outro">Outro</option>
                </select>
            </div>

            <div class="form-group">
                <label for="mensagem" class="label-form">Mensagem:</label>
                <textarea id="mensagem" name="mensagem" class="campo campo-textarea" rows="6" placeholder="Descreva seu pedido ou problema..." required></textarea>
            </div>

            <button type="submit" class="button2">Enviar Mensagem</button>
        </form>

        <div style="margin-top: 20px; text-align: center;">
            <a href="suporte.php" class="button2" style="text-decoration:none; display:inline-block;">← Voltar ao Suporte</a>
        </div>
    </div>
</div>

</body>
</html>
