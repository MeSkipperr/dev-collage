class MusikPop {
    private String judulLagu;

    // Hanya dapat diakses oleh kelas ini dan turunannya
    protected void setJudul(String nama) {
        judulLagu = nama;
    }

    protected String getJudul() {
        return judulLagu;
    }
}

class MusikJPop extends MusikPop {
    private int tahunTerbit;

    // Constructor
    public MusikJPop(String judul, int tahun) {
        // judulLagu = judul; // SALAH, karena private

        setJudul(judul); // menggunakan method protected
        tahunTerbit = tahun;
    }

    public void showData() {
        System.out.println("Judul Lagu   : " + getJudul());
        System.out.println("Tahun Terbit : " + tahunTerbit);
    }
}

class MusikJazz {
    private String penyanyi;

    public void setPenyanyi(String nama) {
        /*
         * setJudul("Indonesia Raya");
         * SALAH, karena MusikJazz bukan turunan dari MusikPop
         */
        penyanyi = nama;
    }

    public String getPenyanyi() {
        return penyanyi;
    }

    public void showPenyanyi() {
        /*
         * System.out.println(getJudul());
         * SALAH, karena getJudul() tidak dikenal di sini
         */
        System.out.println("Penyanyi : " + penyanyi);
    }
}

public class DemoEnkapsulasi {
    public static void main(String[] args) {

        // Instansiasi objek MusikJPop
        MusikJPop obj = new MusikJPop("I Feel My Soul", 2008);

        obj.showData();

        // Karena berada dalam package yang sama,
        // method protected masih dapat diakses
        obj.setJudul("First Love");

        System.out.println("Judul lagu : " + obj.getJudul());
    }
}