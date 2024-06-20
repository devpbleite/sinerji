package DesafioClasseMetodo;

public class DesafioClasseData {

  public static void main(String[] args) {

    Data d1 = new Data();

    var d2 = new Data(31, 12, 2020);

    String dataFormatada = d1.obterDataFormatada();

    System.out.println("Esse programa mostra as datas formatadas usando classe e métodos.\n");

    System.out.println(dataFormatada);
    System.out.println(d2.obterDataFormatada());

    d1.imprimirDataFormatada();
    d2.imprimirDataFormatada();

  }

}
