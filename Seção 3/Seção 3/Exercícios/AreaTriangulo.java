package Exercícios;

import java.util.Scanner;

public class AreaTriangulo {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.print("Digite a base do triângulo: ");
    double base = s.nextDouble();

    System.out.print("Digite a altura do triângulo: ");
    double height = s.nextDouble();

    double area = (base * height) / 2;

    System.out.printf("A área do triângulo é: %.2f %n", area);
  }

}
