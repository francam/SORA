import java.io.*;
import java.net.*;

public class TCPServer{

  private ServerSocket serverSocket;
  private Socket clientSocket;
  private PrintWriter out;
  private BufferedReader in;

  static boolean isConnected = false;
  static String cmd = "";

  public static void main(String[] args) {
    TCPServer server = new TCPServer();
    server.start(8080);
    while (isConnected = true){
      cmd = server.listen();
      if (cmd == "bye"){
        server.stop();
      }
    }
  }

  public Socket start(int port)
  {
    try {
      serverSocket = new ServerSocket(port);
      clientSocket = serverSocket.accept();
      isConnected = true;

      System.out.println(">> Connected to client");
      out = new PrintWriter(clientSocket.getOutputStream(), true);
    } catch (IOException e){
      e.printStackTrace();
    }
    return clientSocket;
  }

  public void stop()
  {
    try {
      in.close();
      out.close();
      clientSocket.close();
      serverSocket.close();
    } catch (IOException e){
      e.printStackTrace();
    }
    System.out.println(">> Server stopped");
    isConnected = false;
  }

  public String listen()
  {
    String msg = new String();
    try {
      InputStreamReader inputStream = new InputStreamReader(clientSocket.getInputStream());
      in = new BufferedReader(inputStream);
      while ((msg = in.readLine()) != null){
        System.out.println(">> Command: "+ msg);
      }
    } catch (IOException e){
      e.printStackTrace();
    }
    return cmd;
  }
}
