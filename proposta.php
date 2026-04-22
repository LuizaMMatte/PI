<?php include 'header.php'; ?>

<main class="container mt-4">

    <section class="sobre-projeto">
<h2 class="mb-3 text-center" style="color: #F47939;">
    “Receitas que contam histórias e guardam memórias.” </h2>
        
        <h2 class="mb-3">Sobre o Projeto</h2>

        <p>
            O projeto nasce da observação de que, em muitas famílias, encontros e comemorações giram em torno da comida e da convivência na cozinha. 
            No entanto, notou-se que muitas receitas acabam se perdendo com o tempo, seja por falta de organização, esquecimento ou pelo falecimento de entes queridos.
        </p>

        <p>
            Diante desse cenário, a iniciativa foi desenvolvida com o objetivo de preservar essas lembranças e facilitar o seu compartilhamento entre familiares e amigos, 
            como uma forma de eternizá-las.
        </p>

        <p>
            Assim, o projeto consiste no desenvolvimento de um sistema voltado para o armazenamento e compartilhamento de receitas de forma personalizada, 
            permitindo a preservação de memórias afetivas relacionadas às receitas familiares.
        </p>

        <p>
            Além de funcionalidades tecnológicas, o sistema valoriza a conexão emocional com a gastronomia, oferecendo um espaço único para a organização e enriquecimento 
            das receitas com histórias, fotos e vídeos.
        </p>

    </section>

    <section class="diferencial mt-4">
        <h3>Nosso diferencial</h3>

        <p>
            Mais do que um simples site de receitas, este projeto busca resgatar memórias, fortalecer laços afetivos e transformar a culinária em uma experiência emocional e significativa.
        </p>
    </section>

</main>

<?php include 'footer.php'; ?>

<!-- Acessibilidade -->
<div class="acessibilidade">
    <button onclick="aumentarFonte()">A+</button>
    <button onclick="diminuirFonte()">A-</button>
</div>

<script>
let tamanhoFonte = 100;

function aumentarFonte() {
    if (tamanhoFonte < 150) {
        tamanhoFonte += 10;
        document.body.style.fontSize = tamanhoFonte + "%";
    }
}

function diminuirFonte() {
    if (tamanhoFonte > 70) {
        tamanhoFonte -= 10;
        document.body.style.fontSize = tamanhoFonte + "%";
    }
}
</script>

<!-- VLibras -->
<div vw class="enabled">
    <div vw-access-button class="active"></div>
    <div vw-plugin-wrapper>
        <div class="vw-plugin-top-wrapper"></div>
    </div>
</div>

<script src="https://vlibras.gov.br/app/vlibras-plugin.js"></script>
<script>
    new window.VLibras.Widget('https://vlibras.gov.br/app');
</script>