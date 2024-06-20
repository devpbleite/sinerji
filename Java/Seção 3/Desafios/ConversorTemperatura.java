public class ConversorTemperatura {

    public static void main(String[] args) {

        // Constantes para conversão
        final double ajuste = 32;
        final double fator = 5.0 / 9.0;

        // Temperatura em Fahrenheit
        double fahrenheit = 212;

        // Conversão para Celsius
        double celsius = (fahrenheit - ajuste) * fator;

        // Exibição do resultado
        System.out.printf("O valor em celsius é: %.2f°C %n", celsius);
    }
}
