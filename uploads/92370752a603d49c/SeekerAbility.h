#pragma once
#include "Ability.h"

class SeekerAbility : public Ability
{
public:
    virtual bool HandlePreAttack(const Ship& ship, const std::unique_ptr<Ship>& otherShip, int& hitTest) override;

    // Inherited via Ability
    virtual std::string GetName() const override;
};

