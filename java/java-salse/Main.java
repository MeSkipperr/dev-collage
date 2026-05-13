import java.util.Scanner;

public class Main {
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);

        System.out.println("Program Mengetahui Bonus Sales");

        System.out.print("Nama: ");
        String nama = sc.nextLine();

        System.out.print("Jumlah minggu: ");
        int minggu = sc.nextInt();

        Sales s = new Sales(nama, minggu);
        s.input();
        s.tampil();

        sc.close();
    }
}