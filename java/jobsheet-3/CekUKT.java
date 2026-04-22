
import java.util.Scanner;

public class CekUKT {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        System.out.print("Masukkan Jurusan Anda [Teknik Elektro =1, Teknik Mesin =2] = ");
        int jurusan = input.nextInt();
        switch (jurusan) {
            case 1:
                System.out.println("Jurusan anda Electro");
                break;
            case 2:
                System.out.println("Jurusan anda Mesin");
                break;
            default:
                System.out.println("Jurusan tidak ada");
                return;
        }

        System.out.print("Masukkan Level UKT Anda = ");
        System.out.print("Level: 1, 2, 3, 4, 5 = ");
        int levelUkt = input.nextInt();
        switch (levelUkt) {
            case 1:
                System.out.println("Anda harus membayar UKT sebesar 500.000");
                break;

            case 2:
                System.out.println("Anda harus membayar UKT sebesar 1.000.000");
                break;

            case 3:
                System.out.println("Anda harus membayar UKT sebesar 2.000.000");
                break;

            case 4:
                System.out.println("Anda harus membayar UKT sebesar 2.500.000");
                break;

            case 5:
                System.out.println("Anda harus membayar UKT sebesar 3.000.000");
                break;

            default:
                System.out.println("Pilihan tidak valid");
        }
    }
}
