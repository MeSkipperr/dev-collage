public class OperatorBitwise {
    public static void main(String[] args) {

        int a = 181;
        int b = 108;
        int hasil;

        // AND
        hasil = a & b;
        System.out.println("Hasil dari a & b : " + hasil);

        // OR
        hasil = a | b;
        System.out.println("Hasil dari a | b : " + hasil);

        // XOR
        hasil = a ^ b;
        System.out.println("Hasil dari a ^ b : " + hasil);

        // NOT / Complement
        hasil = ~a;
        System.out.println("Hasil dari ~a : " + hasil);

        // Shift Right
        hasil = a >> 1;
        System.out.println("Hasil dari a >> 1 : " + hasil);

        // Shift Left
        hasil = b << 2;
        System.out.println("Hasil dari b << 2 : " + hasil);
    }
}