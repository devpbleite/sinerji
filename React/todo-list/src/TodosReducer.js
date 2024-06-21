export default function todosReducer(todos, action) {
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
