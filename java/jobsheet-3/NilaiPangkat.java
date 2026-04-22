
import java.util.Scanner;

public class NilaiPangkat {

    public static void main(String[] args) {
        Scanner input = new Scanner(System.in);

        
        System.out.println("Masukan nilai bilangan : ");
        int nilaiBilangan = input.nextInt(); 
        System.out.println("Masukan nilai pangkat : ");
        int nilaiPangkat = input.nextInt() ;
        System.out.println("Hasil pangkat : " + ((int) Math.pow(nilaiBilangan, nilaiPangkat)));
    }
}
