// Buatlah program input dan output yang berisi data diri anda / data diri
// mahasiswa dengan JoptionPane!

import javax.swing.JOptionPane;

public class InputDataDiri {
    public static void main(String[] args) {
        String nama = JOptionPane.showInputDialog("Nama : ");
        String nim = JOptionPane.showInputDialog("NIM : ");
        String kelas = JOptionPane.showInputDialog("Kelas : ");

        String msg = "Nama saya : " + nama + " dengan nim " + nim + " di kelas " + kelas ;

        JOptionPane.showMessageDialog(null, msg);

        
    }
}
