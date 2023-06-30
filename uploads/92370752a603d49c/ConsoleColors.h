#pragma once
#include <string>

class ConsoleColors {
public:
    static constexpr const char* Black() {
        return "\033[0;30m";
    }

    static constexpr const char* Red() {
        return "\033[0;31m";
    }

    static constexpr const char* Green() {
        return "\033[0;32m";
    }

    static constexpr const char* Yellow() {
        return "\033[0;33m";
    }

    static constexpr const char* Blue() {
        return "\033[0;34m";
    }

    static constexpr const char* Magenta() {
        return "\033[0;35m";
    }

    static constexpr const char* Cyan() {
        return "\033[0;36m";
    }

    static constexpr const char* White() {
        return "\033[0;37m";
    }

    static constexpr const char* BackgroundBlack() {
        return "\033[0;40m";
    }

    static constexpr const char* BackgroundRed() {
        return "\033[0;41m";
    }

    static constexpr const char* BackgroundGreen() {
        return "\033[0;42m";
    }

    static constexpr const char* BackgroundYellow() {
        return "\033[0;43m";
    }

    static constexpr const char* BackgroundBlue() {
        return "\033[0;44m";
    }

    // Formatting options
    static constexpr const char* Bold() {
        return "\033[1m";
    }

    static constexpr const char* Italic() {
        return "\033[3m";
    }

    static constexpr const char* Underline() {
        return "\033[4m";
    }

    static constexpr const char* Reset() {
        return "\033[0m";
    }
};
