import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        System.out.println("=== REGISTRASI ATM ===");

        System.out.print("Masukkan Nama           : ");
        String nama = input.nextLine();

        System.out.print("Masukkan Nomor Rekening : ");
        String norek = input.nextLine();

        System.out.print("Masukkan Saldo Awal     : ");
        double saldo = input.nextDouble();

        RekeningATM atm = new RekeningATM(nama, norek, saldo);

        atm.tampilkanInfo();

        System.out.println("\n=== TRANSAKSI ===");
        System.out.print("Jumlah Setor : ");
        double setor = input.nextDouble();
        atm.setor(setor);

        System.out.print("Jumlah Tarik : ");
        double tarik = input.nextDouble();
        atm.tarik(tarik);

        atm.tampilkanInfo();

        input.close();
    }
}