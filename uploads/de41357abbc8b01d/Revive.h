//
// Created by morit on 26.03.2023.
//

#ifndef UNTITLED_REVIVE_H
#define UNTITLED_REVIVE_H
#include "Ability.h"

class Revive: public Ability{
    public:
        Revive();
        virtual ~Revive();
        bool use(Character *enemy, Character *user);
};


#endif //UNTITLED_REVIVE_H
