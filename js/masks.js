// this script creates input masks when called by a page

if ($('.cpf')) {
    $('.cpf').mask('000.000.000-00')
}

if ($('.fone')) {
    $('.fone').mask('(00) 0000-0000')
}

if ($('.celular')) {
    $('.celular').mask('(00) 00000-0000')
}