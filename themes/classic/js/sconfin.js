function validaData(textoData) {
    var valorData = textoData
    if (valorData == '') {
        return false
    }

    var regexPadraoData = /^(\d{1,2})(\/|-)(\d{1,2})(\/|-)(\d{4})$/ // 00/00/0000
    var dtArray = valorData.match(regexPadraoData) // Verifica se o formato está ok

    if (dtArray == null) {
        return false
    }

    // Checa no formato DD/MM/YYYY
    dtDia = dtArray[1]
    dtMes = dtArray[3]
    dtAno = dtArray[5]

    if (dtMes < 1 || dtMes > 12) {
        return false
    } else if (dtDia < 1 || dtDia > 31) {
        return false
    } else if ((dtMes == 4 || dtMes == 6 || dtMes == 9 || dtMes == 11) && dtDia == 31) {
        return false
    } else if (dtMes == 2) {
        var bissexto = (dtAno % 4 == 0 && (dtAno % 100 != 0 || dtAno % 400 == 0))
        if (dtDia > 29 || (dtDia == 29 && !bissexto)) {
            return false
        }
    }
    return true;
}


// Verifica se o intervalo da data é valida, uma data inicial não é maior que outra
function validaIntervaloData(data_inicio, data_fim) {
    var dt_ini = data_inicio.split('/')
    var dt_fim = data_fim.split('/')
    var chk_ini = new Date(dt_ini[2], dt_ini[1] - 1, dt_ini[0])
    var chk_fim = new Date(dt_fim[2], dt_fim[1] - 1, dt_fim[0])

    if (chk_ini > chk_fim)
        return false
    return true
}
