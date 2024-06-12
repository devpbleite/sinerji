package DesafiosOO.DesafioComposicao;

import java.util.ArrayList;
import java.util.List;

//Classe que representa um cliente. 
public class Cliente {

  String nome;
  List<Compra> compras = new ArrayList<>();

  // Construtor da classe Cliente.
  public Cliente(String nome) {
    this.nome = nome;
  }

  // Adiciona uma compra à lista de compras do cliente.
  void adicionarCompra(Compra compra) {
    compras.add(compra);
  }

  // Calcula o valor total das compras do cliente.
  double obterValorTotal() {
    double total = 0;
    for (Compra compra : compras) {
      total += compra.obterValorTotal();
    }
    return total;

  }

}
