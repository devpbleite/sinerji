public class DesafioFor {

  public static void main(String[] args) {

    String hashtag = "#";

    for (String i = "#"; !i.equals("######"); i += "#") {
      System.out.println(hashtag);
      hashtag += "#";

    }
  }
}
