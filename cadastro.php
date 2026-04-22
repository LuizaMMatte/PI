<?php include 'header.php'; ?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="utf-8">
    <title>Receitas Afetivas</title>

    <!-- Estilo Personalizado -->
    <link rel="stylesheet" type="text/css" href="CSS/estilo.css">

    <script>
        function valida() {
            let email = document.getElementById("email").value.trim();
            let senha = document.getElementById("senha").value.trim();
            let nome = document.getElementById("nome").value.trim();
            let cpf = document.getElementById("cpf").value.trim();
            let endereco = document.getElementById("endereco").value.trim();
            let complemento = document.getElementById("complemento").value.trim();
            let cep = document.getElementById("cep").value.trim();

            
            if (email.length < 3 || email.value == "") {
                alert("Email incorreto, digite novamente.")
                email.focus();
                return;
            }
            if (senha.length < 6 || senha.value == "") {
                alert("Senha inválida, é necessário ao menos 6 caracteres. Tente novamente.")
                senha.focus();
                return;
            }
            if (nome.length < 3 || nome.value == "") {
                alert("Volte ao campo nome e digite corretamente.")
                nome.focus();
                return;
            }
            if (cpf.length < 11 || ncpf.value == "") {
                alert("Volte ao campo CPF e digite corretamente.")
                cpf.focus();
                return;
            }
            if (endereco.length < 3 || endereco.value == "") {
                alert("Endereço inválido, tente novamente.")
                senha.focus();
                return;
            }
            if (complemento.length < 3 || complemento.value == "") {
                alert("Complemento inválido, tente novamente.")
                senha.focus();
                return;
            }
            if (cep.length < 8 || cep.value == "") {
                alert("CEP inválido, tente novamente.")
                senha.focus();
                return;
            }

            return true;

       }
       
        //https://devarthur.com/blog/funcao-javascript-para-validar-cpf

                                function validaCPF(cpf) {
        //declaração das variáveis
                                var Soma = 0
                                var Resto
        //deixando somente números, para excluir as outras possibilidades de caracteres
                                var strCPF = String(cpf).replace(/[^\d]/g, '')
        //confirmar que tem ao menos 11 caracteres numéricos                               
                                if (strCPF.length !== 11)
                                    return false
        //descartar a repetição de números                                   
                                if ([
                                    '00000000000',
                                    '11111111111',
                                    '22222222222',
                                    '33333333333',
                                    '44444444444',
                                    '55555555555',
                                    '66666666666',
                                    '77777777777',
                                    '88888888888',
                                    '99999999999',
                                    ].indexOf(strCPF) !== -1)
                                    return false
        //ParseInt pra transformar string em int
                                for (i=1; i<=9; i++)
                                    Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);

                                Resto = (Soma * 10) % 11

                                if ((Resto == 10) || (Resto == 11)) 
                                    Resto = 0

                                if (Resto != parseInt(strCPF.substring(9, 10)) )
                                    return false

                                Soma = 0

                                for (i = 1; i <= 10; i++)
                                    Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i)

                                Resto = (Soma * 10) % 11

                                if ((Resto == 10) || (Resto == 11)) 
                                    Resto = 0

                                if (Resto != parseInt(strCPF.substring(10, 11) ) )
                                    return false;
        //se passou por tudo, é válido e é enviado
                                return true;
                                }
                        function validarCPF(cpf) {
                          let cpf = document.getElementById("cpf").value;

                            if (!validaCPF(cpf)){
                            alert ("CPF inválido!");
                            return false;//impere o envio
                            }
                            return true;//permite o envio
                        }

    </script>
