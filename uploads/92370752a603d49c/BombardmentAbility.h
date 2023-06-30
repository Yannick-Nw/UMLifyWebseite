#pragma once
#include "Ability.h"
class BombardmentAbility : public Ability
{
public:
    virtual bool HandleAttack(const Ship& ship, const std::unique_ptr<Ship>& otherShip, int hitTest, int& damage) override;

    // Inherited via Ability
    virtual std::string GetName() const override;
private:
    bool blocked = false;
};

