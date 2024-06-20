public class DesafioAritmetica {
    public static void main(String[] args) {

        // Cálculo da primeira parte da expressão
        double numerador1 = Math.pow(6 * (3 + 2), 2);
        double denominador1 = 3 * 2;

        // Cálculo da segunda parte da expressão
        double numerador2 = (1 - 5) * (2 - 7);
        double denominador2 = 2;

        // Cálculo dos resultados intermediários
        double numeradorA = numerador1 / denominador1;
        double numeradorB = Math.pow(numerador2 / denominador2, 2);

        // Cálculo do resultado final
        double numerador = Math.pow(numeradorA - numeradorB, 3);
        double denominador = Math.pow(10, 3);

        double resultado = numerador / denominador;

        // Exibição do resultado
        System.out.println("O resultado da expressão é: " + resultado);
    }
}
