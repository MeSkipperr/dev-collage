//Mahasiswa.java

class Mahasiswa extends User {

    private String nim;

    public Mahasiswa(
            String nama,
            String username,
            String nim
    ) {

        super(nama, username);

        this.nim = nim;
    }

    public void tampilMahasiswa() {

        System.out.println("=== DATA MAHASISWA ===");
        System.out.println("Nama     : " + nama);
        System.out.println("Username : " + username);
        System.out.println("NIM      : " + nim);

        login();
    }
}