'use strict';

const limparCampos = () => {
    document.getElementById('cep').value = "";
    document.getElementById('rua').value = "";
    document.getElementById('numero').value = "";
    document.getElementById('bairro').value = "";
    document.getElementById('cidade').value = "";
    document.getElementById('estado').value = "";


    setTimeout(() => {
        document.getElementById('cep').focus();
    }, 100); // Atraso de 100ms

};

const preencherForm = (endereco) => {
    document.getElementById('cep').value = endereco.cep;
    document.getElementById('rua').value = endereco.logradouro;
    document.getElementById('bairro').value = endereco.bairro;
    document.getElementById('cidade').value = endereco.localidade;
    document.getElementById('estado').value = endereco.uf;
};

const cepValido = (cep) => cep.length == 9;

const pesquisarCEP = async () => {
    const cep = document.getElementById('cep').value;
    const url = `https://viacep.com.br/ws/${cep}/json`;
    if (cepValido(cep)) {
        try {
            const dados = await fetch(url);
            const endereco = await dados.json();
            if (endereco.hasOwnProperty('erro')) {
                window.alert('CEP Inexistente!');
                limparCampos();
            } else {
                preencherForm(endereco);
            }
        } catch (error) {
            window.alert('Erro ao buscar o CEP.');
            limparCampos();
        }
    } else {
        window.alert('CEP Incorreto!');
        limparCampos();
        document.getElementById('cep').focus();
    }
};

document.getElementById('cep').addEventListener('focusout', pesquisarCEP);