#pragma once

#include "Ship.h"
#include <vector>
#include <memory>

class World
{
public:
    const std::vector<std::unique_ptr<Ship>>& GetFirstFleet();
    const std::vector<std::unique_ptr<Ship>>& GetSecondFleet();

    World();

    void AddToFirstFleet(std::unique_ptr<Ship> ship);
    void AddToSecondFleet(std::unique_ptr<Ship> ship);
    void RemoveDeadShips();

private:
    std::vector<std::unique_ptr<Ship>> firstFleet;
    std::vector<std::unique_ptr<Ship>> secondFleet;
};

