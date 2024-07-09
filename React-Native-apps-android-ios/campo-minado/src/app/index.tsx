import { Text, View, Alert } from "react-native";
import { useState, useEffect } from "react";
import params from "../components/params";
import globalStyles from "../styles/global";
import MineField from "../components/MineField";
import {
  createMinedBoard,
  cloneBoard,
  openField,
  hadExplosion,
  pendding,
  wonGame,
  showMines,
} from "../components/Logic";

export default function Index() {
  const [board, setBoard] = useState([]);
  const [won, setWon] = useState(false);
  const [lost, setLost] = useState(false);

  useEffect(() => {
    const cols = params.getColumnsAmount();
    const rows = params.getRowsAmount();
    const amountOfMines = Math.ceil(cols * rows * params.difficultLevel);
    const newBoard = createMinedBoard(rows, cols, amountOfMines);
    setBoard(newBoard);
    setWon(false);
    setLost(false);
  }, []);

  const onOpenField = (row, column) => {
    const newBoard = cloneBoard(board);
    openField(newBoard, row, column);

    if (hadExplosion(newBoard)) {
      showMines(newBoard);
      setLost(true);
      Alert.alert("Perdeu!", "Que pena, você perdeu!");
    } else {
      const gameWon = wonGame(newBoard);
      setBoard(newBoard);

      if (gameWon) {
        setWon(true);
        Alert.alert("Parabéns!", "Você venceu!");
      }
    }
  };

  return (
    <View style={globalStyles.container}>
      <Text style={globalStyles.welcome}>Bem-vindo ao Campo Minado!</Text>
      <Text>
        Tamanho do Campo: {params.getColumnsAmount()}x{params.getRowsAmount()}
      </Text>
      <View style={globalStyles.container}>
        <MineField board={board} onOpenField={onOpenField} />
      </View>
    </View>
  );
}
