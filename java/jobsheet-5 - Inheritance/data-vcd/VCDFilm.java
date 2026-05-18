//VCDFilm.java
class VCDFilm extends VCD {
    private String aktor;
    private String sutradara;
    private String kategori;

    public VCDFilm(
            String judul,
            String publisher,
            int stok,
            String aktor,
            String sutradara,
            String kategori
    ) {
        super(judul, publisher, stok);
        this.aktor = aktor;
        this.sutradara = sutradara;
        this.kategori = kategori;
    }

    public String getKategori() {
        switch (kategori.toUpperCase()) {
            case "SU":
                return "Semua Umur";
            case "D":
                return "Dewasa";
            case "R":
                return "Remaja";
            case "A":
                return "Anak-anak";
            default:
                return "Tidak Diketahui";
        }
    }

    public void tampilData() {
        tampilDataDasar();

        System.out.println("Aktor     : " + aktor);
        System.out.println("Sutradara : " + sutradara);
        System.out.println("Kategori  : " + getKategori());

        System.out.println("--------------------------------");
    }
}
