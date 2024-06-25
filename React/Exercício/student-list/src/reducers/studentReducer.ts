export interface StudentAction {
  type: "addStudent" | "removeStudent";
  payload: any;
}

export default function studentReducer(state: any[], action: StudentAction) {
  switch (action.type) {
    case "addStudent":
      return [...state, action.payload];
    case "removeStudent":
      return state.filter((student) => student.id !== action.payload.id);
    default:
      return state;
  }
}
