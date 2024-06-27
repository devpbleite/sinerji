package com.example.vendas;

import com.example.vendas.domain.entity.Cliente;
import com.example.vendas.domain.entity.Pedido;
import com.example.vendas.domain.repository.Clientes;
import com.example.vendas.domain.repository.Pedidos;
import org.springframework.beans.factory.annotation.Autowired;
import org.springframework.boot.CommandLineRunner;
import org.springframework.boot.SpringApplication;
import org.springframework.boot.autoconfigure.SpringBootApplication;
import org.springframework.context.annotation.Bean;

import java.math.BigDecimal;
import java.time.LocalDate;

@SpringBootApplication
public class VendasApplication {

	@Bean
	public CommandLineRunner init(
			@Autowired Clientes clientes,
			@Autowired Pedidos pedidos) {
		return args -> {
			System.out.println("Salvando clientes");
			Cliente client = new Cliente("Pablo Leite");
			clientes.save(client);

			Pedido p = new Pedido();
			p.setCliente(client);
			p.setDataPedido(LocalDate.now());
			p.setTotal(BigDecimal.valueOf(100));

			pedidos.save(p);

			// Cliente cliente = clientes.findClienteFetchPedidos(client.getId());
			// System.out.println(cliente);
			// System.out.println(cliente.getPedidos());

			pedidos.findByCliente(client).forEach(System.out::println);

		};
	}

	public static void main(String[] args) {
		SpringApplication.run(VendasApplication.class, args);
	}
}
