#pragma once
#include <string>
#include <iostream>
#include <vector>
#include <combaseapi.h>
#include <memory>
#include "Ability.h"

class Ship
{
public:
    const std::string& GetName() const;
    int GetMaxHealth() const;
    int GetHealth() const;
    int GetSize() const;
    int GetDamage() const;

    Ship(std::string name, int maxHealth, int size, int damage);
    virtual ~Ship() = default;

    void AddAbility(std::unique_ptr<Ability> ability);
    void AddHealth(int health);

    const std::unique_ptr<Ship>& ChooseShipToAttack(const std::vector<std::unique_ptr<Ship>>& ships);
    void Attack(const std::unique_ptr<Ship>& otherShip) const;
    void Attacked(const Ship& fromShip, int hitTest, int damage);
private:

    std::unique_ptr<std::string> name;
    int maxHealth;
    int health;
    int size;
    int damage;
    std::vector<std::unique_ptr<Ability>> abilities;
};

