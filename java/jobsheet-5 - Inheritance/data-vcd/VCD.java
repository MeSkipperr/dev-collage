//VCD.java

class VCD {
    protected String judul;
    protected String publisher;
    protected int stok;

    public VCD(String judul, String publisher, int stok) {
        this.judul = judul;
        this.publisher = publisher;
        this.stok = stok;
    }

    public void tampilDataDasar() {
        System.out.println("Judul     : " + judul);
        System.out.println("Publisher : " + publisher);
        System.out.println("Stok      : " + stok);
    }
}
