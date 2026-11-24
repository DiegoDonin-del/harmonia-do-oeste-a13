// ============================================================
// CONTATO - envia o formulário da página contato.html para o PHP
// ============================================================

const formContato = document.getElementById("formContato");

formContato.addEventListener("submit", async function (evento) {
  evento.preventDefault();

  try {
    const resultado = await enviarFormulario(formContato, "php/salvar_contato.php");
    mostrarAlerta("alertaContato", resultado.mensagem, resultado.sucesso);

    if (resultado.sucesso) {
      formContato.reset();
    }
  } catch (erro) {
    mostrarAlerta("alertaContato", "Não foi possível conectar ao servidor.", false);
  }
});
