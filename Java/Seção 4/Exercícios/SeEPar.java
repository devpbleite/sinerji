import java.util.Scanner;

public class SeEPar {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.println("Este programa verifica se um número está entre 0 e 10 e se é par.\n");

    System.out.print("Digite um número: ");
    int numero = s.nextInt();

    if (numero >= 0 && numero <= 10) {
      if (numero % 2 == 0) {
        System.out.println("O número " + numero + " está entre 0 e 10, e é par.");
      } else {
        System.out.println("O número " + numero + " está entre 0 e 10, mas não é par.");
      }
    } else {
      System.out.println("O número " + numero + " não está entre 0 e 10.");
    }
    s.close();

  }

}
