import { createContext, useContext, useReducer } from "react";

// Interface que define a estrutura de uma pergunta
export interface Question {
  category: string;
  type: "multiple" | "boolean"; // Define possible values for 'type'
  difficulty: "easy" | "medium" | "hard"; // Define possible values for 'difficulty'
  question: string;
  correct_answer: string;
  incorrect_answers: string[];
}

// Interface que define a resposta da API de perguntas
export interface QuestionsResponse {
  response_code: number;
  results: Question[];
}

// Interface que define a estrutura do placar
interface Score {
  correct: number;
  incorrect: number;
}

// Interface para o contexto do Quiz, contendo o estado e o dispatch
interface QuizContext {
  state: QuizState;
  dispatch: React.Dispatch<QuizAction>;
}

// Interface que define o estado do Quiz
interface QuizState {
  question: Question | null;
  gameStatus: Status;
  userAnswer: string | null;
  score: Score;
}

// Define os valores possíveis para o estado do jogo
type Status = "idle" | "fetching" | "ready" | "error" | "answered";

// Define as ações possíveis para o dispatch
type QuizAction =
  | { type: "setStatus"; payload: Status }
  | { type: "setQuestion"; payload: Question }
  | { type: "setUserAnswer"; payload: string | null }
  | { type: "setScore"; payload: "correct" | "incorrect" };

// Define o estado inicial do Quiz
const initialState: QuizState = {
  gameStatus: "idle",
  question: null,
  userAnswer: null,
  score: { correct: 0, incorrect: 0 },
};

// Cria o contexto do Quiz com o estado inicial e uma função de dispatch vazia
const QuizContext = createContext<QuizContext>({
  state: initialState,
  dispatch: () => null,
});

// Provedor do contexto do Quiz que envolve os componentes filhos
export function QuizProvider({ children }: { children: React.ReactElement }) {
  // Hook useReducer para gerenciar o estado do Quiz
  const [state, dispatch] = useReducer(QuizReducer, initialState);

  return (
    <QuizContext.Provider value={{ state, dispatch }}>
      {children}
    </QuizContext.Provider>
  );
}

// Hook personalizado para usar o contexto do Quiz
export function useQuiz() {
  return useContext(QuizContext);
}

// Função reducer para atualizar o estado do Quiz com base na ação despachada
function QuizReducer(state: QuizState, action: QuizAction): QuizState {
  switch (action.type) {
    case "setQuestion":
      return { ...state, question: action.payload };
    case "setStatus":
      return { ...state, gameStatus: action.payload };
    case "setUserAnswer":
      return { ...state, userAnswer: action.payload };
    case "setScore":
      const score = state.score;
      score[action.payload] += 1;
      return { ...state, score: score };
    default:
      throw new Error("Unknown action");
  }
}
