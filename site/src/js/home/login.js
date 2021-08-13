function login(){
    $.ajax({
        method: "POST",
        url: "viewHome.php",
        data: {
            'Email': $('#float-Email').val(),
            'Senha': $('#float-Senha').val()
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
            }
        },
        error: function (data) {
            var dados = JSON.parse(data);
            console.log(dados);
            stop();
        }
    });
}