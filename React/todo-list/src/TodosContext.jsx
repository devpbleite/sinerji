import { createContext, useReducer, useContext } from "react";
import initialTodos from "./components/staticList";

export const TodosContext = createContext("");

export default function TodosProvider({ children }) {
  const [todos, dispatch] = useReducer(todosReducer, initialTodos);

  return (
    <main>
      <TodosContext.Provider value={{ todos, dispatch }}>
        {children}
      </TodosContext.Provider>
    </main>
  );
}

export function useTodos() {
  return useContext(TodosContext);
}

function todosReducer(todos, action) {
  switch (action.type) {
    case "deleted": {
      if (window.confirm("Você tem certeza que deseja excluir esta tarefa?")) {
        return todos.filter((todo) => todo.id !== action.id);
      }
    }

    case "toogledIsDone": {
      return todos.map((todo) => {
        if (todo.id === action.id) {
          todo.isDone = !todo.isDone;
          return todo;
        } else {
          return todo;
        }
      });
    }
  }
}
