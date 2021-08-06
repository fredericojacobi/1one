<?php
require "../../../../generics/Constants.php";
require "../../../../" . Constants::API_CONFIG . "Configuration.php";
require "../../../../" . Constants::SITE_HEADER;
?>
<script src="../../js/anuncio/anuncio.js"></script>
</head>

<body>
<?php require "../../../../" . Constants::SITE_MENU ?>
<div class="container-fluid">
    <div class="h2 text-center mt-5 title">Detalhes do Serviço</div>
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="form-floating mb-3">
                <input type="text" class="form-control" id="float-Nome" placeholder="Seu nome aqui..."
                       required>
                <label for="float-Nome">Nome</label>
                <div class="invalid-feedback">

                </div>
            </div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">

</script>

<?php require "../../../../" . Constants::SITE_FOOTER ?>
</html>