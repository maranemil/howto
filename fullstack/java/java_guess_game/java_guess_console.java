package com.mpxvm.calculator;

import java.util.Objects;
import java.util.Scanner;
import java.util.concurrent.ThreadLocalRandom;


// https://www.youtube.com/watch?v=HuYs2Vp3GtM

public class Main {

    static Integer myNumber = ThreadLocalRandom.current().nextInt(9, 90);
    static Integer tries = 0;

    public static void main(String[] args) {
        nextRound();
    }

    public static void nextRound() {
        tries++;
        Scanner scanner = new Scanner(System.in);
        System.out.println("Give a number");
        Integer number = scanner.nextInt();
        guessNumber(number);
    }

    public static void guessNumber(Integer number) {
        if (Objects.equals(number, myNumber)) {
            System.out.println("equal" + number + " / " + myNumber);
        } else {
            System.out.println("not equal" + number + " / " + myNumber);
            if (number > myNumber) {
                System.out.println("give a small number");
            } else if (number < myNumber) {
                System.out.println("give a bigger number");
            }
            nextRound();
        }
    }
}

