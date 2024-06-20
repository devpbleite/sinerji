import java.util.Scanner;

public class MaiorNumero {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    int maior = 0;

    System.out.println("Este programa irá mostrar o maior número inserido.");

    System.out.println("Digite 10 números:");

    for (int i = 0; i < 10; i++) {
      System.out.print("Número " + (i + 1) + ": ");
      int numero = s.nextInt();

      if (numero > maior) {
        maior = numero;
      }
    }

    System.out.println("O maior número inserido é: " + maior);

    s.close();
  }

}
