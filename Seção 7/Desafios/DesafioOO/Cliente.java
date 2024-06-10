package DesafioOO;

import java.util.ArrayList;
import java.util.List;

public class Cliente {

  List<Compra> compras = new ArrayList<>();

  public Cliente(String nome) {

  }

  void adicionarCompra(Compra compra) {
    compras.add(compra);
  }

  double obterValorTotal() {
    double total = 0;

    for (Compra compra : compras) {
      total += compra.obterValorTotal();
    }

    return total;
  }

}
