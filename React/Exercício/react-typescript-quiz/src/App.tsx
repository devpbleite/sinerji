import { useEffect } from "react";
import "./App.scss";
import FullPageLoader from "./components/FullPageLoader.tsx";
import Score from "./components/Score/Score.tsx";
import Game from "./components/Game/Game.tsx";
import {
  useQuiz,
  Question,
  QuestionsResponse,
} from "./context/QuizContext.tsx";

function App() {
  const { state, dispatch } = useQuiz();
  //console.log(state);

  // Função para buscar uma nova pergunta da API
  async function fetchQuestion() {
    try {
      // Define o estado do jogo como "fetching" para mostrar o loader
      dispatch({ type: "setStatus", payload: "fetching" });
      // Reseta a resposta do usuário para null
      dispatch({ type: "setUserAnswer", payload: null });
      // Faz a requisição para a API de perguntas
      const response = await fetch(
        "https://opentdb.com/api.php?amount=1&category=18"
      );
      const data: QuestionsResponse = await response.json();
      // Verifica se a resposta da API é válida
      if (data.response_code === 0) {
        // Insere a resposta correta em uma posição aleatória no array de respostas
        const question: Question = data.results[0];

        const randomIndex = Math.round(
          Math.random() * question.incorrect_answers.length
        );
        question.incorrect_answers.splice(
          randomIndex,
          0,
          question.correct_answer
        );
        // Atualiza o estado do jogo para "ready" e define a pergunta atual
        dispatch({ type: "setStatus", payload: "ready" });
        dispatch({ type: "setQuestion", payload: question });
      } else {
        // Caso a API retorne um erro, define o estado do jogo para "error"
        dispatch({ type: "setStatus", payload: "error" });
      }
    } catch (err) {
      console.log("error: ", err);
      // Define o estado do jogo para "error" em caso de falha na requisição
      dispatch({ type: "setStatus", payload: "error" });
    }
  }

  // Hook useEffect para buscar uma pergunta quando o estado do jogo está "idle"
  useEffect(() => {
    if (state.gameStatus == "idle") {
      fetchQuestion();
    }
  });

  return (
    <>
      {state.gameStatus == "fetching" ? (
        <FullPageLoader />
      ) : state.gameStatus == "error" ? (
        <p>Error...</p>
      ) : (
        <>
          <Score />
          <Game />
        </>
      )}
    </>
  );
}

export default App;
