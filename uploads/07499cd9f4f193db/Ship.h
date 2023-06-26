#ifndef INC_7_FLOTTENKAMPF_SHIP_H
#define INC_7_FLOTTENKAMPF_SHIP_H


#include <string>

class Ship {
public:
    enum ShipType { JAGER, ZERSTORER, KREUZER };

    Ship(ShipType type);

    virtual void attack(Ship& target);

    int getHull() const;

protected:
    static std::string shipTypeToString(ShipType type);

private:
    ShipType type;
    int hull;
    int size;
    int damage;
    std::string special;

    int rollDice(int sides);
};


#endif //INC_7_FLOTTENKAMPF_SHIP_H
