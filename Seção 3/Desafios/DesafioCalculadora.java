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

    double resultado;
    switch (operacao) {
      case "+":
        resultado = n1 + n2;
        break;
      case "-":
        resultado = n1 - n2;
        break;
      case "*":
        resultado = n1 * n2;
        break;
      case "/":
        if (n2 != 0) {
          resultado = n1 / n2;
        } else {
          System.out.println("Erro: Divisão por zero não é permitida.");
          s.close();
          return;
        }
        break;
      case "%":
        resultado = n1 % n2;
        break;
      default:
        System.out.println("Operação inválida.");
        s.close();
        return;
    }

    System.out.printf("O resultado da operação desejada é: %.2f %n", resultado);

    s.close();

  }

}
