import { useTodos } from "../../TodosContext.jsx";
import { IoTrashOutline } from "react-icons/io5";
import "./Todo.scss";

export default function Todo({ todo }) {
  const store = useTodos();

  return (
    <div className={`todo ${todo.isDone ? "done" : ""}`}>
      <button className="erase">
        <IoTrashOutline
          onClick={() =>
            store.dispatch({
              type: "deleted",
              id: todo.id,
            })
          }
        />
      </button>
      <h3>{todo.title}</h3>
      <p>{todo.description}</p>
      <div className="task-check">
        <input
          onClick={() =>
            store.dispatch({
              type: "toogledIsDone",
              id: todo.id,
            })
          }
          type="checkbox"
          defaultChecked={todo.isDone}
        />
        <label>{!todo.isDone ? "To-Do" : "Done"}</label>
      </div>
    </div>
  );
}
