function carregarClientes(){
    $.ajax({
        method: "GET",
        url: "viewCliente.php",
        success: function (data) {
            var dados = JSON.parse(data);
            console.log("Sucesso - cliente.js");
            montarCardCliente(dados);
        },
        error: function (data) {
            // dados = JSON.parse(data.responseText);
            console.log("Erro - cliente.js")
        }
    });
}

function formatarData(data, dataPreFormatada = false, esconderAno = false) {
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
        minuto = `0${ minuto }`;
    }

    if (dataPreFormatada) {
        return `${ dataPreFormatada } às ${ hora }:${ minuto }`;
    }

    if (esconderAno) {
        return `${ dia } de ${ mes } às ${ hora }:${ minuto }`;
    }
    return `${ dia } de ${ mes } de ${ ano }. às ${ hora }:${ minuto }`;
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
        return `há ${ segundos } segundos atrás`;
    } else if (segundos < 90) {
        return 'há aproximadamente um minuto atrás';
    } else if (minutos < 60) {
        return `há ${ minutos } minutos atrás`;
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
    console.log(dados)
    $(dados).each(function (cliente, index){
        console.log(dados)
        // console.log("Index: " + index + "\n Cliente: \n" + cliente)
    })
    /*
    var cardText = "text";
    var time = "time";
    var title = "titulo";
    var card =
        "  <div class='card' style='width: 18rem;'> "
        +   "<div class='card-body'>"
        +       "<h5 class='card-title'>" + title + "</h5>"
        +       "<p class='card-text'>"
        +           cardText
        +       "</p>"
        +       "<p class='card-text'><small class='text-muted'>Adicionado " + time + "</small></p>"
        +       "<a href='#' class='btn btn-primary '>Ver mais</a>"
        +   "</div>"
        + "</div>";
    $('.one-card-group').append(card);
     */
}