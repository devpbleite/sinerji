public class Produto1 {

  private String nome;
  private double preco;
  private double desconto;

  public Produto1(String nome, double preco, double desconto) {
    this.nome = nome;
    this.preco = preco;
    this.desconto = desconto;
  }

  public String getNome() {
    return nome;
  }

  public void setNome(String nome) {
    this.nome = nome;
  }

  public double getPreco() {
    return preco;
  }

  public void setPreco(double preco) {
    this.preco = preco;
  }

  public double getDesconto() {
    return desconto;
  }

  public void setDesconto(double desconto) {
    this.desconto = desconto;
  }

  public String toString() {
    return "Produto1{" + "nome='" + nome + '\'' + ", preco=" + preco +
        '}';
  }

}
