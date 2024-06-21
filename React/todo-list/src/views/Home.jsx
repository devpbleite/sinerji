import Filter from "../components/Filter/Filter.jsx";
import TodosList from "../components/TodosList.jsx";

function Home() {
  return (
    <>
      <div className="container">
        <Filter />

        <TodosList />
      </div>
    </>
  );
}

export default Home;
