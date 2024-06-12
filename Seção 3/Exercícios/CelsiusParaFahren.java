package Exercícios;

import java.util.Scanner;

public class CelsiusParaFahren {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.print("Digite a temperatura em Celsius: ");
    double celsius = s.nextDouble();

    final double ajuste = 32;
    final double fator = 9.0 / 5.0;

    double fahrenheit = (celsius * fator) + ajuste;

    System.out.printf("O valor em Fahrenheit é: %.2f°F %n", fahrenheit);
  }

}
