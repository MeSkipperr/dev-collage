public class Mobil extends Kendaraan {

    private long harga;

    protected String namaClass = "Mobil";

    protected void setHarga(String harga) {
        this.harga = Long.parseLong(harga);
        harga = null;
    }

    protected long getHarga() {
        return harga;
    }

    protected String keterangan() {
        return namaClass + " : Ini adalah class " + namaClass;
    }

    public String keteranganKendaraan() {
        // mengakses atribut/variabel & method parent (class Kendaraan)
        return super.namaClass + " : " + super.keterangan();
    }

    protected void hapus() {
        // menghapus variabel private dari memory
        harga = 0;

        // menghapus variabel parent (class Kendaraan)
        super.hapus();
    }

}