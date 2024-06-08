import java.util.Scanner;

public class DesafioDiaSemana {

    public static void main(String[] args) {

        Scanner s = new Scanner(System.in);

        System.out.print("Digite o dia da semana: ");
        String dia = s.next();

        if (dia.equalsIgnoreCase("domingo")) {
            System.out.println("Domingo é o 1º dia da semana");
        } else if (dia.equalsIgnoreCase("segunda")) {
            System.out.println("Segunda é o 2º dia da semana");
        } else if (dia.equalsIgnoreCase("terça") || dia.equalsIgnoreCase("terca")) {
            System.out.println("Terça é o 3º dia da semana");
        } else if (dia.equalsIgnoreCase("quarta")) {
            System.out.println("Quarta é o 4º dia da semana");
        } else if (dia.equalsIgnoreCase("quinta")) {
            System.out.println("Quinta é o 5º dia da semana");
        } else if (dia.equalsIgnoreCase("sexta")) {
            System.out.println("Sexta é o 6º dia da semana");
        } else if (dia.equalsIgnoreCase("sábado") || dia.equalsIgnoreCase("sabado")) {
            System.out.println("Sábado é o 7º dia da semana");
        } else {
            System.out.println("Digite um dia de semana válido!");
        }

        s.close();

    }

}
