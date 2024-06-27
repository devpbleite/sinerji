package com.example.vendas.domain.repository;

import com.example.vendas.domain.entity.ItemPedido;
import org.springframework.data.jpa.repository.JpaRepository;

import java.util.List;

public interface ItemsPedido extends JpaRepository<ItemPedido, Integer> {


}