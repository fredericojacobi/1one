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
    <div class="h2 text-center mt-5 title mb-4">Titulo</div>
    <div class="row justify-content-center">
        <div class="one-card-group d-flex">
            <div class="row one-mr-ml-auto"></div>
        </div>
    </div>
</div>
</body>
<script type="text/javascript">
    $('document').ready(function () {
        carregarClientes()
    });
</script>

<?php require "../../../../" . Constants::SITE_FOOTER ?>
</html>