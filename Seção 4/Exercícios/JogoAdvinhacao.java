import java.util.Scanner;

public class JogoAdvinhacao {

  public static void main(String[] args) {
    Scanner scanner = new Scanner(System.in);

    int numeroAdivinhar = (int) (Math.random() * 101);
    int tentativas = 10;
    int palpite;

    System.out.println("Bem-vindo ao Jogo da Adivinhação!\n");
    System.out.println("Tente adivinhar um número entre 0 e 100.\n");

    while (tentativas > 0) {
      System.out.println("Tentativas restantes: " + tentativas);
      System.out.print("Digite o seu palpite: ");
      palpite = scanner.nextInt();

      if (palpite == numeroAdivinhar) {
        System.out.println("Parabéns! Você acertou o número!\n");
        break;
      } else if (palpite < numeroAdivinhar) {
        System.out.println("O número é maior que o seu palpite.\n");
      } else {
        System.out.println("O número é menor que o seu palpite.\n");
      }

      tentativas--;
    }

    if (tentativas == 0) {
      System.out.println("Você perdeu! O número era: " + numeroAdivinhar);
    }

    scanner.close();
  }

}
