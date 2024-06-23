import { useTodos } from "../../TodosContext";
import "./Filter.scss";
import { LuEraser } from "react-icons/lu";

export default function Filter() {
  const store = useTodos();

  return (
    <div className="filters">
      <div>
        <p>Filter by state</p>
        <div className="badges">
          <div
            className={`badge ${store.filterBy === "todo" ? "selected" : ""}`}
            onClick={() => store.setFilterBy("todo")}
          >
            To-Do
          </div>
          <div
            className={`badge ${store.filterBy === "done" ? "selected" : ""}`}
            onClick={() => store.setFilterBy("done")}
          >
            Done
          </div>
          <div>
            {store.filterBy && (
              <span onClick={() => store.setFilterBy("")} className="clear">
                x <LuEraser className="clear-icon" />
              </span>
            )}
          </div>
        </div>
      </div>
    </div>
  );
}
