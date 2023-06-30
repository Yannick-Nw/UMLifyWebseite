#pragma once
#include "Common.h"
#include <string>

namespace Prompts
{
    const std::string Welcome = "Welcome to Fleetfight!";
    const std::string ChooseShip = R"""(    Select | Type      | Health  | Size | Damage | Special Ability
    -------+-----------+---------+------+--------+----------------
      [H]  | Hunter    | 100     | 4    | 60     | Critical Hit
      [D]  | Destroyer | 150     | 6    | 40     | Bombardment
      [T]  | Thorn     | 75      | 6    | 50     | Repair
      [C]  | Cruiser   | 250     | 7    | 25     | Seeker

    (To view more info about special abilities, type [S]))""";
    const std::string AbilitiesInfo = R"""(    - Critical Hit
        When hit test is 9 or 10 the ship does 2x damage!
    - Bombardment
        If the first attack was successful perform an additional attack!
    - Repair:
        Every successful attack the ship heals 10 health points.
    - Seeker
        For more frequent hits, all hit test thresholds are reduced by 2!)""";
};

