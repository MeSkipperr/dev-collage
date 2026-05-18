// Main.java
public class Main {
    public static void main(String[] args) {

        Mahasiswa mhs = new Mahasiswa(
                "Budi",
                "budi123",
                "22001"
        );

        Dosen dosen = new Dosen(
                "Pak Andi",
                "andi_dosen",
                "D001"
        );

        mhs.tampilMahasiswa();

        System.out.println();

        dosen.tampilDosen();
    }
}