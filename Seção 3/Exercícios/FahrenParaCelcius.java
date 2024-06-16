package Exercícios;

import java.util.Scanner;

public class FahrenParaCelcius {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.print("Digite a temperatura em Fahrenheit: ");
    double fahrenheit = s.nextDouble();

    final double ajuste = 32;
    final double fator = 5.0 / 9.0;

    double celsius = (fahrenheit - ajuste) * fator;

    System.out.printf("O valor em celsius é: %.2f°C %n", celsius);
  }

}
