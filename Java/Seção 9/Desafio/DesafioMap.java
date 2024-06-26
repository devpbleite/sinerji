import java.util.Arrays;
import java.util.List;
import java.util.function.Function;
import java.util.function.UnaryOperator;

public class DesafioMap {

  public static void main(String[] args) {

    List<Integer> numeros = Arrays.asList(1, 2, 3, 4, 5, 6, 7, 8, 9);

    UnaryOperator<String> inverter = str -> new StringBuilder(str).reverse().toString();
    Function<String, Integer> bin = str -> Integer.parseInt(str, 2);

    numeros.stream()
        .map(Integer::toBinaryString)
        .map(inverter)
        .map(bin)
        .forEach(System.out::println);

  }

}
