
public class Array2Dimensi {

    public static void main(String[] args) {
        String[][] array2D = {
            {"Adi", "Mika","Budi","Bunga"},
            {"127647", "129883", "120495", "123489"},
            {"Teknik Informatika", "Sistem Komputer", "Sistem Komputer","Teknik Informatika"}
        };

        System.out.println("Tabel Data Mahasiswa:");
        System.out.println("Nama | NIM | Jurusan");
        System.out.println("---------------------");
        for (int j = 0; j < array2D[0].length; j++) {
            System.out.println(array2D[0][j] + " | " + array2D[1][j] + " | " + array2D[2][j]);
        }
    }
}
