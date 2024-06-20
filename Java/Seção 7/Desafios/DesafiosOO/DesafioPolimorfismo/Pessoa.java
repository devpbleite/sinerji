package DesafiosOO.DesafioPolimorfismo;

public class Pessoa {

  private double peso;

  public Pessoa(double peso) {
    setPeso(peso);
  }

  public void comer(Comida comida) {
    if (comida != null) {
      this.peso += comida.getPeso();
    } else {
      System.out.println("Digite um valor válido.");
    }
  }

  public double getPeso() {
    return peso;
  }

  public void setPeso(double peso) {
    if (peso >= 0) {
      this.peso = peso;
    }
  }

}
