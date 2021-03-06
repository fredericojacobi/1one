<?php
require "../../../../generics/Constants.php";
require "../../../../" . Constants::API_CONFIG . "Configuration.php";
require "../../../../" . Constants::SITE_HEADER;
?>
<script src="../../js/cadastro/cadastro.js"></script>
<script src="../../js/generic/genericFunctions.js"></script>
</head>
<body>
<?php require "../../../../" . Constants::SITE_MENU ?>
<div class="container-fluid">
    <form id="form-cadastro" class="needs-validation" method="POST" novalidate>
        <div class="h2 text-center mt-5 title"></div>
        <div class="row justify-content-center">
            <div class="col-6 card bg-light p-3 mt-3">
                <div class="h5">Dados Pessoais</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-Nome" placeholder="Seu nome aqui..."
                                   required>
                            <label for="float-Nome">Nome</label>
                            <div class="invalid-feedback">
                                Favor inserir seu nome.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-Sobrenome"
                                   placeholder="Seu Sobrenome aqui..." required>
                            <label for="float-Sobrenome">Sobrenome</label>
                            <div class="invalid-feedback">
                                Favor inserir seu sobrenome.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="float-DataNascimento"
                                   placeholder="Seu nascimento aqui..." required>
                            <label for="float-DataNascimento">Data de Nascimento</label>
                            <div class="invalid-feedback">
                                Favor inserir sua data de nascimento.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-Cpf" placeholder="Seu cpf aqui..."
                                   required>
                            <label for="float-Cpf">CPF</label>
                            <div class="invalid-feedback">
                                Favor inserir seu CPF.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-Endereco"
                                   placeholder="Seu endereco aqui..." required>
                            <label for="float-Endereco">Endere??o</label>
                            <div class="invalid-feedback">
                                Favor inserir seu endere??o.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-Telefone"
                                   placeholder="Seu telefone aqui..." minlength="14" required>
                            <label for="float-Telefone">Telefone</label>
                            <div class="invalid-feedback">
                                Favor inserir o seu telefone.
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="m-0 mb-3">
                <div class="h5">Dados de Login</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="email" class="form-control" id="float-Email"
                                   placeholder="Seu email aqui..." required>
                            <label for="float-Email">Email</label>
                            <div class="invalid-feedback">
                                Favor inserir o seu email.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6" id="confirmarSenha"></div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="float-Senha"
                                   minlength="6"
                                   maxlength="20"
                                   placeholder="Sua senha aqui..." required>
                            <label for="float-Senha">Senha</label>
                            <div class="invalid-feedback">
                                <span id="senha"></span>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="password" class="form-control" id="float-ConfirmarSenha"
                                   placeholder="Sua senha aqui..." required>
                            <label for="float-Confirmarsenha">Confirmar Senha</label>
                            <div class="invalid-feedback">
                                Senhas diferentes!
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="m-0 mb-3">
                <div class="h5">Documentos</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <div class="card p-2">
                                <label for="float-AntecedentesCriminais" class="mb-2">Antecedentes Criminais</label>
                                <input type="file" class="form-control" id="float-AntecedentesCriminais">
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group mb-3">
                            <div class="card p-2">
                                <label for="float-ArquivoCpf" class="mb-2">Documento CPF</label>
                                <input type="file" class="form-control" id="float-ArquivoCpf">
                            </div>
                        </div>
                    </div>
                </div>
                <hr class="m-0 mb-3">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <select class="form-select" id="float-TipoUsuario" aria-label="Seu tipo usuario aqui..."
                                    required>
                                <option selected value="">Selecione ...</option>
                                <option value="1">Quero contratar!</option>
                                <option value="0">Quero trabalhar!</option>
                            </select>
                            <label for="float-TipoUsuario">O que voc?? deseja?</label>
                            <div class="invalid-feedback">
                                Favor escolher o que voc?? deseja.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 buttonSubmit text-center"></div>
                </div>
            </div>
        </div>
    </form>
</div>
</body>
<script type="text/javascript">
    $('document').ready(function () {
            $('#birth-date').mask('00/00/0000');
            $('#float-Cpf').mask('000.000.000-00');
            $('#float-Telefone').mask('(00)00000-0000');
            var params = pegaQueryString();
            checarEdicaoCadastro(params.id);

            $('#float-Senha').on('keypress', function(){
                (contagemCaracter('float-Senha'))
            });

            var senha = document.getElementById("float-Senha")
                , confirmarSenha = document.getElementById("float-ConfirmarSenha");
            function checarSenha() {
                if(checarTamanhoSenha(senha.value) == false){
                    $('#senha').text('Senha muito pequena.');
                    senha.setCustomValidity('Tamanho da senha incorreto.');
                } else {
                    $('#senha').text('Senha muito grande.');
                    senha.setCustomValidity('');
                    if (senha.value != confirmarSenha.value) {
                        confirmarSenha.setCustomValidity('Senhas diferentes!');
                    } else {
                        confirmarSenha.setCustomValidity('');
                    }
                }
            }

            (function () {
                'use strict'
                var forms = document.querySelectorAll('.needs-validation');
                Array.prototype.slice.call(forms)
                    .forEach(function (form) {
                        form.addEventListener('submit', function (event) {
                            checarSenha()
                            if (!form.checkValidity()) {
                                event.preventDefault();
                                event.stopPropagation();
                            } else
                                cadastrarUsuario(params.id);
                            form.classList.add('was-validated');
                        }, false)
                    })
            })()
        }
    )
    ;
</script>

<?php require "../../../../" . Constants::SITE_FOOTER ?>
</html>