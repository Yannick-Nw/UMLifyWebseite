#include "ConsoleColors.h"
#include "Constants.h"
#include <iostream>
#include <chrono>
#include <thread>
#include <cctype>
#include <vector>

#pragma once


class Common
{
public:
    static void wait(int milliseconds) {
        std::this_thread::sleep_for(std::chrono::milliseconds(milliseconds));
    }
    static void waitForInput() {
        char c;
        std::cin >> c;
    }
    static void waitForInput(std::string message) {
        print(message);
        Common::waitForInput();
    }
    static char getSafeInput(std::vector<char> allowedChars) {
        char input;
        std::cin >> input;

        for (char c : allowedChars) {
            if (std::tolower(input) == std::tolower(c)) {
                std::cout << std::endl;
                return c;
            }
        }

        std::cout << "Invalid input! Choose one of the following: ";

        for (std::vector<char>::const_iterator p = allowedChars.begin(); p != allowedChars.end(); ++p) {
            std::cout << "[" << *p << "]";
            if (p != allowedChars.end() - 1)
                std::cout << ", ";
        }
        std::cout << std::endl;

        return getSafeInput(allowedChars);
    }
};

