

//
// Created by morit on 26.03.2023.
//

#include "Ability.h"
Ability::Ability(int mana_cost) {
    this->mana_cost = mana_cost;
}



int Ability::get_mana_cost() {
    return mana_cost;
}