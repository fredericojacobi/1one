<?php
require "../../../../generics/Constants.php";
require "../../../../" . Constants::API_CONFIG . "Configuration.php";
require "../../../../" . Constants::SITE_HEADER;
?>
<script src="../../js/pesquisar/cliente.js"></script>
</head>

<body>
<?php require "../../../../" . Constants::SITE_MENU ?>
<div class="container-fluid">
    <div class="h2 text-center mt-5 title">Encontre as ofertas ideais para você!</div>
    <div class="row justify-content-center">
        <span class="text-center">text center</span>
        <div class="one-card-group">
        </div>
    </div>
</body>
<script type="text/javascript">
    function getRandomArbitrary(min, max) {
        return Math.random() * (max - min) + min;
    }
    $('document').ready(function () {
        carregarClientes()
    });
</script>

<?php require "../../../../" . Constants::SITE_FOOTER ?>
</html>