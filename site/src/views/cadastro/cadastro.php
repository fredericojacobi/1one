<?php
require "../../../../generics/Constants.php";
require "../../../../" . Constants::API_CONFIG . "Configuration.php";
require "../../../../" . Constants::SITE_HEADER;
?>
<script src="../../js/cadastro/cadastro.js"></script>
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
                            <label for="float-Endereco">Endereço</label>
                            <div class="invalid-feedback">
                                Favor inserir seu endereço.
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
                            <label for="float-TipoUsuario">O que você deseja?</label>
                            <div class="invalid-feedback">
                                Favor escolher o que você deseja.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3 buttonSubmit"></div>
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

        (function () {
            'use strict'
            var forms = document.querySelectorAll('.needs-validation');
            Array.prototype.slice.call(forms)
                .forEach(function (form) {
                    form.addEventListener('submit', function (event) {
                        if (!form.checkValidity()) {
                            event.preventDefault();
                            event.stopPropagation();
                        } else
                            cadastrarUsuario();
                        form.classList.add('was-validated');
                    }, false)
                })
        })()
        var params = Object.fromEntries(new URLSearchParams(window.location.search).entries());
        checarEdicaoCadastro(params.id);
    });
</script>

<?php require "../../../../" . Constants::SITE_FOOTER ?>
</html>