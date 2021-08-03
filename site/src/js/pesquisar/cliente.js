function carregarClientes() {
    $.ajax({
        method: "GET",
        url: "viewCliente.php",
        success: function (data) {
            var dados = JSON.parse(data);
            console.log(dados)
            console.log("Sucesso - cliente.js");
            montarCardCliente(dados);
        },
        error: function (data) {
            // dados = JSON.parse(data.responseText);
            console.log("Erro - cliente.js")
        }
    });
}

function formatarData(data, dataPreFormatada = false, esconderAno = true) {
    const MESES = [
        'Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho',
        'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'
    ];
    const dia = data.getDate();
    const mes = MESES[data.getMonth()];
    const ano = data.getFullYear();
    const hora = data.getHours();
    let minuto = data.getMinutes();

    if (minuto < 10) {
        minuto = `0${minuto}`;
    }

    if (dataPreFormatada) {
        return `${dataPreFormatada} às ${hora}:${minuto}`;
    }

    if (esconderAno) {
        return `${dia} de ${mes} às ${hora}:${minuto}`;
    }
    return `${dia} de ${mes} de ${ano} às ${hora}:${minuto}`;
}

function tempoAtras(dateParam) {
    if (!dateParam) {
        return null;
    }

    const data = typeof dateParam === 'object' ? dateParam : new Date(dateParam);
    const DIA_EM_MS = 86400000; // 24 * 60 * 60 * 1000
    const date = new Date();
    const ontem = new Date(date - DIA_EM_MS);
    const segundos = Math.round((date - data) / 1000);
    const minutos = Math.round(segundos / 60);
    const hoje = date.toDateString() === data.toDateString();
    const foiOntem = ontem.toDateString() === data.toDateString();
    const anoAtual = date.getFullYear() === data.getFullYear();

    if (segundos < 5) {
        return 'agora';
    } else if (segundos < 60) {
        return `há ${segundos} segundos atrás`;
    } else if (segundos < 90) {
        return 'há aproximadamente um minuto atrás';
    } else if (minutos < 60) {
        return `há ${minutos} minutos atrás`;
    } else if (hoje) {
        return formatarData(data, 'hoje');
    } else if (foiOntem) {
        return formatarData(data, 'ontem');
    } else if (anoAtual) {
        return formatarData(data, false, true);
    }
    return formatarData(data);
}

function montarCardCliente(dados) {
    $(dados).each(function (index, servico) {
        var texto = servico.DescricaoCurta;
        var dataCadastro = tempoAtras(new Date(servico.DataCadastro));
        var titulo = servico.Titulo;
        var valorDesejado = servico.ValorDesejado;
        var idServico = servico.Id;
        console.log(servico.ValorDesejado)
        var card =
            " <div class='card m-2 p-1' style='width: 20rem;'>" +
            "<a href='/cadastro' style='text-decoration: none; color: inherit'><input type='text' value='" + idServico + "' hidden> "
            + "<div class='card-body p-1'>"
            + "<h5 class='card-title'>" + titulo + "</h5>"
            + "<div class='card-body'>"
            + "<p class='card-text'>"
            + texto
            + "</p>"
            + "</div>"
            + "<div class='d-flex justify-content-end'>"
            + selecionarIconeAvaliacao(10)
            + "</div>"
            + "<div class='d-flex'>"
            + "<small class='text-muted flex-fill mr-5'>Adicionado " + dataCadastro + "</small>"
            + "<div class=''>"
            + selecionarIconePreco(valorDesejado)
            + "</div>"
            + "</div>"
            + "</div>"
            + "</div></a>"
            + "</div>";
        $('.one-card-group .row').append(card);
    });
}

function selecionarIconePreco(valor) {
    var icone = "<i class='bi bi-currency-dollar' style='width: 10px; color: green;'></i>";
    var semIcone = "<i class='bi bi-currency-dollar' style='width: 10px; color: lightgray;'></i>";
    if (valor < 100) {
        return semIcone + semIcone + semIcone + semIcone + icone;
    }
    if (valor >= 100 && valor < 300) {
        return semIcone + semIcone + semIcone + icone + icone;
    }
    if (valor >= 300 && valor < 450) {
        return semIcone + semIcone + icone + icone + icone;
    }
    if (valor >= 450 && valor < 650) {
        return semIcone + icone + icone + icone + icone;
    }
    if (valor >= 650) {
        return icone + icone + icone + icone + icone;
    }
}

function selecionarIconeAvaliacao(nota) {
    var icone = "<i class='bi bi-star-fill' style='color: #FFC107'></i>";
    var iconeVazio = "<i class='bi bi-star' style='color: lightgray'></i>";
    var meioIcone = "<i class='bi bi-star-half' style='color: #FFC107'></i>";
    var megaIcone = "<i class='bi bi-award-fill' style='color: #FFC107'></i>";

    if (nota <= 1) {
        return iconeVazio + iconeVazio + iconeVazio + iconeVazio + meioIcone;
    }
    if (nota > 1 && nota <= 2) {
        return iconeVazio + iconeVazio + iconeVazio + iconeVazio + icone;
    }
    if (nota > 2 && nota <= 3) {
        return iconeVazio + iconeVazio + iconeVazio + meioIcone + icone;
    }
    if (nota > 3 && nota <= 4) {
        return iconeVazio + iconeVazio + iconeVazio + icone + icone;
    }
    if (nota > 4 && nota <= 5) {
        return iconeVazio + iconeVazio + meioIcone + icone + icone;
    }
    if (nota > 5 && nota <= 6) {
        return iconeVazio + iconeVazio + icone + icone + icone;
    }
    if (nota > 6 && nota <= 7) {
        return iconeVazio + meioIcone + icone + icone + icone;
    }
    if (nota > 7 && nota <= 8) {
        return iconeVazio + icone + icone + icone + icone;
    }
    if (nota > 8 && nota <= 9) {
        return meioIcone + icone + icone + icone + icone;
    }
    if (nota > 8 && nota <= 9) {
        return icone + icone + icone + icone + icone;
    }
    if (nota > 9 && nota <= 10) {
        return megaIcone + megaIcone + megaIcone + megaIcone + megaIcone;
    }
}