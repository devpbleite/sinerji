package DesafiosOO.DesafioHeranca;

public class Carro {

  String nome;
  final int VELOCIDADE_MAXIMA;
  protected int velocidadeAtual;
  protected int velocidade = 5;

  protected Carro(int velocidadeMaxima) {
    VELOCIDADE_MAXIMA = velocidadeMaxima;
  }

  public void acelerar() {
    if (velocidadeAtual + velocidade > VELOCIDADE_MAXIMA) {
      velocidadeAtual = VELOCIDADE_MAXIMA;
    } else {
      velocidadeAtual += velocidade;
    }
  }

  public void frear() {
    if (velocidadeAtual >= 5) {
      velocidadeAtual -= 5;
    } else {
      velocidadeAtual = 0;
    }
  }

  public void setNome(String nome) {
    this.nome = nome;
  }

  public String toString() {
    return "A velocidade atual do " + nome + " é de " + velocidadeAtual + " km/h.";
  }

}
