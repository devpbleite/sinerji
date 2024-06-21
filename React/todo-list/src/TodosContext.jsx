import { createContext, useReducer } from "react";
import Header from "./components/Header/Header";
import Home from "./views/Home";
import todosReducer from "./TodosReducer";
import initialTodos from "./components/staticList";

export const TodosContext = createContext("");

export default function TodosProvider() {
  const [todos, dispatch] = useReducer(todosReducer, initialTodos);

  return (
    <main>
      <TodosContext.Provider value={{ todos, dispatch }}>
        <Header appName="To-Do List" />

        <Home />
      </TodosContext.Provider>
    </main>
  );
}
