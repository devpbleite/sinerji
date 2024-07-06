import { useState } from "react";
import "./App.css";
import Item from "./components/Item";
import OrderDetails from "./components/OrderDetails";
import itemsList from "./components/itemsList";

export default function App() {
  //Define states iniciais dos itens
  const [items, setItems] = useState(itemsList);

  //Filtra itens selecionados e adiciona a propriedade isInBag
  const itemsInBag = items.filter((item) => item.isInBag);

  //Define a seleção do status para um produto.
  function selectProduct(id) {
    let item = items.filter((item) => item.id === id)[0];
    item.isInBag = !item.isInBag;
    setItems(items.map((i) => (i.id === id ? item : i)));
  }

  //Define a quantidade de itens selecionados
  function quantityHandler(e, id, increment) {
    e.stopPropagation();
    let item = items.filter((item) => item.id === id)[0];
    item.quantity += increment;
    setItems(items.map((i) => (i.id === id ? item : i)));
  }

  return (
    <>
      <section className="items">
        <h4>T-Shirt Store</h4>

        {items.map((item) => (
          <Item
            selectProduct={(id) => selectProduct(id)}
            changeQuantity={(e, id, increment) =>
              quantityHandler(e, id, increment)
            }
            key={item.id}
            item={item}
          />
        ))}
      </section>

      {itemsInBag.length > 0 && <OrderDetails itemsInBag={itemsInBag} />}
    </>
  );
}
