import java.util.Arrays;
import java.util.List;
import java.util.function.Function;
import java.util.function.Predicate;

public class Filtro {

  public static void main(String[] args) {

    List<Produto> produtos = Arrays.asList(
        new Produto("Notebook", 3500.00, 20.0, 60),
        new Produto("Smartphone", 1500.00, 35.0, 35),
        new Produto("Geladeira", 2500.00, 25.0, 40),
        new Produto("Televisão", 1800.00, 40.0, 0),
        new Produto("Fone de Ouvido", 200.00, 30.0, 0),
        new Produto("Cafeteira", 250.00, 50.0, 0));

    Predicate<Produto> descontoMaiorQue30 = p -> p.getDesconto() >= 30.0;
    Predicate<Produto> freteGratis = f -> f.isFreteGratis() == 0.0;

    Function<Produto, String> formatacaoProduto = p -> String.format("%s - R$ %.2f - super promoção", p.getNome(),
        p.getPreco());

    produtos.stream()
        .filter(descontoMaiorQue30)
        .filter(freteGratis)
        .map(formatacaoProduto)
        .forEach(System.out::println);

  }
}
