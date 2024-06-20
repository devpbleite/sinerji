import java.util.Scanner;

public class DesafioArrays {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.print("Digite a quantidade de notas: ");

    int qtdNotas = s.nextInt();

    double[] notas = new double[qtdNotas];

    for (int i = 0; i < notas.length; i++) {
      System.out.print("Digite a nota " + (i + 1) + ": ");
      notas[i] = s.nextDouble();
    }

    double total = 0;
    for (double nota : notas) {
      total += nota;
    }

    System.out.println("A média é: " + total / qtdNotas);

    s.close();

  }

}
