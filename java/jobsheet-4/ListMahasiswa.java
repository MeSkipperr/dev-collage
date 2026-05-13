
public class ListMahasiswa {
    public static void main(String[] args) {
        // String[] mahasiswa = {"Alice", "Bob", "Charlie", "David"};
        // for (String name : mahasiswa) {
        //     System.out.println(name);
        // }

        String[] mahasiswa = new String[5];

        mahasiswa[0] = "Alice";
        mahasiswa[1] = "Bob";
        mahasiswa[2] = "Charlie";
        mahasiswa[3] = "David";
        mahasiswa[4] = "Eve";  

        System.out.println("Daftar Mahasiswa:");
        System.out.println("mahasiswa[0] : " + mahasiswa[0]);
        System.out.println("mahasiswa[1] : " + mahasiswa[1]);
        System.out.println("mahasiswa[2] : " + mahasiswa[2]);
        System.out.println("mahasiswa[3] : " + mahasiswa[3]);
        System.out.println("mahasiswa[4] : " + mahasiswa[4]);

        for (int i = 0; i < mahasiswa.length; i++) {
            System.out.println("mahasiswa[" + i + "] : " + mahasiswa[i]);
        }
        
    }
}
