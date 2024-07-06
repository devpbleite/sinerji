import { useContext } from "react";
import { StudentContext } from "../context/StudentContext";

const StudentTable = () => {
  const context = useContext(StudentContext);

  if (!context) {
    return null;
  }

  const { students } = context;

  return (
    <div className="container">
      <h1>Students Database</h1>
      <table id="students-table">
        <thead>
          <tr>
            <th>Name</th>
            <th>Age</th>
            <th>Area of Focus</th>
            <th>Registration Status</th>
          </tr>
        </thead>
        <tbody>
          {students.map((student) => (
            <tr key={student.id}>
              <td>{`${student.firstName} ${student.lastName}`}</td>
              <td>{new Date().getFullYear() - parseInt(student.birthYear)}</td>
              <td>
                {Array.isArray(student.focusArea)
                  ? student.focusArea.join(", ")
                  : student.focusArea}
              </td>
              <td>
                {student.dateRegistrationSuspended ? "Inactive" : "Active"}
              </td>
            </tr>
          ))}
        </tbody>
      </table>
    </div>
  );
};

export default StudentTable;
