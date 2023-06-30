//
// Created by morit on 26.03.2023.
//

#ifndef UNTITLED_ABILITYCHARACTER_H
#define UNTITLED_ABILITYCHARACTER_H


#include "Characters.h"

class AbilityCharacter: public Character {
public:
    AbilityCharacter(string name, Ability* Ability1, Ability* Ability2);
    bool use_first_ability(Character& enemy) override;
    bool use_second_ability(Character& enemy) override;
    virtual ~AbilityCharacter();
private:
    Ability* Ability2;
    Ability* Ability1;

};


#endif //UNTITLED_ABILITYCHARACTER_H
