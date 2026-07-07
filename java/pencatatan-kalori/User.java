public class User {

    private String username;
    private double currentWeight;
    private double targetWeight;

    public User(String username, double currentWeight, double targetWeight) {
        this.username = username;
        this.currentWeight = currentWeight;
        this.targetWeight = targetWeight;
    }

    public String getUsername() {
        return username;
    }

    public double getCurrentWeight() {
        return currentWeight;
    }

    public double getTargetWeight() {
        return targetWeight;
    }

    public int getTargetCalories() {
        return (int) ((targetWeight - currentWeight) * 7700);
    }

}