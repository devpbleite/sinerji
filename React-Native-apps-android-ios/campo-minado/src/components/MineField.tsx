import { View } from "react-native";
import React from "react";
import Field from "./Field";
import styleMineField from "../styles/styleMineField";

export default function MineField(props) {
  const rows = props.board.map((row, rowIndex) => {
    const columns = row.map((field, columnIndex) => {
      return (
        <Field
          {...field}
          key={columnIndex}
          onOpen={() => props.onOpenField(rowIndex, columnIndex)}
        />
      );
    });
    return (
      <View style={{ flexDirection: "row" }} key={rowIndex}>
        {columns}
      </View>
    );
  });

  return <View style={styleMineField.container}>{rows}</View>;
}
