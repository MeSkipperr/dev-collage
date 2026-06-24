import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        Biodata b = new Biodata();

        System.out.print("Masukkan nama anda: ");
        String nama = input.nextLine();

        System.out.print("Masukkan NIM anda: ");
        String nim = input.nextLine();

        b.setNama(nama);
        b.setNim(nim);

        System.out.println("Nama anda adalah : " + b.getNama());
        System.out.println("NIM anda adalah : " + b.getNim());

        input.close();
    }
}