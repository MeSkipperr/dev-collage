import java.util.Scanner;

public class Buku {

    protected String judul;
    protected String penulis;
    protected int tahunTerbit;

    Scanner input = new Scanner(System.in);

    // Method input data buku
    public void inputBuku() {

        System.out.print("Judul Buku : ");
        judul = input.nextLine();

        System.out.print("Penulis Buku : ");
        penulis = input.nextLine();

        System.out.print("Tahun Terbit : ");
        tahunTerbit = input.nextInt();
        input.nextLine();
    }

    // Method tampil data buku
    public void tampilBuku() {

        System.out.println("Judul Buku : " + judul);
        System.out.println("Penulis Buku : " + penulis);
        System.out.println("Tahun Terbit : " + tahunTerbit);
    }

    // Method kategori
    public void kategori() {
        System.out.println("Kategori Buku");
    }
}