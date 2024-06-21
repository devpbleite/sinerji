import { useContext } from "react";
import { TodosContext } from "../TodosContext.jsx";
import Todo from "./Todo/Todo.jsx";

export default function TodosList() {
  const store = useContext(TodosContext);

  return (
    <div className="todos">
      {store.todos.map((todo) => (
        <Todo key={todo.id} todo={todo} />
      ))}
    </div>
  );
}
