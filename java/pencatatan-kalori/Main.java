
import java.util.Scanner;

public class Main {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        System.out.println("=================================================");
        System.out.println("       REGISTRASI AWAL: TRACKER KALORI & BB      ");
        System.out.println("=================================================");
        System.out.println("Selamat datang di Aplikasi Tracker Kalori!");
        System.out.println("Silahkan isi data diri Anda terlebih dahulu.\n");

        System.out.println("[Mulai Pengisian Data]");
        System.out.print("> Masukkan Username          : ");
        String nama = input.nextLine();

        System.out.print("> Berat Badan Saat Ini (kg)  : ");
        double bbSekarang = input.nextDouble();

        System.out.print("> Target Berat Badan (kg)    : ");
        double bbTarget = input.nextDouble();

        User pengguna = new User(nama, bbSekarang, bbTarget);

        // Constructor CalorieTracker tidak memiliki parameter
        CalorieTracker tracker = new CalorieTracker();

        System.out.println("\n[Sistem] Memproses data...");
        System.out.println("[Sistem] Profil '" + pengguna.getUsername() + "' berhasil dibuat!");
        System.out.println("[Sistem] Membuka lembar catatan kalori harian baru.");

        int pilihan = 0;

            while (pilihan != 4) {

                int targetTotal = pengguna.getTargetCalories();
                int netKalori = tracker.getNetCalories();

                System.out.println("\n=================================================");
                System.out.println("          APLIKASI TRACKER KALORI & BB           ");
                System.out.println("=================================================");
                System.out.println("Halo " + pengguna.getUsername());
                System.out.println("Berat badan saat ini : " + pengguna.getCurrentWeight() + " kg");
                System.out.println("Target berat badan   : " + pengguna.getTargetWeight() + " kg");
                if (targetTotal > 0) {
                    int sisaKalori = targetTotal - netKalori;
                    System.out.println("Kamu perlu menambah " + sisaKalori
                            + " kkal lagi untuk mencapai target berat badan.");
                } else if (targetTotal < 0) {
                    int sisaKalori = Math.abs(targetTotal) - Math.abs(netKalori);
                    System.out.println("Kamu perlu mengurangi " + sisaKalori
                            + " kkal lagi untuk mencapai target berat badan.");
                } else {
                    System.out.println("Kamu sudah berada pada target berat badan.");
                }

                System.out.println("\nMenu:");
                System.out.println("1. Tambah Kalori Masuk");
                System.out.println("2. Tambah Kalori Keluar");
                System.out.println("3. Lihat Riwayat");
                System.out.println("4. Keluar");

                System.out.print("\nPilihan Anda : ");
                pilihan = input.nextInt();
                input.nextLine();

            switch (pilihan) {

                case 1:
                    System.out.println("\n=== TAMBAH KALORI MASUK ===");

                    System.out.print("Nama Makanan/Minuman : ");
                    String makanan = input.nextLine();

                    System.out.print("Jumlah Kalori (kkal) : ");
                    int kaloriMasuk = input.nextInt();
                    input.nextLine();

                    tracker.addCaloriesIn(makanan, kaloriMasuk);
                    break;

                case 2:
                    System.out.println("\n=== TAMBAH KALORI KELUAR ===");

                    System.out.print("Nama Aktivitas : ");
                    String aktivitas = input.nextLine();

                    System.out.print("Durasi (menit) : ");
                    int durasi = input.nextInt();

                    System.out.print("Kalori Terbakar (kkal) : ");
                    int kaloriKeluar = input.nextInt();
                    input.nextLine();

                    tracker.addCaloriesOut(
                            aktivitas + " (" + durasi + " menit)",
                            kaloriKeluar);
                    break;

                case 3:
                    System.out.println();
                    tracker.displayHistory();

                    int target = pengguna.getTargetCalories();
                    int net = tracker.getNetCalories();

                    System.out.println("Sisa Target Kalori : " + Math.abs(target - net) + " kkal");
                    break;

                case 4:
                    System.out.println("\nTerima kasih telah menggunakan Aplikasi Tracker Kalori!");
                    break;

                default:
                    System.out.println("\nPilihan tidak valid!");
            }
        }

        input.close();
    }
}
