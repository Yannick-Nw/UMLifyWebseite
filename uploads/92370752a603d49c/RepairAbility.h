#pragma once
#include "Ability.h"

class RepairAbility : public Ability
{
public:
    virtual bool HandlePostAttack(const Ship& ship, const std::unique_ptr<Ship>& otherShip, bool successfulHit) override;

    // Inherited via Ability
    virtual std::string GetName() const override;
};

