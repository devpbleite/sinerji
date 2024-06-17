package com.jdbc;

public class DAOTeste {
    public static void main(String[] args) {
        DAO dao = new DAO();
        String sql = "INSERT INTO pessoa (nome) VALUES (?)";
        System.out.println(dao.incluir(sql, "Ana"));
        System.out.println(dao.incluir(sql, "Carlos"));
        System.out.println(dao.incluir(sql, "João"));

        dao.close();
    }
}
