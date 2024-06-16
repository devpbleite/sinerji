import java.util.Scanner;

public class DesafioConversao {
    public static void main(String[] args) {

        Scanner scan = new Scanner(System.in);

        System.out.print("Digite o primeiro salário: ");
        String valor1 = scan.next().replace(",", ".");

        System.out.print("Digite o segundo salário: ");
        String valor2 = scan.next().replace(",", ".");

        System.out.print("Digite o terceiro salário: ");
        String valor3 = scan.next().replace(",", ".");

        double salario1 = Double.parseDouble(valor1);
        double salario2 = Double.parseDouble(valor2);
        double salario3 = Double.parseDouble(valor3);

        double media = (salario1 + salario2 + salario3) / 3;

        System.out.printf("A média salarial é de: R$ %.2f %n", media);

        scan.close();

    }
}
