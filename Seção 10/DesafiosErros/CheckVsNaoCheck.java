public class CheckVsNaoCheck {

  public static void main(String[] args) {
    geraErro1();
    geraErro2();
  }

  static void geraErro1() {
    throw new RuntimeException("Erro 1");
  }

  static void geraErro2() {
    throw new RuntimeException("Erro 2");
  }

}
