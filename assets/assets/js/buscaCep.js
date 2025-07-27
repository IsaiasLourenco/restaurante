'use strict';

const exibirMensagemErro = (mensagem) => {
    // Cria um elemento div para mostrar o erro
    const mensagemErro = document.createElement('div');
    mensagemErro.textContent = mensagem;
    mensagemErro.style.color = 'red';
    mensagemErro.style.marginTop = '5px';
    mensagemErro.id = 'mensagem-erro';

    // Adiciona a mensagem logo após o campo de CEP
    const campoCep = document.getElementById('cep');
    campoCep.parentNode.insertBefore(mensagemErro, campoCep.nextSibling);

    // Remove a mensagem após 3 segundos
    setTimeout(() => {
        if (document.getElementById('mensagem-erro')) {
            document.getElementById('mensagem-erro').remove();
        }
    }, 3000); // 3 segundos
};

const limparCampos = () => {
    document.getElementById('cep').value = "";
    document.getElementById('rua').value = "";
    document.getElementById('numero').value = "";
    document.getElementById('bairro').value = "";
    document.getElementById('cidade').value = "";
    document.getElementById('estado').value = "";

    document.getElementById('cep').focus();
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
                exibirMensagemErro('CEP Inexistente!');
                limparCampos();
            } else {
                preencherForm(endereco);
            }
        } catch (error) {
            exibirMensagemErro('Erro ao buscar o CEP.');
            limparCampos();
        }
    } else {
        exibirMensagemErro('CEP Incorreto!');
        limparCampos();
    }
};

document.getElementById('cep').addEventListener('focusout', pesquisarCEP);