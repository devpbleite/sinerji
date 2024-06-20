package DesafiosOO.DesafioModificadores;

import DesafiosOO.DesafioHeranca.Onix;
import DesafiosOO.DesafioHeranca.Vitus;

public class CarroVelocidade {

  public static void main(String[] args) {

    Onix carro1 = new Onix();
    carro1.setNome("Onix");

    Vitus carro2 = new Vitus(250);
    carro2.setNome("Vitus");

    carro1.acelerar();
    System.out.println(carro1);

    carro1.acelerar();
    System.out.println(carro1);

    carro1.acelerar();
    System.out.println(carro1);

    carro2.acelerar();
    System.out.println(carro2);

    carro2.acelerar();
    System.out.println(carro2);

    carro2.acelerar();
    System.out.println(carro2);

  }

}
