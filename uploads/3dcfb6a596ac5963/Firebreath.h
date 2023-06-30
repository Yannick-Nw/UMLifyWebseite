//
// Created by morit on 26.03.2023.
//

#ifndef UNTITLED_FIREBREATH_H
#define UNTITLED_FIREBREATH_H


#include "Ability.h"

class Firebreath: public Ability {
public:
    Firebreath();
    virtual ~Firebreath();
    bool use(Character *enemy, Character* user) override;
};


#endif //UNTITLED_FIREBREATH_H
