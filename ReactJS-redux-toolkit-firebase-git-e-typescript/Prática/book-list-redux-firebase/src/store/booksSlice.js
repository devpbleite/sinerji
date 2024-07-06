import { createSlice, createAsyncThunk } from "@reduxjs/toolkit";
import {
  collection,
  query,
  where,
  getDocs,
  doc,
  updateDoc,
  deleteDoc,
  addDoc,
} from "firebase/firestore";
import { db, auth } from "../firebase/config.js";

export const booksSlice = createSlice({
  name: "books",
  initialState: {
    books: [],
    status: "idle",
  },
  reducers: {},
  extraReducers(builder) {
    builder
      .addCase(fetchBooks.pending, (state, action) => {
        state.status = "loading";
      })
      .addCase(fetchBooks.fulfilled, (state, action) => {
        state.status = "succeeded";
        state.books = action.payload;
      })
      .addCase(fetchBooks.rejected, (state, action) => {
        state.status = "failed";
        console.log(action.error.message);
      })
      .addCase(toggleRead.fulfilled, (state, action) => {
        state.books.map((book) => {
          if (book.id == action.payload) {
            book.isRead = !book.isRead;
          }
        });
      })
      .addCase(toggleRead.rejected, (state, action) => {
        state.status = "failed";
        console.log(action.error.message);
      })
      .addCase(eraseBook.fulfilled, (state, action) => {
        state.books = state.books.filter((book) => book.id != action.payload);
      })
      .addCase(eraseBook.rejected, (state, action) => {
        state.status = "failed";
        console.log(action.error.message);
      })
      .addCase(addBook.fulfilled, (state, action) => {
        state.books.push(action.payload);
      })
      .addCase(addBook.rejected, (state, action) => {
        state.status = "failed";
        console.log(action.error.message);
      });
  },
});

export const selectBooks = (state) => state.books;

export default booksSlice.reducer;

export const fetchBooks = createAsyncThunk("books/fetchBooks", async () => {
  const q = query(
    collection(db, "books"),
    where("user_id", "==", auth.currentUser.uid)
  );
  const querySnapshot = await getDocs(q);
  let bookList = [];
  querySnapshot.forEach((doc) => {
    bookList.push({ ...doc.data(), id: doc.id });
  });

  return bookList;
});

export const toggleRead = createAsyncThunk(
  "books/toggleRead",
  async (payload) => {
    const bookRef = doc(db, "books", payload.id);
    await updateDoc(bookRef, {
      isRead: !payload.isRead,
    });
    return payload.id;
  }
);

export const eraseBook = createAsyncThunk(
  "books/eraseBook",
  async (payload) => {
    await deleteDoc(doc(db, "books", payload));
    return payload;
  }
);

export const addBook = createAsyncThunk("books/addBook", async (payload) => {
  let newBook = payload;
  newBook.user_id = auth.currentUser.uid;
  const docRef = await addDoc(collection(db, "books"), newBook);
  newBook.id = docRef.id;
  return newBook;
});

/*[
    {
      id: 1,
      title: "A Short History of Europe",
      cover:
        "https://printpress.cmsmasters.net/default/wp-content/uploads/sites/11/2019/05/printpress-product-6-540x861.jpg",
      isRead: true,
      author: "Simon Jenkins",
      synopsis:
        "In this dazzling new history, bestselling author Simon Jenkins grippingly tells the story of its evolution from warring peoples to peace, wealth and freedom - a story that twists and turns from Greece and Rome, through the Dark Ages, the Reformation and the French Revolution, to the Second World War and up to the present day.",
    },
    {
      id: 2,
      title: "Penguin Classics",
      cover:
        "https://printpress.cmsmasters.net/default/wp-content/uploads/sites/11/2019/05/printpress-product-2-540x861.jpg",
      isRead: false,
      author: "Henry Eliot",
      synopsis:
        "The Penguin Classics Book covers all the greatest works of fiction, poetry, drama, history, and philosophy in between, this reader's companion encompasses 500 authors, 1,200 books, and 4,000 years of world literature, from ancient Mesopotamia to World War I.",
    },
    {
      id: 3,
      title: "Becoming",
      cover:
        "https://printpress.cmsmasters.net/default/wp-content/uploads/sites/11/2019/05/printpress-product-7-540x861.jpg",
      isRead: false,
      author: "Michelle Obama",
      synopsis:
        "“Becoming” is an autobiography detailing the highs and lows of Michelle Obama's incredible journey from humble beginnings in the less glamourous South Side of Chicago, to the grandeur of the White House and life as America's first African-American First Lady.",
    },
    {
      id: 4,
      title: "Sonnets",
      cover:
        "https://printpress.cmsmasters.net/default/wp-content/uploads/sites/11/2019/05/printpress-product-5-540x861.jpg",
      isRead: false,
      author: "James Anthony",
      synopsis:
        "Shakespeare wrote 154 sonnets published in his 'quarto' in 1609, covering themes such as the passage of time, mortality, love, beauty, infidelity, and jealousy. The first 126 of Shakespeare's sonnets are addressed to a young man, and the last 28 addressed to a woman – a mysterious 'dark lady'.",
    },
  ], */
