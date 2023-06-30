#pragma once

#include <stdio.h>
#include <iostream>

#define print(text) std::cout << text << std::endl
#define printLine(text) std::cout << text
#define endLine std::cout << std::endl
#define bold(text) ConsoleColors::Bold() + std::string(text) + ConsoleColors::Reset()
#define italic(text) ConsoleColors::Italic() + std::string(text) + ConsoleColors::Reset()
#define hr "\n--------------------------------------------------------------------------------\n"
#define h1(text) "\n------------------------------- " << italic(bold(text)) << " -------------------------------\n"
#define h2(text) "--- " << bold(text) << " ---"

#define GAME_SPEED 1

#define SHORT_DELAY 2 * GAME_SPEED
#define MEDIUM_DELAY 10 * GAME_SPEED
#define LONG_DELAY 20 * GAME_SPEED

