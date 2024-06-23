import Filter from "../components/Filter/Filter.jsx";
import TodosList from "../components/TodosList.jsx";
import ModalWindow from "../components/Modals/ModalWindow/ModalWindow.jsx";
import AddTodoModal from "../components/Modals/AddModalWindows/AddTodoModal.jsx";
import { useTodos } from "../TodosContext.jsx";

export default function Home() {
  const store = useTodos();
  return (
    <>
      {store.modalIsActive && (
        <ModalWindow>
          <AddTodoModal />
        </ModalWindow>
      )}
      <div className="container">
        <Filter />

        <TodosList />
      </div>
    </>
  );
}
