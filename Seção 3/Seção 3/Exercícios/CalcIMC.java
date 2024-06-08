package Exercícios;

import java.util.Scanner;

public class CalcIMC {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.print("Digite o peso em kg: ");
    String peso = s.next().replace(",", ".");

    System.out.print("Digite a altura em metros: ");
    String altura = s.next().replace(",", ".");

    double pesoF = Double.parseDouble(peso);
    double alturaF = Double.parseDouble(altura);

    double imc = pesoF / (alturaF * alturaF);

    System.out.printf("O valor do IMC é: %.2f %n", imc);

    s.close();
  }

}
