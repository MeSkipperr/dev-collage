import java.util.Scanner;

public class Novel extends Buku {

    private String genre;
    private int jumlahHalaman;
    private int jumlahData;

    Scanner input = new Scanner(System.in);

    // Input data novel
    public void inputNovel() {
        System.out.print("Genre Buku : ");
        genre = input.nextLine();

        System.out.print("Jumlah Halaman : ");
        jumlahHalaman = input.nextInt();
        input.nextLine();
    }

    // Menampilkan data novel
    public void tampilNovel() {
        tampilBuku();

        System.out.println("Genre : " + genre);
        System.out.println("Jumlah Halaman : " + jumlahHalaman);
    }

    // Override kategori
    @Override
    public void kategori() {
        System.out.println("Kategori : Novel");
    }

    // Status buku berdasarkan jumlah halaman
    public void statusBuku() {

        if (jumlahHalaman > 300) {
            System.out.println("Status : Novel Panjang");
        } else {
            System.out.println("Status : Novel Pendek");
        }
    }

    // Proses input banyak data
    public void prosesData() {

        System.out.print("Masukkan jumlah data buku : ");
        jumlahData = input.nextInt();
        input.nextLine();

        for (int i = 1; i <= jumlahData; i++) {

            System.out.println("\nInput Data Buku Ke-" + i);

            inputBuku();
            inputNovel();

            System.out.println("\nData Buku Ke-" + i);

            tampilNovel();
            kategori();
            statusBuku();
        }
    }
}