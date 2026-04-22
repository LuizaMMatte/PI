<footer style="background-color: #F15E66; padding: 20px; padding-bottom: 10px; display: flex;" >
    <div class="container">
        <div>
            <div style="display: grid; justify-content: center; gap: 10px;">
                <a href="termos.php" class="text-white text-decoration-none fs-5" style="padding-left: 20px;">Política de Privacidade</a>
                <img src="IMAGES/Logo-ReceitasAfetivasHORINZONTALbranco-03.png" width="250" class="img-fluid">
                <p style="margin-bottom: 0px; color: white; padding-left: 40px; font-size: small;">&copy; Luiza Marinho Matte 2026.</p>
            </div>
        </div>
    </div>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

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

<div class="acessibilidade">
    <button onclick="aumentarFonte()" title="Aumentar texto">A+</button>
    <button onclick="diminuirFonte()" title="Diminuir texto">A-</button>
</div>

<script>
    let tamanhoFonte = 100; // Começa em 100%

    function aumentarFonte() {
        if (tamanhoFonte < 150) { // Limite máximo de 150%
            tamanhoFonte += 10;
            document.body.style.fontSize = tamanhoFonte + "%";
        }
    }

    function diminuirFonte() {
        if (tamanhoFonte > 80) { // Limite mínimo de 80%
            tamanhoFonte -= 10;
            document.body.style.fontSize = tamanhoFonte + "%";
        }
    }
</script>
</body>

</html>