import Header from "./components/Header/Header.jsx";
import Home from "./views/Home.jsx";
import { TodosContext } from "./TodosContext.jsx";
import { useReducer } from "react";
import todosReducer from "./TodosReducer.js";
import initialTodos from "./components/staticList.js";
import "./App.scss";

export default function App() {
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
