package com.mpxvm.calculator;

import javax.swing.*;
import java.awt.event.ActionEvent;
import java.awt.event.ActionListener;
import java.util.Objects;
//import java.util.Scanner;
import java.util.concurrent.ThreadLocalRandom;

// https://www.youtube.com/watch?v=HuYs2Vp3GtM

public class Main {

    static Integer myNumber = ThreadLocalRandom.current().nextInt(9, 90);
    static Integer tries = 0;
    static JLabel text = new JLabel("Give here number");

    public static void main(String[] args) {
        openUI();
    }

    public static void openUI() {
        JFrame frame = new JFrame("UI frame init");
        frame.setSize(400, 300);
        frame.setLocation(10, 0);
        frame.setDefaultCloseOperation(JFrame.EXIT_ON_CLOSE);
        JFrame.setDefaultLookAndFeelDecorated(true);
        // set text
        text.setBounds(0, 50, 200, 20);
        frame.add(text);
        // set text filed input
        JTextField textField = new JTextField();
        textField.setBounds(0, 70, 200, 20);
        frame.add(textField);
        // set text button
        JButton textButton = new JButton("Guess");
        textButton.setBounds(0, 90, 200, 20);
        frame.add(textButton);

        textButton.addActionListener(new ActionListener() {
            @Override
            public void actionPerformed(ActionEvent e) {
                try {
                    String textAction = textField.getText();
                    Integer number = Integer.parseInt(textAction);
                    guessNumber(number);
                } catch (Exception exception) {
                    //throw new RuntimeException("Invalid input");
                    text.setText("Invalid Input Type");
                }
            }
        });

        frame.setLayout(null);
        frame.setVisible(true);

    }

    public static void guessNumber(Integer number) {
        if (Objects.equals(number, myNumber)) {
            text.setText("Your guess is right!");
        } else {
            tries++;
            if (number > myNumber) {
                text.setText("give a small number" + number + " / " + myNumber);
            } else {
                text.setText("give a bigger number" + number + " / " + myNumber);
            }
        }
    }
}

