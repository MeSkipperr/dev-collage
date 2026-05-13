
import java.util.Scanner;

class Sales {

    String nama;
    int[] jual;

    // Constructor
    Sales(String nama, int minggu) {
        this.nama = nama;
        this.jual = new int[minggu];
    }

    // Input penjualan per minggu
    void input() {
        Scanner sc = new Scanner(System.in);
        for (int i = 0; i < jual.length; i++) {
            System.out.print("Minggu ke-" + (i + 1) + ": ");
            jual[i] = sc.nextInt();
        }
    }

    // Hitung total penjualan
    int total() {
        int t = 0;
        for (int j : jual) {
            t += j;
        }
        return t;
    }

    // Hitung bonus
    int bonus() {
        int t = total();
        if (t >= 50) {
            return 500000;
        } else if (t >= 30) {
            return 300000;
        } else if (t >= 10) {
            return 100000;
        } else {
            return 0;
        }
    }

    // Tampilkan hasil
    void tampil() {
        System.out.println("\nNama: " + nama);
        System.out.println("Total Penjualan: " + total());
        System.out.println("Bonus: " + bonus());
    }

    // Main method untuk testing
    public static void main(String[] args) {
        Scanner sc = new Scanner(System.in);

        System.out.print("Masukkan nama sales: ");
        String nama = sc.nextLine();

        System.out.print("Masukkan jumlah minggu: ");
        int minggu = sc.nextInt();

        Sales s = new Sales(nama, minggu);
        s.input();
        s.tampil();
    }
}
