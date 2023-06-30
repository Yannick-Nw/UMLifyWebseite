//
// Created by morit on 27.03.2023.
//

#ifndef FLIGHT_CLUB_POTION_H
#define FLIGHT_CLUB_POTION_H

#include "Ability.h"

class Potion: public Ability {
public:
    Potion();
    virtual ~Potion();
    bool use(Character *enemy, Character* user) override;
};


#endif //FLIGHT_CLUB_POTION_H
