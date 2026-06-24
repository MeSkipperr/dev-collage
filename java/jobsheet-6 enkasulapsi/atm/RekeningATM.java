
public class RekeningATM {

    private String nama;
    private String nomorRekening;
    private double saldo;

    public RekeningATM(String nama, String nomorRekening, double saldo) {
        this.nama = nama;
        this.nomorRekening = nomorRekening;
        this.saldo = saldo;
    }

    public String getNama() {
        return nama;
    }

    public String getNomorRekening() {
        return nomorRekening;
    }

    public double getSaldo() {
        return saldo;
    }

    public void setor(double jumlah) {
        if (jumlah > 0) {
            saldo += jumlah;
            System.out.println("Setor berhasil.");
        } else {
            System.out.println("Jumlah setor tidak valid.");
        }
    }

    public void tarik(double jumlah) {
        if (jumlah > saldo) {
            System.out.println("Saldo tidak mencukupi.");
        } else if (jumlah > 0) {
            saldo -= jumlah;
            System.out.println("Penarikan berhasil.");
        } else {
            System.out.println("Jumlah tarik tidak valid.");
        }
    }

    public void tampilkanInfo() {
        System.out.println("\n=== DATA REKENING ===");
        System.out.println("Nama            : " + nama);
        System.out.println("Nomor Rekening  : " + nomorRekening);
        System.out.printf("Saldo : Rp %,.0f%n", saldo);
    }
}
