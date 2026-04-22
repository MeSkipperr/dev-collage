
import java.util.Scanner;

public class PengecekanNilai {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        int biggestValue = 0;
        int totalValue = 0;

        float everageValue;
        try {
            System.out.print("Masukkan jumlah value  minimal 10 : ");

            int amountValue = input.nextInt();
            if (amountValue < 10) {
                System.out.println("Masukan lebih dari 10 ");
                return;
            }

            for (int i = 0; i < amountValue; i++) {
                System.out.print("Angka ke  " + (i+1) +" adalah :");
                int numberInput = input.nextInt();
                if (numberInput > biggestValue) {
                    biggestValue = numberInput;
                }
                totalValue = totalValue + numberInput;
            }

            everageValue = (float) totalValue / amountValue;
            System.out.println("Rata Rata value adalah : " + everageValue);
            System.out.println("Nilai terbesar adalah : " + biggestValue);

        } catch (Exception e) {
            System.out.println("Value Yang di masukan salah");

        }
    }
}
