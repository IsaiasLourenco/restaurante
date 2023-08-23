$(document).ready(function ($) {
    $('#telefone').mask('(00) 00000-0000');
    $('#cpf').mask('000.000.000-00');
    $('#cep').mask('00000-000');
    $('#cnpj').mask('00.000.000/0000-00');
});

// function formatarCep(input) {
//     let codigopostal = input.value.replace(/\D/g, '');

//     if (codigopostal.length === 8) {

//         codigopostal = codigopostal.replace(/(\d{5})(\d{3})/, "$1-$2");
//         input.value = codigopostal;
//     }

// };

// function formatarTelefone(input) {
//     let fone = input.value.replace(/\-/g, '');
//     const parte1 = fone.slice(0, 5);
//     const parte2 = fone.slice(5, 9);
//     foneFormatado = `${parte1}-${parte2}`

//     if (fone.length === 9) {

//         input.value = foneFormatado;
//     }

// };