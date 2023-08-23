'use strict';

const limparCampos = (endereco) => {
    document.getElementById('nome').value = "";
    document.getElementById('telefone').value = "";
    document.getElementById('cep').value = "";
    document.getElementById('rua').value = "";
    document.getElementById('numero').value = "";
    document.getElementById('bairro').value = "";
    document.getElementById('cidade').value = "";
    document.getElementById('estado').value = "";
    document.getElementById('email').value = "";
    document.getElementById('senha').value = "";
}

const preencherForm = (endereco) => {
    document.getElementById('cep').value = endereco.cep;
    document.getElementById('rua').value = endereco.logradouro;
    document.getElementById('bairro').value = endereco.bairro;
    document.getElementById('cidade').value = endereco.localidade;
    document.getElementById('estado').value = endereco.uf;
}

const cepValido = (cep) => cep.length == 9;

const pesquisarCEP = async () => {
    const cep = document.getElementById('cep').value;
    const url = `https://viacep.com.br/ws/${cep}/json`;
    if (cepValido(cep)) {
        const dados = await fetch(url);
        const endereco = await dados.json();
        if (endereco.hasOwnProperty('erro')) {
            window.alert('CEP Inexistente!');
            limparCampos(endereco);
            cep.focus();

        } else {
            preencherForm(endereco);
            numero.focus();
        }
    } else {
        window.alert('CEP Incorreto!');
        limparCampos(endereco);
        cep.focus();
    }
}

document.getElementById('cep').addEventListener('focusout', pesquisarCEP);