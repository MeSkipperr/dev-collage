public class OperatorPenugasan {
    public static void main(String[] args) {

        int a, b, hasil;

        a = 5;
        b = 10;

        hasil = a = b;
        System.out.println("Hasil dari a = b : " + hasil);

        hasil = a += b;
        System.out.println("Hasil dari a += b : " + hasil);

        hasil = a -= b;
        System.out.println("Hasil dari a -= b : " + hasil);

        hasil = a *= b;
        System.out.println("Hasil dari a *= b : " + hasil);

        hasil = a /= b;
        System.out.println("Hasil dari a /= b : " + hasil);

        hasil = a %= b;
        System.out.println("Hasil dari a %= b : " + hasil);
    }
}