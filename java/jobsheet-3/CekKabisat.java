
import java.util.Scanner;

public class CekKabisat {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        System.out.print("Masukkan tahun (1900 - 2020): ");
        int tahun = input.nextInt();

        if (tahun < 1900) {
            System.out.println("Tahun bawah 1900");
            return;
        }else if (tahun > 2020) {
            System.out.println("Tahun diatas 2020");
            return;
        }
        if ((tahun % 4 == 0 && tahun % 100 != 0) || (tahun % 400 == 0)) {
            System.out.println(tahun + " adalah tahun kabisat");
        } else {
            System.out.println(tahun + " bukan tahun kabisat");
        }
    }
}
