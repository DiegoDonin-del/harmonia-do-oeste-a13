// ============================================================
// Funções de apoio usadas pelos outros arquivos JavaScript
// ============================================================

// Mostra uma mensagem (verde = sucesso, vermelha = erro) dentro de uma div
function mostrarAlerta(idDiv, mensagem, sucesso) {
  const div = document.getElementById(idDiv);
  div.className = sucesso ? "alert alert-success mt-3" : "alert alert-danger mt-3";
  div.textContent = mensagem;
}

// Envia um formulário para um arquivo PHP usando fetch (POST)
// e devolve a resposta já convertida de JSON para objeto.
async function enviarFormulario(form, urlPhp) {
  const dados = new FormData(form);   // pega todos os campos que têm "name"
  const resposta = await fetch(urlPhp, { method: "POST", body: dados });
  return await resposta.json();
}

// Evita que o texto digitado pelo usuário seja interpretado como HTML
function escaparHtml(texto) {
  const div = document.createElement("div");
  div.textContent = texto ?? "";
  return div.innerHTML;
}
