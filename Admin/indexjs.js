

function plotesuar(x) {
    if(document.getElementsByName(x)[0].value == ''){
        return false;
    }
    else return true;
}

function korniza(x, y) {
    if(x) {
        document.getElementsByName(y)[0].style.border = '1px solid #ccc';
    }
    else {
        document.getElementsByName(y)[0].style.border = '1px solid #cc0000';
    }
}







