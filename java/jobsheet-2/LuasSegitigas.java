// Buatlah sebuah program untuk menghitung luas segitiga dengan metode
// BufferedReader!

import java.io.BufferedReader;
import java.io.InputStreamReader;

public class LuasSegitigas {

    public static void main(String[] args) {
        BufferedReader input = new BufferedReader(new InputStreamReader(System.in));
        double luas, alas, tinggi;

        try {
            System.out.println("Menghitung Luas Segitiga");

            System.out.print("Masukan Alas Segitiga: ");
            alas = Float.parseFloat(input.readLine());

            System.out.print("Masukan Tinggi Segitiga: ");
            tinggi = Float.parseFloat(input.readLine());

            luas = 0.5f * alas * tinggi;

            System.out.println("Luas Segitiga: " + luas);

        } catch (Exception e) {
            System.out.println("Input tidak valid!");
        }
    }
}