</head>
<body>

    <!-- Conteúdo Principal -->
    <main>
            <div class="container mt-5">
                <h1 class="mb-4">Cadastro de Usuário</h1>
                
                <form id="formulario" action="PHP/processar.php" method="post" onsubmit="return valida(event)">
                    <fieldset class="border p-4 rounded">
                        
                        <div class="row g-3">
                            <div class="col-md-12">
                                <label for="email" class="form-label" style="color: #F15E66;">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="col-md-12">
                                <label for="senha" class="form-label" style="color: #F15E66;">Senha:</label>
                                <input type="password" class="form-control" id="senha" name="senha" required>
                            </div>
                            
                            <div class="col-12">
                                <label for="nome" class="form-label" style="color: #F15E66;">Nome:</label>
                                <input type="text" class="form-control" id="nome" name="nome" required>
                            </div>
                            
                            <div class="col-12">
                                <label for="cpf" class="form-label" style="color: #F15E66;">CPF:</label>
                                <input type="text" class="form-control" id="cpf" name="cpf" maxlength="14" required>
                            </div>
                            
                            <div class="col-md-2">
                                <label for="cep" class="form-label" style="color: #F15E66;">CEP:</label>
                                <input type="text" class="form-control" id="cep" name="cep" value="<?php echo htmlspecialchars($endereco['cep'] ?? ''); ?>" required>
                            </div>
    
                            <div class="col-10">
                                <label for="endereco" class="form-label" style="color: #F15E66;">Endereço:</label>
                                <input type="text" class="form-control" id="endereco" name="endereco" placeholder="Rua da Praia">
                            </div>
                            
                            <div class="col-12">
                                <label for="complemento" class="form-label" style="color: #F15E66;">Complemento:</label>
                                <input type="text" class="form-control" id="complemento" name="complemento" placeholder="***">
                            </div>
                            
                            <div class="col-md-8">
                                <label for="cidade" class="form-label" style="color: #F15E66;">Cidade:</label>
                                <input type="text" class="form-control" id="cidade" name="cidade">
                            </div>
                            
                            <div class="col-md-4">
                                <label for="estado" class="form-label" style="color: #F15E66;">Estado:</label>
                                <input type="text" class="form-control" id="estado" name="estado" maxlength="2" value="<?php echo htmlspecialchars($endereco['estado'] ?? ''); ?>" required>
                            </div>
                            
                            <div class="col-12 mt-3">
                                <div class="form-check">
                                    <input class="form-check-input" type="checkbox" id="termos" required>
                                    <label class="form-check-label" for="termos">
                                        <a href="termos.php">Aceito os Termos e Políticas</a>
                                    </label>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-4">
                                <button type="submit" class="btn text-white" style="background-color: #F15E66;">Cadastrar</button>                
                            </div>
                        </div>
                    </fieldset>
                </form>
            </div>
        </main>
    
        <script>

    
            // Validação principal ao enviar
            function valida(event) {
                // Pegando valores
                let email = document.getElementById("email").value.trim();
                let senha = document.getElementById("senha").value.trim();
                let nome = document.getElementById("nome").value.trim();
                let cpf = document.getElementById("cpf").value.trim();
                
                // Validações básicas
                if (nome.length < 3) {
                    alert("Nome muito curto.");
                    document.getElementById("nome").focus();
                    event.preventDefault(); // Impede o envio
                    return false;
                }
                
                if (!validaCPF(cpf)) {
                    alert("CPF inválido!");
                    document.getElementById("cpf").focus();
                    event.preventDefault();
                    return false;
                }
    
                if (senha.length < 6) {
                    alert("A senha deve ter no mínimo 6 caracteres.");
                    document.getElementById("senha").focus();
                    event.preventDefault();
                    return false;
                }
    
                // Se passar por tudo, retorna true e o form é enviado
                return true;
            }
    
            // Sua função validaCPF (mantida igual, pois estava correta a lógica)
            function validaCPF(cpf) {
                var Soma = 0;
                var Resto;
                var strCPF = String(cpf).replace(/[^\d]/g, '');
                
                if (strCPF.length !== 11) return false;
                
                if (['00000000000','11111111111','22222222222','33333333333','44444444444','55555555555','66666666666','77777777777','88888888888','99999999999'].indexOf(strCPF) !== -1) return false;
    
                for (i=1; i<=9; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (11 - i);
                Resto = (Soma * 10) % 11;
    
                if ((Resto == 10) || (Resto == 11)) Resto = 0;
                if (Resto != parseInt(strCPF.substring(9, 10)) ) return false;
    
                Soma = 0;
                for (i = 1; i <= 10; i++) Soma = Soma + parseInt(strCPF.substring(i-1, i)) * (12 - i);
                Resto = (Soma * 10) % 11;
    
                if ((Resto == 10) || (Resto == 11)) Resto = 0;
                if (Resto != parseInt(strCPF.substring(10, 11) ) ) return false;
    
                return true;
            }
        </script>
    
    </main>

 <div vw class="enabled">
<div vw-access-button class="active"></div>
  <div vw-plugin-wrapper>
    <div class="vw-plugin-top-wrapper"></div>
  </div>
</div>

<script src="_js/getCEP.js"></script>
<?php include 'footer.php'; ?>