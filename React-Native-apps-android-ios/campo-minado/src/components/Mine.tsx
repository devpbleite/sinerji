import { View, Text } from "react-native";
import params from "../components/params";
import styleMine from "../styles/styleMine";
import MaterialCommunityIcons from "@expo/vector-icons/MaterialCommunityIcons";

export default function Mine(props) {
  return (
    <View style={styleMine.container}>
      <MaterialCommunityIcons name="mine" size={20} color="black" />
    </View>
  );
}
