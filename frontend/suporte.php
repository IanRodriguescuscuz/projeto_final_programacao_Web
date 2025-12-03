<?php
// Página de suporte - versão compacta
if (!isset($_SESSION)) {
    session_start();
}
include_once "topo.php";
?>

<div class="parent5">
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

    <!-- Cartão compacto com contatos e link para formulário -->
    <div class="suporte-compact">
        <div class="suporte-card">
            <h3 class="suporte-titulo">Formas de contato</h3>
            <div class="suporte-itens">
                <div><strong>Email:</strong> <a href="mailto:suporte@pesca.com.br">suporte@pesca.com.br</a></div>
                <div><strong>WhatsApp:</strong> <a href="https://wa.me/5511999998888" target="_blank">(11) 99999-8888</a></div>
                <div><strong>Telefone:</strong> <a href="tel:+551134567890">(11) 3456-7890</a></div>
            </div>
            <div style="margin-top: 15px; text-align: center;">
                <a href="contato.php" class="button2">Preencher Formulário</a>
            </div>
        </div>
    </div>

    <!-- Seção de Perguntas Frequentes (FAQ) -->
    <div class="faq-container">
        <h2 class="subtitulo-suporte">❓ Perguntas Frequentes</h2>

        <div class="faq-item">
            <div class="faq-pergunta" onclick="toggleFAQ(this)">
                <span>Como faço para criar uma conta?</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-resposta" style="display:none;">
                Você pode criar uma conta clicando em "Login" no menu principal e selecionando a opção "Registrar". Preencha seus dados e clique em "Criar Conta". Você receberá um email de confirmação.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-pergunta" onclick="toggleFAQ(this)">
                <span>Qual é a melhor época para pescar?</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-resposta" style="display:none;">
                A melhor época varia conforme a espécie e região. Consulte nosso guia "Como Pescar" para recomendações específicas sobre técnicas, equipamentos e estações ideais para cada tipo de pesca.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-pergunta" onclick="toggleFAQ(this)">
                <span>Vocês oferecem cursos de pesca?</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-resposta" style="display:none;">
                No momento, oferecemos guias e materiais educativos através da página "Como Pescar". Para cursos especializados, entre em contato conosco via formulário ou pelos números de telefone disponíveis.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-pergunta" onclick="toggleFAQ(this)">
                <span>Como faço para recuperar minha senha?</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-resposta" style="display:none;">
                Na página de login, clique em "Esqueci minha senha". Você receberá um link de redefinição no email associado à sua conta. Clique no link e escolha uma nova senha.
            </div>
        </div>

        <div class="faq-item">
            <div class="faq-pergunta" onclick="toggleFAQ(this)">
                <span>Posso contatar o suporte via WhatsApp?</span>
                <span class="faq-icon">▼</span>
            </div>
            <div class="faq-resposta" style="display:none;">
                Sim! Clique no link de WhatsApp disponível na seção "Formas de contato" acima. Nosso time responde entre 9h e 18h, de segunda a sexta-feira.
            </div>
        </div>
    </div>

    <script>
        function toggleFAQ(element) {
            const resposta = element.nextElementSibling;
            const icon = element.querySelector('.faq-icon');
            
            if (resposta.style.display === 'none' || resposta.style.display === '') {
                resposta.style.display = 'block';
                icon.style.transform = 'rotate(180deg)';
            } else {
                resposta.style.display = 'none';
                icon.style.transform = 'rotate(0deg)';
            }
        }
    </script>

</div>

</html>
