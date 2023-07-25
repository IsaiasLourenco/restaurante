//CADASTRAR NOVO CLLIENTE NO BD
const frmCadCli = document.getElementById("form-cliente");
if (frmCadCli) {
    frmCadCli.addEventListener("submit", async (event) => {
        event.preventDefault(); 
        
        //RECEBER OS DADOS DO FORMULÁRIO
        const dadosForm = new FormData(frmCadCli);
        
        //ENVIAR OS DADOS PARA O ARQUIVO QUE VAI GRAVAR - cadastrar.php
        const dados = await fetch("inseir.php", {
            method: "POST",
            body: dadosForm
        });
        const resposta = await dados.json();
        alert(resposta);
    });
}