package com.jdbc;

import java.sql.*;

public class DAO {

    private Connection conexao;

    public int incluir (String sql, Object... atributos) {
        try {
            Connection conexao = getConexao();
            PreparedStatement stmt = getConexao().prepareStatement(sql, PreparedStatement.RETURN_GENERATED_KEYS);
            adicionarAtributos(stmt, atributos);
            if (stmt.executeUpdate() > 0) {
                ResultSet resultado = stmt.getGeneratedKeys();
                if (resultado.next()) {
                    return resultado.getInt(1);
                }
            }
            return -1;
        } catch (SQLException e) {
            throw new RuntimeException(e);
        }
    }

    public void close() {
        try {
            getConexao().close();
        } catch (SQLException e) {
            throw new RuntimeException(e);
        } finally {
            conexao = null;
        }
    }

    private void adicionarAtributos(PreparedStatement stmt, Object[] atributos) throws SQLException {
        int indice = 1;
        for (Object atributo : atributos) {
            if (atributo instanceof String) {
                stmt.setString(indice, (String) atributo);
            } else if (atributo instanceof Integer) {
                stmt.setInt(indice, (Integer) atributo);
            }
            indice++;
        }
    }

    private Connection getConexao() {
        try {
            if (conexao != null && !conexao.isClosed()) {
                return conexao;
            }
        } catch (Exception e) {

    }
        conexao = FabricaConexao.getConexao();
        return conexao;
    }
}
