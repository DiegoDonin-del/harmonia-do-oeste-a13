// ============================================================
// DEPOIMENTOS
// 1) carregarDepoimentos(): busca no banco (listagem) e monta os cards
// 2) formDepoimento: envia um novo depoimento (inserção)
// ============================================================

async function carregarDepoimentos() {
  const lista = document.getElementById("listaDepoimentos");

  try {
    const resposta = await fetch("php/listar_depoimentos.php");
    const depoimentos = await resposta.json();

    if (depoimentos.length === 0) {
      lista.innerHTML = '<p class="text-center text-muted">Nenhum depoimento ainda. Seja o primeiro!</p>';
      return;
    }

    let html = "";
    // percorre cada depoimento que veio do banco e monta um card
    depoimentos.forEach(function (dep) {
      // se não tiver foto, mostra um ícone de pessoa
      const foto = dep.foto
        ? `<img src="${escaparHtml(dep.foto)}" alt="${escaparHtml(dep.nome)}" class="me-3">`
        : `<i class="bi bi-person-circle fs-1 text-warning me-3"></i>`;

      const curso = dep.curso ? ` · ${escaparHtml(dep.curso)}` : "";

      html += `
        <div class="col-md-6 col-lg-4">
          <div class="card card-depoimento h-100 shadow-sm p-3">
            <div class="d-flex align-items-center mb-3">
              ${foto}
              <div>
                <h6 class="mb-0">${escaparHtml(dep.nome)}</h6>
                <small class="text-muted">${dep.data}${curso}</small>
              </div>
            </div>
            <p class="card-text fst-italic">"${escaparHtml(dep.texto)}"</p>
          </div>
        </div>`;
    });

    lista.innerHTML = html;
  } catch (erro) {
    lista.innerHTML = '<p class="text-center text-danger">Erro ao carregar os depoimentos.</p>';
  }
}

// Envio de um novo depoimento
const formDepoimento = document.getElementById("formDepoimento");

formDepoimento.addEventListener("submit", async function (evento) {
  evento.preventDefault();

  try {
    const resultado = await enviarFormulario(formDepoimento, "php/salvar_depoimento.php");
    mostrarAlerta("alertaDepoimento", resultado.mensagem, resultado.sucesso);

    if (resultado.sucesso) {
      formDepoimento.reset();
      carregarDepoimentos();  // recarrega a lista já com o novo depoimento
    }
  } catch (erro) {
    mostrarAlerta("alertaDepoimento", "Não foi possível conectar ao servidor.", false);
  }
});

// Carrega os depoimentos assim que a página abre
carregarDepoimentos();
