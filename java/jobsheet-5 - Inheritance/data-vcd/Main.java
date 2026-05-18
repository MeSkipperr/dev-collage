//Main.java
import java.util.Scanner;

public class Main {

    public static void main(String[] args) {

        Scanner input = new Scanner(System.in);

        System.out.print("Jumlah data film: ");
        int x = input.nextInt();
        input.nextLine();

        VCDFilm[] film = new VCDFilm[x];

        // Input data
        for (int i = 0; i < x; i++) {

            System.out.println("\nData Film Ke-" + (i + 1));

            System.out.print("Judul      : ");
            String judul = input.nextLine();

            System.out.print("Aktor      : ");
            String aktor = input.nextLine();

            System.out.print("Sutradara  : ");
            String sutradara = input.nextLine();

            System.out.print("Publisher  : ");
            String publisher = input.nextLine();

            System.out.print("Kategori (SU/D/R/A): ");
            String kategori = input.nextLine();

            System.out.print("Stok       : ");
            int stok = input.nextInt();
            input.nextLine();

            film[i] = new VCDFilm(
                    judul,
                    publisher,
                    stok,
                    aktor,
                    sutradara,
                    kategori
            );
        }

        // Tampilkan data
        System.out.println("\n===== DAFTAR VCD FILM =====");

        for (int i = 0; i < x; i++) {
            film[i].tampilData();
        }

        input.close();
    }
}
