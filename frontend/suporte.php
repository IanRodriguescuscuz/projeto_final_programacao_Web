<?php
// ========== INICIALIZAÇÃO ==========
if (!isset($_SESSION)) {
    session_start();
}
include_once "topo.php";
?>

<!-- ========== PÁGINA DE SUPORTE ========== -->
<div class="parent">

    <!-- ========== CABEÇALHO ==========  -->
    <div class="container4">
        <div class="baby">
            <div class="container3">
                <img class="ian6" src="assets/ChatGPT Image 2 de dez. de 2025, 19_30_17.png" alt="Suporte">
                <h1 class="textou2">Entre em contato conosco!</h1>
            </div>
        </div>
        <h1 class="titulo3">Central de Suporte</h1>
    </div>

    <!-- ========== MENSAGENS DE ALERTA ========== -->
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

    <!-- ========== INFORMAÇÕES DE CONTATO ========== -->
    <div class="baby2">
        <div class="info-contato">
            <h2 class="subtitulo-suporte">📞 Formas de Contato</h2>
            
            <div class="contato-item">
                <strong>Email:</strong> suporte@pesca.com.br
            </div>
            <div class="contato-item">
                <strong>WhatsApp:</strong> (11) 99999-8888
            </div>
            <div class="contato-item">
                <strong>Telefone:</strong> (11) 3456-7890
            </div>
            <div class="contato-item">
                <strong>Horário:</strong> Segunda a Sexta, 9h às 18h
            </div>
        </div>
    </div>

    <!-- ========== FORMULÁRIO DE CONTATO ========== -->
    <div class="formulario-container">
        <h2 class="subtitulo-suporte">📝 Envie sua Mensagem</h2>
        
        <form method="POST" action="processar_suporte.php" class="formulario-suporte">
            
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
                <textarea id="mensagem" name="mensagem" class="campo campo-textarea" rows="6" placeholder="Digite sua mensagem aqui..." required></textarea>
            </div>

            <button type="submit" class="button2">Enviar Mensagem</button>
        </form>
    </div>

    <!-- ========== SEÇÃO FAQ ========== -->
    <div class="faq-container">
        <h2 class="subtitulo-suporte">❓ Perguntas Frequentes</h2>
        
        <!-- FAQ Item 1 -->
        <div class="faq-item">
            <div class="faq-pergunta" onclick="toggleFaq(this)">
                <strong>Como faço para acessar minha conta?</strong>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-resposta">
                Para acessar sua conta, clique em "Login" no menu superior, insira seu email e senha. Se esqueceu a senha, entre em contato conosco.
            </div>
        </div>

        <!-- FAQ Item 2 -->
        <div class="faq-item">
            <div class="faq-pergunta" onclick="toggleFaq(this)">
                <strong>Qual é o melhor período para pescar?</strong>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-resposta">
                O melhor período varia conforme a espécie de peixe e a região. Geralmente, o amanhecer e o entardecer são excelentes. Visite nossa página "Como pescar" para mais dicas.
            </div>
        </div>

        <!-- FAQ Item 3 -->
        <div class="faq-item">
            <div class="faq-pergunta" onclick="toggleFaq(this)">
                <strong>Como funciona o cadastro de usuário?</strong>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-resposta">
                O cadastro é simples e rápido. Clique em "Login", depois em "Não tem conta?", preencha seus dados e confirme. Pronto! Você já pode navegar.
            </div>
        </div>

        <!-- FAQ Item 4 -->
        <div class="faq-item">
            <div class="faq-pergunta" onclick="toggleFaq(this)">
                <strong>Quais equipamentos são recomendados para iniciantes?</strong>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-resposta">
                Acesse nossa página de "Equipamentos" para conhecer as melhores opções para iniciantes. Temos recomendações de varas, linhas, anzóis e muito mais.
            </div>
        </div>

        <!-- FAQ Item 5 -->
        <div class="faq-item">
            <div class="faq-pergunta" onclick="toggleFaq(this)">
                <strong>Como reportar um problema no site?</strong>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-resposta">
                Use o formulário de contato acima selecionando "Problema técnico" como assunto, descreva o problema detalhadamente e envie. Responderemos o mais breve possível.
            </div>
        </div>

    </div>

</div>

<!-- ========== JAVASCRIPT ==========  -->
<script>
    // Toggle FAQ - Abre/Fecha as respostas
    function toggleFaq(element) {
        const resposta = element.nextElementSibling;
        resposta.style.display = resposta.style.display === 'none' ? 'block' : 'none';
        const icon = element.querySelector('.faq-icon');
        icon.textContent = resposta.style.display === 'none' ? '▼' : '▲';
    }

    // Fecha todos os FAQs por padrão ao carregar a página
    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.faq-resposta').forEach(el => {
            el.style.display = 'none';
        });
    });
</script>

</body>
</html>
