import java.io.*;
import java.net.*;

public class TCPServer{

  static ServerSocket socket;
  static int port = 8080;
  static Socket connection;
  static String input = new String();
  static String output = new String();
  boolean isConneted = false;

  public static void main(String[] args)
  {
    init();
  }

  public static void init()
  {
    System.out.println(">> Starting Server:");
    try {
      socket = new ServerSocket(port);

      while(true){
        connection = socket.accept();
        System.out.println(">> Client Connected");

        InputStreamReader inputStream = new InputStreamReader(connection.getInputStream());
        BufferedReader in = new BufferedReader(inputStream);
        String cmd = new String();
        cmd = in.readLine();

        System.out.println(">> cmd: " + cmd);
        System.out.println(">> Sending confirmation");

        PrintStream response = new PrintStream(connection.getOutputStream());

        response.println(cmd);

      }
    } catch (IOException e){
      e.printStackTrace();
    }
  }
}
