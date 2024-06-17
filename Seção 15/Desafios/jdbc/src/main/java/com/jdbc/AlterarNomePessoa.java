package com.jdbc;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.ResultSet;
import java.sql.SQLException;
import java.util.Scanner;

public class AlterarNomePessoa {
    public static void main(String[] args) throws SQLException {

        Scanner entrada = new Scanner(System.in);

        System.out.print("Informe o código da pessoa: ");
        int codigo = entrada.nextInt();

        String select = "select codigo, nome from pessoa where codigo = ?";
        String update = "update pessoa set nome = ? where codigo = ?";

        Connection conexao = FabricaConexao.getConexao();
        PreparedStatement stmt = conexao.prepareStatement(select);
        stmt.setInt(1, codigo);
        ResultSet r = stmt.executeQuery();

        if (r.next()) {
            Pessoa p = new Pessoa(r.getInt(1), r.getString(2));
            System.out.println("O nome atual é: " + p.getNome());
            entrada.nextLine();

            System.out.print("Informe o novo nome: ");
            String novoNome = entrada.nextLine();

            stmt.close();
            stmt = conexao.prepareStatement(update);
            stmt.setString(1, novoNome);
            stmt.setInt(2, codigo);
            stmt.execute();

            System.out.println("Pessoa alterada com sucesso!");
        } else {
            System.out.println("Pessoa não encontrada!");
        }

        conexao.close();
        entrada.close();
    }
}
