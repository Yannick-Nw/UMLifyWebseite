//
// Created by morit on 26.03.2023.
//

#ifndef UNTITLED_ABILITY_H
#define UNTITLED_ABILITY_H
#include "Characters.h"
class Character;

class Ability {
public:
    Ability(int mana_cost);
    virtual bool use(Character *enemy, Character *user) = 0;
    virtual int get_mana_cost();

protected:
    int mana_cost;
};


#endif //UNTITLED_ABILITY_H
