import { BrowserRouter, Routes, Route } from "react-router-dom";
import BooksPage from "./views/BooksPage.jsx";
import LoginPage from "./views/LoginPage.jsx";
import SingleBookPage from "./views/SingleBookPage.jsx";
import AddBookPage from "./views/AddBookPage.jsx";
import { selectUsers } from "./store/usersSlice.js";
import { useSelector } from "react-redux";

export default function App() {
  const user = useSelector(selectUsers);

  return (
    <>
      {user.currentUser ? (
        <BrowserRouter>
          <Routes>
            <Route index element={<BooksPage />} />
            <Route path="/add-book" element={<AddBookPage />} />
            <Route path="/book/:id" element={<SingleBookPage />} />
          </Routes>
        </BrowserRouter>
      ) : (
        <LoginPage />
      )}
    </>
  );
}
