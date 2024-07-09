import React from "react";
import { View } from "react-native";
import styleFlag from "../styles/styleFlag";

export default function Flag(props) {
  return (
    <View style={styleFlag.container}>
      <View
        style={[
          styleFlag.flagpole,
          props.bigger ? styleFlag.flagpoleBigger : null,
        ]}
      />
      <View
        style={[styleFlag.flag, props.bigger ? styleFlag.flagBigger : null]}
      />
      <View
        style={[styleFlag.base1, props.bigger ? styleFlag.base1Bigger : null]}
      />
      <View
        style={[styleFlag.base2, props.bigger ? styleFlag.base2Bigger : null]}
      />
    </View>
  );
}
