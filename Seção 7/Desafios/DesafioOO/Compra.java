package DesafioOO;

import java.util.ArrayList;
import java.util.List;

public class Compra {

  final List<Item> itens = new ArrayList<>();

  void addItem(Produto produto, int quantidade) {
    this.itens.add(new Item(produto, quantidade));
  }

  void addItem(String nome, double preco, int quantidade) {
    var produto = new Produto(nome, preco);
    this.itens.add(new Item(produto, quantidade));
  }

  double obterValorTotal() {
    double total = 0;

    for (Item item : itens) {
      total += item.produto.preco * item.quantidade;
    }

    return total;
  }

}
