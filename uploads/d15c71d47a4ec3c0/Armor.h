
#ifndef UNTITLED_ARMOR_H
#define UNTITLED_ARMOR_H
#include "Ability.h"

class Armor: public Ability {
public:
    Armor();
    virtual ~Armor();
    bool use(Character *enemy, Character* user) override;
};



#endif //UNTITLED_ARMOR_H
