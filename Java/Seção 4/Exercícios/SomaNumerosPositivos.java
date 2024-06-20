import java.util.Scanner;

public class SomaNumerosPositivos {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    int soma = 0;
    int numero;

    System.out.println("Digite números inteiro para somar ou um número negativo para encerrar o programa.");

    while (true) {
      System.out.print("Digite um número: ");
      numero = s.nextInt();

      if (numero < 0) {
        break;
      }

      soma += numero;
    }

    System.out.println("A soma dos números inseridos é: " + soma);

    s.close();
  }

}
