import java.util.Scanner;

public class DesafioDiaSemana {

    public static void main(String[] args) {

        Scanner s = new Scanner(System.in);

        System.out.print("Digite o dia da semana: ");
        String dia = s.next().trim().toLowerCase();

        switch (dia) {
            case "domingo":
                System.out.println("Domingo é o 1º dia da semana");
                break;
            case "segunda":
                System.out.println("Segunda é o 2º dia da semana");
                break;
            case "terça":
            case "terca":
                System.out.println("Terça é o 3º dia da semana");
                break;
            case "quarta":
                System.out.println("Quarta é o 4º dia da semana");
                break;
            case "quinta":
                System.out.println("Quinta é o 5º dia da semana");
                break;
            case "sexta":
                System.out.println("Sexta é o 6º dia da semana");
                break;
            case "sábado":
            case "sabado":
                System.out.println("Sábado é o 7º dia da semana");
                break;
            default:
                System.out.println("Digite um dia de semana válido!");
        }

        s.close();

    }

}
