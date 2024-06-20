import java.util.Scanner;

public class CalculaMedia {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.println("Este programa diz se o aluno está Aprovado, em Recuperação ou Reprovado.\n");

    System.out.print("Digite a primeira nota: ");
    double nota1 = s.nextDouble();

    System.out.print("Digite a segunda nota: ");
    double nota2 = s.nextDouble();

    double media = (nota1 + nota2) / 2;

    if (media >= 7) {
      System.out.println("A média do aluno é " + media + ", portanto ele está Aprovado.");
    } else if (media < 7 && media >= 4) {
      System.out.println("A média do aluno é " + media + ", portanto ele está em Recuperação.");
    } else {
      System.out.println("A média do aluno é " + media + ", portanto ele está Reprovado.");
    }
    s.close();
  }

}
