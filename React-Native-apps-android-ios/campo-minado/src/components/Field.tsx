import React from "react";
import { View, Text, TouchableWithoutFeedback } from "react-native";
import params from "../components/params";
import styleField from "../styles/styleField";
import Mine from "./Mine";
import Flag from "./Flag";

export default function Field(props) {
  const { mined, opened, nearMines, exploded, flagged } = props;

  const styles = [styleField.field];

  if (opened) {
    styles.push(styleField.opened);
  }

  if (exploded) {
    styles.push(styleField.exploded);
  }

  if (flagged) {
    styles.push(styleField.flagged);
  }

  if (!opened && !exploded) {
    styles.push(styleField.regular);
  }

  let color = null;
  if (nearMines > 0) {
    if (nearMines === 1) {
      color = "#2A28D7";
    }
    if (nearMines === 2) {
      color = "#2B520F";
    }
    if (nearMines > 2 && nearMines < 6) {
      color = "#F9060A";
    }
    if (nearMines >= 6) {
      color = "#F221A9";
    }
  }

  return (
    <TouchableWithoutFeedback onPress={props.onOpen}>
      <View style={styles}>
        {!mined && opened && nearMines > 0 ? (
          <Text style={[styleField.label, { color: color }]}>{nearMines}</Text>
        ) : (
          false
        )}

        {mined && opened ? <Mine /> : false}
        {flagged && !opened ? <Flag /> : false}
      </View>
    </TouchableWithoutFeedback>
  );
}
