package DesafiosOO.DesafioComposicao;

import java.util.ArrayList;
import java.util.List;

//Classe que representa uma compra.
public class Compra {
  final List<Item> itens = new ArrayList<>();

  // Adiciona um item à compra.
  void adicionarItem(Produto produto, int quantidade) {
    this.itens.add(new Item(produto, quantidade));
  }

  // Adiciona um item à compra.
  void adicionarItem(String nome, double preco, int quantidade) {
    var produto = new Produto(nome, preco);
    this.itens.add(new Item(produto, quantidade));
  }

  // Calcula o valor total da compra.
  double obterValorTotal() {
    double total = 0;
    for (Item item : itens) {
      total += item.produto.preco * item.quantidade;
    }
    return total;

  }

}
