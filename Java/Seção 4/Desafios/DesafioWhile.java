import java.util.Scanner;

public class DesafioWhile {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    int quantidadeNotas = 0;
    double nota = 0;
    double total = 0;

    while (nota != -1) {
      System.out.print("Digite a nota (ou -1 para sair): ");
      nota = s.nextDouble();
      if (nota <= 10 && nota >= 0) {
        total += nota;
        quantidadeNotas++;
      } else if (nota != -1) {
        System.out.println("Nota inválida! Digite uma nota entre 0 e 10.");
      }
    }

    if (quantidadeNotas > 0) {
      System.out.println("Média: " + (total / quantidadeNotas));
    } else {
      System.out.println("Nenhuma nota válida foi inserida.");
    }

    s.close();

  }

}
