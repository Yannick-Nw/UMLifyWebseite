
#include <iostream>
#include <vector>
#include "Ship.h"
#include "World.h"

#pragma once

#define fleet std::vector<std::unique_ptr<Ship>>

class Game
{
public:
    Game();

    void Start();
private:
    int GameLoop(int roundNum = 1) const;
    void PrintStats() const;

    std::unique_ptr<Ship> ChooseShip(bool repeated = false) const;

    std::unique_ptr<World> world;
    fleet fleet1;
    fleet fleet2;
};

