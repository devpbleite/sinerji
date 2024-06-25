import React, { createContext, useReducer, ReactNode } from "react";
import studentReducer, { StudentAction } from "../reducers/studentReducer";
import data from "../data";

interface Student {
  id: string;
  dateAdmission: string;
  firstName: string;
  lastName: string;
  birthYear: string;
  focusArea?: string | string[];
  dateRegistrationSuspended?: string;
  status: string;
}

interface StudentContextProps {
  students: Student[];
  dispatch: React.Dispatch<StudentAction>;
}

const initialState: Student[] = JSON.parse(data);

export const StudentContext = createContext<StudentContextProps | undefined>(
  undefined
);

export const StudentProvider = ({ children }: { children: ReactNode }) => {
  const [students, dispatch] = useReducer(studentReducer, initialState);

  return (
    <StudentContext.Provider value={{ students, dispatch }}>
      {children}
    </StudentContext.Provider>
  );
};
