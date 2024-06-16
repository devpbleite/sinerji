package DesafiosOO.DesafioComposicao;

import java.util.Scanner;

public class SistemaLoja {

  public static void main(String[] args) {

    Scanner s = new Scanner(System.in);

    System.out.println("Bem-vindo a nossa Loja!\n");

    System.out.print("Digite seu nome: ");
    String nome = s.nextLine();

    System.out.println("Olá, " + nome + "! Vamos verificar o total das suas compras.\n");

    Cliente cliente = new Cliente(nome);

    Compra compra1 = new Compra();
    compra1.adicionarItem("Iphone", 5000.00, 1);
    compra1.adicionarItem("Macbook Air M1", 10000.00, 1);
    cliente.adicionarCompra(compra1);

    Compra compra2 = new Compra();
    compra2.adicionarItem("Mouse", 350.00, 1);
    compra2.adicionarItem("Teclado", 400.00, 1);
    compra2.adicionarItem("Monitor", 900.00, 1);
    cliente.adicionarCompra(compra2);

    System.out.println("O valor total das suas compras é R$ " + cliente.obterValorTotal());

    s.close();

  }
}
