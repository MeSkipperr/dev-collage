import java.util.ArrayList;

public class CalorieTracker {
    private int totalCaloriesIn;
    private int totalCaloriesOut;
    private ArrayList<String> historyLogs;

    public CalorieTracker() {
        this.totalCaloriesIn = 0;
        this.totalCaloriesOut = 0;
        this.historyLogs = new ArrayList<>();
    }

    public void addCaloriesIn(String namaMakanan, int calories) {
        this.totalCaloriesIn += calories;
        this.historyLogs.add("[Masuk] " + namaMakanan + " : " + calories + " kkal");
        System.out.println("Berhasil mencatat +" + calories + " kkal dari " + namaMakanan + ".");
    }

    public void addCaloriesOut(String namaAktivitas, int calories) {
        this.totalCaloriesOut += calories;
        this.historyLogs.add("[Keluar] " + namaAktivitas + " : " + calories + " kkal");
        System.out.println("Berhasil mencatat -" + calories + " kkal terbakar dari " + namaAktivitas + ".");
    }

    public int getNetCalories() {
        return this.totalCaloriesIn - this.totalCaloriesOut;
    }

    public void displayHistory() {
        System.out.println("=== RIWAYAT AKTIVITAS KALORI ===");
        
        if (historyLogs.isEmpty()) {
            System.out.println("Belum ada data aktivitas hari ini.");
        } else {
            for (int i = 0; i < historyLogs.size(); i++) {
                System.out.println((i + 1) + ". " + historyLogs.get(i));
            }
        }
        
        System.out.println("================================");
        System.out.println("Total Kalori Masuk  : " + this.totalCaloriesIn + " kkal");
        System.out.println("Total Kalori Keluar : " + this.totalCaloriesOut + " kkal");
        System.out.println("Net Kalori Hari Ini : " + getNetCalories() + " kkal");
    }
}