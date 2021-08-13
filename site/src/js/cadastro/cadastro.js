function checarEdicaoCadastro(id) {
    if (id) {
        $('.title').append("Atualização de Dados Cadastrais");
        $('.buttonSubmit').append('<button class="btn btn-success one-btn-size" type="submit">Atualizar</button>');
        $.ajax({
            method: "GET",
            url: "viewCadastro.php",
            data: {
                'id': id
            },
            success: function (data) {
                var dados = JSON.parse(data);
                $('#float-Nome').val(dados.Nome);
                $('#float-Sobrenome').val(dados.Sobrenome);
                $('#float-DataNascimento').val(dados.DataNascimento);
                $('#float-Telefone').val(dados.Telefone);
                $('#float-Endereco').val(dados.Endereco);
                $('#float-Cpf').val(dados.Cpf);
                $('#float-AntecedentesCriminais').val(dados.AntecedentesCriminais);
                $('#float-DocumentoCPF').val(dados.DocumentoCPF);
                $('#float-TipoUsuario').val(dados.TipoUsuario);
                $('#float-Email').val(dados.Email);
                $('#confirmarSenha').append('<div class="form-floating mb-3">' +
                    '                            <input type="password" class="form-control" id="float-SenhaAtual"' +
                    '                                   placeholder="Sua senha aqui..." required>' +
                    '                            <label for="float-SenhaAtual">Senha atual</label>' +
                    '                            <div class="invalid-feedback">' +
                    '                                Favor inserir a sua senha atual.' +
                    '                            </div>' +
                    '                        </div>');
            },
            error: function (data) {
                var dados = JSON.parse(data.responseText);
                console.log(dados);
                stop();
            }
        });
    } else {
        $('.title').append("Cadastro");
        $('.buttonSubmit').append('<button class="btn btn-success one-btn-size" type="submit">Cadastrar</button>');
    }
}

function cadastrarUsuario(id) {
    $.ajax({
        method: "POST",
        url: "viewCadastro.php",
        data: {
            'Id': id,
            'Nome': $('#float-Nome').val(),
            'Sobrenome': $('#float-Sobrenome').val(),
            'DataNascimento': $('#float-DataNascimento').val(),
            'Telefone': $('#float-Telefone').val(),
            'Endereco': $('#float-Endereco').val(),
            'Cpf': $('#float-Cpf').val(),
            'AntecedentesCriminais': $('#float-AntecedentesCriminais').val(),
            'DocumentoCPF': $('#float-DocumentoCPF').val(),
            'TipoUsuario': $('#float-TipoUsuario').val(),
            'Email': $('#float-Email').val(),
            'SenhaAtual': $('#float-SenhaAtual').val(),
            'Senha': $('#float-Senha').val(),
            'ConfirmarSenha': $('#float-ConfirmarSenha').val()
        },
        success: function (data) {
            stop();
                console.log(data);
            var dados = JSON.parse(data);
            if (dados.status) {
                alert("Dados atualizados com sucesso!");
            } else{
                console.log(data);
                stop();
                $('#float-SenhaAtual').val(null);
            }
        },
        error: function (data) {
            stop();
            console.log(data);
            var dados = JSON.parse(data);
            $('#float-SenhaAtual').val(null);
        }
    });
}