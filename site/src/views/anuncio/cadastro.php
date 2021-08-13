<?php
require "../../../../generics/Constants.php";
require "../../../../" . Constants::API_CONFIG . "Configuration.php";
require "../../../../" . Constants::SITE_HEADER;
?>
<script src="../../js/anuncio/anuncio.js"></script>
<script src="../../js/generic/genericFunctions.js"></script>
</head>
<body>
<?php require "../../../../" . Constants::SITE_MENU ?>
<div class="container-fluid">
    <form id="form-cadastro" class="needs-validation" method="POST" novalidate>
        <div class="h2 text-center mt-5 title"></div>
        <div class="row justify-content-center">
            <div class="col-6 card bg-light p-3 mt-3">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-Titulo" placeholder="Seu titulo aqui..."
                                   required>
                            <label for="float-Titulo">Título do Serviço</label>
                            <div class="invalid-feedback">
                                Favor inserir o título do serviço.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-DescricaoCurta"
                                   placeholder="Sua descricao curta aqui..." required>
                            <label for="float-DescricaoCurta">Breve Descrição <small>(100 caracteres)</small></label>
                            <div class="invalid-feedback">
                                Favor inserir uma breve descrição.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-floating mb-3">
                            <div class="form-floating">
                                <textarea class="form-control"
                                          placeholder="Seu cpf aqui..."
                                          id="float-DescricaoLonga"
                                          style="height: 100px">
                                </textarea>
                                <label for="float-DescricaoLonga">Descrição Completa</label>
                            </div>
                            <div class="invalid-feedback">
                                Favor inserir a descrição.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-ValorDesejado"
                                   placeholder="Seu cpf aqui..."
                                   required>
                            <label for="float-ValorDesejado">Valor Sugerido</label>
                            <div class="invalid-feedback">
                                Favor inserir o valor sugerido.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="float-DataExpiracao"
                                   placeholder="Sua data de expiração aqui..." required>
                            <label for="float-DataExpiracao">Prazo de Duração do Anúncio</label>
                            <div class="invalid-feedback">
                                Favor inserir o prazo limite do anúncio.
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
        var params = pegaQueryString();
        checarEdicaoCadastro(params.id);
        cadastrarAnuncio(params.id)
        $('#float-ValorDesejado').mask('000.000,00', {reverse: true});
        /*
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
                                        // cadastrarUsuario(params.id);
                                        form.classList.add('was-validated');
                                }, false)
                            })
                    })()

         */
    });
</script>

<?php require "../../../../" . Constants::SITE_FOOTER ?>
</html>