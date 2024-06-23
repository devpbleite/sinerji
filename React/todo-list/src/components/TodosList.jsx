import { useTodos } from "../TodosContext.jsx";
import Todo from "./Todo/Todo.jsx";

export default function TodosList() {
  const store = useTodos();

  return (
    <div className="todos">
      {store.filteredTodos().length
        ? store
            .filteredTodos()
            .map((todo) => <Todo key={todo.id} todo={todo} />)
        : "No to-do found. Try clearing the filter or adding a new one."}
    </div>
  );
}
