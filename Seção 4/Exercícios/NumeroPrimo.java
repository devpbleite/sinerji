import java.util.Scanner;

public class NumeroPrimo {

  public static void main(String[] args) {

    int primo = 0;
    Scanner s = new Scanner(System.in);

    System.out.println("Este programa verifica se um número é primo.\n");

    System.out.print("Digite um número: ");
    int numero = s.nextInt();

    for (int i = 2; i < numero; i++) {
      if (numero % i == 0) {
        primo++;
      }
    }

    if (primo == 0) {
      System.out.println("O número " + numero + " é primo.");
    } else {
      System.out.println("O número " + numero + " não é primo.");
    }

    s.close();

  }

}
