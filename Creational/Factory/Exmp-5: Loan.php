<?php
public abstract class Loan {
    protected double interestRate;

    abstract double getInterestRate();

    public double calculateInterest(int loanAmount){
        return loanAmount * (getInterestRate() / 100);
    }
}

public class HomeLoan extends Loan {
    @Override
    double getInterestRate() {
        return 8;
    }
}

public class CarLoan extends Loan {
    @Override
    double getInterestRate() {
        return 9;
    }
}

public enum  LoanType {public class LoanFactory {
    public Loan getLoan(LoanType loanType) {
        switch (loanType) {
            case CAR:
                return new CarLoan();
            case HOME:
                return new HomeLoan();

                default:
                    return null;
        }
    }
}
    HOME, CAR;
}

public class LoanFactory {
    public Loan getLoan(LoanType loanType) {
        switch (loanType) {
            case CAR:
                return new CarLoan();
            case HOME:
                return new HomeLoan();

                default:
                    return null;
        }
    }
}

public class Main {
    public static void main(String[] args) {
        LoanFactory loanFactory = new LoanFactory();

        Loan homeLoan = loanFactory.getLoan(LoanType.HOME);
        System.out.println(homeLoan.calculateInterest(1000));

        Loan carLoan = loanFactory.getLoan(LoanType.CAR);
        System.out.println(carLoan.calculateInterest(1000));
    }

}
