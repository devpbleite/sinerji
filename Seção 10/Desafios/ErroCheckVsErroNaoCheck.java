public class ErroCheckVsErroNaoCheck {

  public static void main(String[] args) {

    // Captura a RuntimeException lançada pelo método geraErro1
    try {
      geraErro1();
    } catch (RuntimeException e) {
      System.out.println(e.getMessage());
    }

    // Captura a Exception lançada pelo método geraErro2
    try {
      geraErro2();
    } catch (Exception e) {
      System.out.println(e.getMessage());
    }

    // Indica que o programa chegou ao fim
    System.out.println("Fim.");
  }

  /**
   * Método que lança uma RuntimeException com uma mensagem específica.
   */
  public static void geraErro1() {
    throw new RuntimeException("Erro #01");
  }

  /**
   * Método que lança uma Exception com uma mensagem específica.
   * 
   * @throws Exception para indicar que este método pode lançar uma Exception.
   */
  public static void geraErro2() throws Exception {
    throw new Exception("Erro #02");
  }
}
