package DesafioModulo;

public class Jantar {

  public static void main(String[] args) {

    Pessoa p1 = new Pessoa("Pablo", 73.5);

    Comida c1 = new Comida("Lasanha", 0.400);
    Comida c2 = new Comida("Strogonoff", 0.300);

    System.out.println(p1.nome + " pesa " + p1.peso + "kg.");
    p1.comer(c1);
    System.out.println(p1.nome + " pesa " + p1.peso + "kg.");
    p1.comer(c2);
    System.out.println(p1.nome + " pesa " + p1.peso + "kg.");

  }

}
