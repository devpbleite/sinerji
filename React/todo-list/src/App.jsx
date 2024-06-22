import Header from "./components/Header/Header.jsx";
import Home from "./views/Home.jsx";
import TodosProvider from "./TodosContext.jsx";
import "./App.scss";

export default function App() {
  return (
    <main>
      <TodosProvider>
        <Header appName="To-Do List" />
        <Home />
      </TodosProvider>
    </main>
  );
}
