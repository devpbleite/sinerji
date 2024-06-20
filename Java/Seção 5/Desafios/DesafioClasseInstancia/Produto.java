package DesafioClasseInstancia;

public class Produto {

  String nome;
  double preco;
  static double desconto = 0.25;

  Produto() {

  }

  Produto(String nomeInicial, double precoInicial) {
    nome = nomeInicial;
    preco = precoInicial;

  }

  double precoDesconto() {
    return preco * (1 - desconto);
  }

  double precoDesconto(double descontoGerente) {
    return preco * (1 - desconto + descontoGerente);
  }

}
