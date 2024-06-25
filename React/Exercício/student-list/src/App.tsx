import React from "react";
import { StudentProvider } from "./context/StudentContext";
import StudentTable from "./components/StudentTable";

const App = () => {
  return (
    <StudentProvider>
      <StudentTable />
    </StudentProvider>
  );
};

export default App;
