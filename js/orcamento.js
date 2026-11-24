// ============================================================
// ORÇAMENTO - envia o formulário do modal para o PHP
// Usado nas páginas servico-violao, servico-piano e servico-bateria
// ============================================================

const formOrcamento = document.getElementById("formOrcamento");

formOrcamento.addEventListener("submit", async function (evento) {
  evento.preventDefault();  // impede o navegador de recarregar a página

  const botao = document.getElementById("btnEnviarOrcamento");
  botao.disabled = true;
  botao.textContent = "Enviando...";

  try {
    const resultado = await enviarFormulario(formOrcamento, "php/salvar_orcamento.php");
    mostrarAlerta("alertaOrcamento", resultado.mensagem, resultado.sucesso);

    if (resultado.sucesso) {
      formOrcamento.reset();  // limpa os campos
      // fecha o modal depois de 2 segundos
      setTimeout(function () {
        bootstrap.Modal.getOrCreateInstance(document.getElementById("modalOrcamento")).hide();
        document.getElementById("alertaOrcamento").className = "d-none";
      }, 2000);
    }
  } catch (erro) {
    mostrarAlerta("alertaOrcamento", "Não foi possível conectar ao servidor.", false);
  }

  botao.disabled = false;
  botao.textContent = "Enviar Solicitação";
});
