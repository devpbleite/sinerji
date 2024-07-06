import { configureStore } from "@reduxjs/toolkit";
import bookReducer from "./booksSlice.js";
import notesReducer from "./notesSlice.js";
import usersReducer from "./usersSlice.js";

export default configureStore({
  reducer: {
    books: bookReducer,
    notes: notesReducer,
    users: usersReducer,
  },
});
