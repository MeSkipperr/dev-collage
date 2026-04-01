public class OperatorLogika {
    public static void main(String[] args) {

        boolean a = true;
        boolean b = false;
        boolean hasil;

        hasil = a && a;
        System.out.println("Hasil dari a && a : " + hasil);

        hasil = a && b;
        System.out.println("Hasil dari a && b : " + hasil);

        hasil = a || b;
        System.out.println("Hasil dari a || b : " + hasil);

        hasil = b || b;
        System.out.println("Hasil dari b || b : " + hasil);

        hasil = !a;
        System.out.println("Hasil dari !a : " + hasil);

        hasil = !b;
        System.out.println("Hasil dari !b : " + hasil);
    }
}