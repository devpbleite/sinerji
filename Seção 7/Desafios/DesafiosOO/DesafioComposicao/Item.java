package DesafiosOO.DesafioComposicao;

//Classe que representa um item de uma compra.
public class Item {
  final Produto produto;
  final int quantidade;

  // Construtor da classe Item.
  Item(Produto produto, int quantidade) {
    this.produto = produto;
    this.quantidade = quantidade;

  }

}
