public class DesafioAritmetica {
    public static void main(String[] args) {

        double numerador1 = Math.pow(6 * (3 + 2), 2);
        double denominador1 = 3 * 2;

        double numerador2 = (1 - 5) * (2 - 7);
        double denominador2 = 2;

        double numeradorA = numerador1 / denominador1;
        double numeradorB = Math.pow(numerador2 / denominador2, 2);

        double numerador = Math.pow(numeradorA - numeradorB, 3);
        double denominador = Math.pow(10, 3);

        double resultado = numerador / denominador;

        System.out.println("O resultado da expressão é: " + resultado);
    }
}
