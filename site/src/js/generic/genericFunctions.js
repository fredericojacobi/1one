function GetQueryStringParams(){
    return Object.fromEntries(new URLSearchParams(window.location.search).entries());
}