import java.util.Scanner;

public class AnoBissexto {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.println("Este programa verifica se um ano é bissexto.\n");

    System.out.print("Digite um ano: ");
    int ano = s.nextInt();

    if (ano % 4 == 0 && (ano % 100 != 0 || ano % 400 == 0)) {
      System.out.println("O ano " + ano + " é bissexto.");
    } else {
      System.out.println("O ano " + ano + " não é bissexto.");
    }
    s.close();

  }

}
