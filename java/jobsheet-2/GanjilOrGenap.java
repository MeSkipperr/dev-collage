
import java.util.Scanner;


// Buatlah sebuah program untuk menampilkan bilangan genap dan ganjil
// dengan menggunakan metode Scanner!


public  class GanjilOrGenap {
    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        System.out.print("Masukan angka untuk mengecek genap / ganjil : ");
        try {
            if(input.nextInt() % 2 == 0 ){
                System.out.println("Bilangan Anda Adalah Genap");
            }else {
                System.out.println("Bilangan Anda Adalah Ganjil");
            }
            
        } catch (Exception e) {

                System.out.println("Value tidak valid");

        }
    }
}