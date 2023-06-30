//
// Created by morit on 26.03.2023.
//

#ifndef UNTITLED_CHARACTERS_H
#define UNTITLED_CHARACTERS_H
#include "string"
#include "iostream"
#include "Ability.h"

class Ability;
using namespace std;

class Character {
public:
    Character(int lives, string name, int damage, int mana);
    virtual bool use_first_ability(Character& enemy) = 0;
    virtual bool use_second_ability(Character& enemy) = 0;
    void take_damage(int amount);
    void do_damage(Character& Enemy);
    int get_lives() const;
    void set_lives(int new_lives);
    int get_mana() const;
    void set_mana(int new_mana);
    string name;
    bool fire;
    bool armor;
protected:
        int lives;
        int damage;
        int mana;
};


#endif //UNTITLED_CHARACTERS_H
