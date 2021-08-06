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
        <div class="h2 text-center mt-5 title">Titulo</div>
        <div class="row justify-content-center">
            <div class="col-6 card bg-light p-3 mt-3">
                <div class="h5">Subtitulo</div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-Titulo" placeholder="Seu titulo aqui..."
                                   required>
                            <label for="float-Titulo">Título do Serviço</label>
                            <div class="invalid-feedback">
                                Favor inserir o título do serviço.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="date" class="form-control" id="float-DescricaoLonga"
                                   placeholder="Sua descricao aqui..." required>
                            <label for="float-DescricaoLonga">Descrição Completa</label>
                            <div class="invalid-feedback">
                                Favor inserir a descrição completa.
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-ValorDesejado"
                                   placeholder="Seu cpf aqui..."
                                   required>
                            <label for="float-ValorDesejado">Valor Desejado</label>
                            <div class="invalid-feedback">
                                Favor inserir o valor desejado.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-floating mb-3">
                            <input type="text" class="form-control" id="float-DataExpiracao"
                                   placeholder="Sua data de expiração aqui..." required>
                            <label for="float-DataExpiracao">Prazo de Duração do Anúncio</label>
                            <div class="invalid-feedback">
                                Favor inserir o prazo limite do anúncio.
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12 text-center">
                        <button type="submit" class="btn btn-success one-btn-size">Anunciar</button>
                    </div>
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