document.addEventListener('DOMContentLoaded', () => {
    // Seleciona os elementos principais uma única vez
    const itensServico = document.querySelectorAll('.item-servico');
    const imagemDisplay = document.getElementById('imagem-display');
    const tituloDestaque = document.getElementById('titulo-destaque');

    // Verifica se todos os elementos necessários foram encontrados
    if (itensServico.length === 0 || !imagemDisplay || !tituloDestaque) {
        console.error("Erro: Um ou mais elementos essenciais (.item-servico, #imagem-display, #titulo-destaque) não foram encontrados.");
        return;
    }

    // Adiciona um evento de clique para cada item da lista de serviços
    itensServico.forEach(item => {
        item.addEventListener('click', () => {
            // 1. Remove a classe 'ativo' de todos os outros itens
            itensServico.forEach(i => i.classList.remove('ativo'));

            // 2. Adiciona a classe 'ativo' apenas no item que foi clicado
            item.classList.add('ativo');

            // 3. Pega o novo título e o link da nova imagem a partir dos atributos 'data-*'
            const novoTitulo = item.getAttribute('data-titulo');
            const novaImagemSrc = item.getAttribute('data-imagem-src');

            // 4. Atualiza a imagem e o título na coluna da esquerda
            imagemDisplay.src = novaImagemSrc;
            tituloDestaque.innerHTML = `${novoTitulo} <span class="arrow">→</span>`;
        });
    });
});

const cards = document.querySelectorAll('.card');

cards.forEach((card) => {
  card.addEventListener('click', () => {
    cards.forEach((c) => c.classList.remove('active'));
    card.classList.add('active');
  });
});

