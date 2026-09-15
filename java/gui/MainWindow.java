import javax.swing.*;
import java.awt.*;

public class MainWindow extends JFrame {

  private CustomButton1 button1;
  private CustomTextField1 textField2;

  public MainWindow() {
    setTitle("MainWindow");
    setSize(1024, 768);
    setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
    setLayout(null);

    button1 = new CustomButton1();
    button1.setBounds(2, 693, 1015, 36);
    this.add(button1);

    textField2 = new CustomTextField1();
    textField2.setBounds(3, 183, 180, 36);
    this.add(textField2);

    setLocationRelativeTo(null);
  }
  public static void main(String[] args) {
    SwingUtilities.invokeLater(() -> {
      MainWindow frame = new MainWindow();
      frame.setVisible(true);
    });
  }
}
