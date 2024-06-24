import { BrowserRouter, Routes, Route } from "react-router-dom";
import BooksPage from "./views/BooksPage.jsx";
import LoginPage from "./views/LoginPage.jsx";
import SingleBookPage from "./views/SingleBookPage.jsx";
import AddBookPage from "./views/AddBookPage.jsx";

export default function App() {
  return (
    <>
      <BrowserRouter>
        <Routes>
          <Route path="/" element={<LoginPage />} />
          <Route path="/add-book" element={<AddBookPage />} />
          <Route path="/book/:id" element={<SingleBookPage />} />
        </Routes>
      </BrowserRouter>
    </>
  );
}
