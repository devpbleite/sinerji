public class Produto {
  private String nome;
  private double preco;
  private double desconto;
  private double frete;

  public Produto(String nome, double preco, double desconto, double frete) {
    this.nome = nome;
    this.preco = preco;
    this.desconto = desconto;
    this.frete = frete;
  }

  public String getNome() {
    return nome;
  }

  public double getPreco() {
    return preco;
  }

  public double getDesconto() {
    return desconto;
  }

  public boolean isFreteGratis() {
    return frete == 0;
  }
}
