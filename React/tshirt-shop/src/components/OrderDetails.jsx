import React from "react";

export default function OrderDetails({ itemsInBag }) {
  //Define a quantidade total de itens selecionados
  function calculateTotal() {
    let total = 0;
    itemsInBag.forEach((item) => (total += item.price * item.quantity));
    return total.toFixed(2);
  }

  return (
    <>
      <section className="summary">
        <strong>Order Details</strong>
        <table>
          <thead>
            <tr>
              <th>Item</th>
              <th>Total</th>
            </tr>
          </thead>
          <tbody>
            {itemsInBag.map((item) => (
              <tr key={item.id}>
                <td>
                  {item.quantity}x {item.name}
                </td>
                <td>$ {(item.price * item.quantity).toFixed(2)}</td>
              </tr>
            ))}

            <tr>
              <th>Total</th>
              <th>$ {calculateTotal()}</th>
            </tr>
          </tbody>
        </table>
      </section>
    </>
  );
}
