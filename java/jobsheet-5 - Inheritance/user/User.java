//User.java
class User {

    protected String nama;
    protected String username;

    // Constructor
    public User(String nama, String username) {
        this.nama = nama;
        this.username = username;
    }

    // Method umum
    public void login() {
        System.out.println(username + " berhasil login");
    }
}