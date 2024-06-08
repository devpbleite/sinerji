import java.util.Scanner;

public class ImprimeLetraPorLetra {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.println("Esse programa imprime letra por letra de uma palavra.\n");

    System.out.print("Digite uma palavra: ");
    String palavra = s.nextLine();

    System.out.println("Letra por letra:");

    for (int i = 0; i < palavra.length(); i++) {
      char letra = palavra.charAt(i);
      System.out.println(letra);
    }

    s.close();
  }

}
