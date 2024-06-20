package DesafiosOO.DesafioPolimorfismo;

import java.util.Scanner;

public class Jantar {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.print("Digite seu nome: ");
    String nome = s.nextLine();

    System.out.println("Olá, " + nome + "!, seja bem-vindo(a) ao jantar.");

    System.out.print("Digite seu peso: ");
    double peso = s.nextDouble();

    Pessoa pessoa = new Pessoa(peso);

    Arroz arroz = new Arroz(0.25);
    Feijao feijao = new Feijao(0.20);
    Sorvete sorvete = new Sorvete(0.30);

    System.out.println("Seu peso atual é: " + pessoa.getPeso());

    pessoa.comer(arroz);
    pessoa.comer(feijao);
    pessoa.comer(sorvete);

    System.out.println("Após seu jantar, seu peso atual é: " + pessoa.getPeso());

  }

}
