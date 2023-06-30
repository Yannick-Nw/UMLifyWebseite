#pragma once
#include <stdio.h>
#include <memory>
#include <string>

class Ship; // Forward decleration

class Ability
{
public:
    virtual std::string GetName() const = 0;

    // Offensive
    virtual bool HandlePreAttack(const Ship& ship, const std::unique_ptr<Ship>& otherShip, int& hitTest);
    virtual bool HandleAttack(const Ship& ship, const std::unique_ptr<Ship>& otherShip, int hitTest, int& damage);
    virtual bool HandlePostAttack(const Ship& ship, const std::unique_ptr<Ship>& otherShip, bool successfulHit);
    // Defensive
    virtual bool HandleAttacked(const Ship& ship, const Ship& fromShip, int hitTest, int& damage);

    virtual ~Ability() = default;
};

