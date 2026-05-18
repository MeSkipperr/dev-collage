// Dosen.java
class Dosen extends User {

    private String nidn;

    public Dosen(
            String nama,
            String username,
            String nidn
    ) {

        super(nama, username);

        this.nidn = nidn;
    }

    public void tampilDosen() {

        System.out.println("=== DATA DOSEN ===");
        System.out.println("Nama     : " + nama);
        System.out.println("Username : " + username);
        System.out.println("NIDN     : " + nidn);

        login();
    }
}
