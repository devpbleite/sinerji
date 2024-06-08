public class ConversorTemperatura {

    public static void main(String[] args) {
        final double ajuste = 32;
        final double fator = 5.0 / 9.0;

        double fahrenheit = 212;
        double celsius = (fahrenheit - ajuste) * fator;

        System.out.printf("O valor em celsius é: %.2f°C %n", celsius);
    }
}
