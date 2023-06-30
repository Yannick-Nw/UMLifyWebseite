#pragma once
#include "Ability.h"

class CriticalHitAbility : public Ability
{
public:
    bool HandleAttack(const Ship& ship, const std::unique_ptr<Ship>& otherShip, int hitTest, int& damage) override;

    // Inherited via Ability
    virtual std::string GetName() const override;
};

