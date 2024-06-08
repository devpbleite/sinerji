import java.util.Scanner;

public class DesafioCalculadora {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.print("Digite o primeiro número: ");
    double n1 = s.nextDouble();

    System.out.print("Digite o segundo número: ");
    double n2 = s.nextDouble();

    System.out.print("Digite a operação desejada: ");
    String operacao = s.next();

    double resultado = "+".equals(operacao) ? n1 + n2 : 0;
    resultado = "-".equals(operacao) ? n1 - n2 : resultado;
    resultado = "*".equals(operacao) ? n1 * n2 : resultado;
    resultado = "/".equals(operacao) ? n1 / n2 : resultado;
    resultado = "%".equals(operacao) ? n1 % n2 : resultado;

    System.out.printf("O resultado da operação desejada é: %.2f %n", resultado);

    s.close();
  }

}
