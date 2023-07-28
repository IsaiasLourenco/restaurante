//CADASTRAR NOVO CLLIENTE NO BD
const frmCadCli = document.getElementById("form-cliente");
if (frmCadCli) {
    frmCadCli.addEventListener("submit", async (event) => {
        event.preventDefault(); 
        
        //RECEBER OS DADOS DO FORMULÁRIO
        const dadosForm = new FormData(frmCadCli);
        
        //ENVIAR OS DADOS PARA O ARQUIVO QUE VAI GRAVAR - cadastrar.php
        const dados = await fetch("../inserir.php", {
            method: "POST",
            body: dadosForm
        });
        const resposta = await dados.json();
        console.log(resposta);
        
        if (resposta['status']) {
            document.getElementById("msgAlerta").innerHTML = resposta['msg']
        } else {
            document.getElementById("msgAlerta").innerHTML = resposta['msg']
        }
    });
}