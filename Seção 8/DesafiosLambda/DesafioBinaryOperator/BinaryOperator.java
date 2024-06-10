import java.util.Scanner;
import java.util.function.Function;
import java.util.function.UnaryOperator;

public class BinaryOperator {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.println("Bem-vindo ao sistema de cálculo de preço final de produtos!\n");

    System.out.print("Digite o nome do produto: \n");
    String nome = s.nextLine();

    System.out.print("Digite o preço do produto: \n");
    double preco = Double.parseDouble(s.nextLine());

    double desconto = 0.13;

    Function<Produto1, Double> precoFinal = produto -> produto.getPreco() * (1 - produto.getDesconto());
    UnaryOperator<Double> impostoMunicipal = preco1 -> preco1 >= 2500 ? preco1 * 1.085 : preco1;
    UnaryOperator<Double> frete = preco1 -> preco1 >= 3000 ? preco1 + 100 : preco1 + 50;
    UnaryOperator<Double> arredondar = preco1 -> Double.parseDouble(String.format("%.2f", preco1).replace(",", "."));
    Function<Double, String> formatar = preco1 -> ("R$ " + preco1).replace(".", ",");

    Produto1 p = new Produto1(nome, preco, desconto);

    String precoFinal1 = precoFinal
        .andThen(impostoMunicipal)
        .andThen(frete)
        .andThen(arredondar)
        .andThen(formatar)
        .apply(p);

    System.out.println("O preço final do produto é " + precoFinal1);

    s.close();

  }
}
