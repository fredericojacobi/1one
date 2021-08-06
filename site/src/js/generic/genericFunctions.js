function pegaQueryString() {
    return Object.fromEntries(new URLSearchParams(window.location.search).entries());
}

function checarTamanhoSenha(senha) {
    if (senha.length < 6 || senha.length > 20) {
        return false;
    } else {
        return true;
    }
}

function contagemCaracter(seletor) {
    return (document.getElementById(seletor).value.length);
}