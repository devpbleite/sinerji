package Exercícios;

import java.util.Scanner;

public class QuadradoECubo {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.print("Digite um número: ");
    double numero = s.nextDouble();

    double quadrado = Math.pow(numero, 2);
    double cubo = Math.pow(numero, 3);

    System.out.printf("O quadrado do número é: %.2f %n", quadrado);
    System.out.printf("O cubo do número é: %.2f %n", cubo);

    s.close();
  }
}
