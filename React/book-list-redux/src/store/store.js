import { configureStore } from "@reduxjs/toolkit";
import bookReducer from "./booksSlice.js";
import notesReducer from "./notesSlice.js";

export default configureStore({
  reducer: {
    books: bookReducer,
    notes: notesReducer,
  },
});
