import "./Filter.scss";
import { LuEraser } from "react-icons/lu";

export default function Filter() {
  return (
    <div className="filters">
      <div>
        <p>Filter by state</p>
        <div className="badges">
          <div className="badge selected">To-Do</div>
          <div className="badge">Done</div>
          <div>
            <span className="clear">
              x <LuEraser className="clear-icon" />
            </span>
          </div>
        </div>
      </div>
    </div>
  );
}
