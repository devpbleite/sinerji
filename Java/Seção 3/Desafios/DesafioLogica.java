public class DesafioLogica {
    public static void main(String[] args) {

        boolean a = true;
        boolean b = false;

        boolean compraTV50 = a && b;

        boolean compraTV32 = a ^ b;

        String tv50 = compraTV50 ? "Sim" : "Não";

        String tv32 = compraTV32 ? "Sim" : "Não";

        System.out.println("Comprar TV 50 polegadas? Resposta: " + tv50);

        System.out.println("Comprar TV 32 polegadas? Resposta: " + tv32);

    }
}
