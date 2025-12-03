<?php
// Página de equipamentos — seção interativa verde restaurada
if (!isset($_SESSION)) {
    session_start();
}
include_once "topo.php";
?>

<div class="parent">

    <!-- Card 1: Vara -->
    <div class="child">
        <div class="container">
            <div class="container">
                <img class="ian4" src="assets/vara_de_pesca_deep_iii_2543113_1_26daafaefa0b4cdc0616d3faefe26781.webp" alt="Vara de pesca">
            </div>
            <div class="container">
                <h1 class="textou">A vara de pesca serve para lançar a isca a uma distância maior e controlar o movimento durante a pescaria. Ela ajuda o pescador a sentir as puxadas do peixe e facilita trazer o peixe até a margem ou barco.</h1>
            </div>
        </div>
    </div>

    <!-- Card 2: Anzol -->
    <div class="child">
        <div class="container">
            <div class="container2">
                <img class="ian5" src="assets/Jp_Cartela_De_Anzol_4330_Aco_Niquel_N6_Jau_Pesca.jpeg" alt="Anzol">
                <div class="container">
                    <h1 class="textou10">O anzol é a peça que fisga o peixe. Ele segura a isca e, quando o peixe morde, sua ponta curva prende na boca, permitindo que o pescador recolha a captura com segurança.</h1>
                </div>
            </div>
        </div>
    </div>

    <!-- Card 3: Linha -->
    <div class="child">
        <div class="container">
            <div class="container">
                <img class="ian4" src="assets/shopping.webp" alt="Linha de pesca">
            </div>
            <div class="container">
                <h1 class="textou">A linha de pesca conecta o anzol à vara. Ela suporta o peso e a força do peixe, permitindo lançar e recolher a isca com precisão. Cada tipo de linha oferece resistência e flexibilidade diferentes.</h1>
            </div>
        </div>
    </div>

</div>

</body>
</html>