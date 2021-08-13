<?php
require "../../../../generics/Constants.php";
require "../../../.." . Constants::SITE_HEADER;
?>
<script src="../../js/home/login.js"></script>
</head>
<body>
<?php
require "../../../../" . Constants::SITE_MENU;
?>
<form id="form-cadastro" class="needs-validation" method="POST" novalidate>
    <div class="h2 text-center mt-5 title">Login</div>
    <div class="row justify-content-center">
        <div class="col-4 card bg-light p-3 mt-3">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="email" class="form-control" id="float-Email" placeholder="Seu email aqui..."
                               required>
                        <label for="float-Email">Email</label>
                        <div class="invalid-feedback">
                            Favor inserir seu email.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="form-floating mb-3">
                        <input type="password" class="form-control" id="float-Senha" placeholder="Sua senha aqui..."
                               required>
                        <label for="float-Senha">Senha</label>
                        <div class="invalid-feedback">
                            Favor inserir sua senha.
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                    <button type="submit" class="btn btn-success one-btn-size">Login</button>
                </div>
            </div>
        </div>
    </div>
</form>
</body>
<script type="text/javascript">
    $('document').ready(function () {
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
                            login();
                        form.classList.add('was-validated');
                    }, false)
                })
        })()
    });
</script>
<?php
require "../../../.." . Constants::SITE_FOOTER;
?>
</html>
