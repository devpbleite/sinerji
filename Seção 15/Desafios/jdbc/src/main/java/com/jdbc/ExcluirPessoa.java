package com.jdbc;

import java.sql.Connection;
import java.sql.PreparedStatement;
import java.sql.SQLException;
import java.util.Scanner;

public class ExcluirPessoa {
    public static void main(String[] args) throws SQLException {

        Scanner entrada = new Scanner(System.in);
        System.out.print("Informe o código da pessoa: ");
        int codigo = entrada.nextInt();

        Connection conexao = FabricaConexao.getConexao();
        String sql = "delete from pessoa where codigo = ?";

        PreparedStatement stmt = conexao.prepareStatement(sql);
        stmt.setInt(1, codigo);

        if (stmt.executeUpdate() > 0) {
            System.out.println("Pessoa excluída com sucesso!");
        } else {
            System.out.println("Pessoa não encontrada!");
        }

        conexao.close();
        entrada.close();
    }
}
