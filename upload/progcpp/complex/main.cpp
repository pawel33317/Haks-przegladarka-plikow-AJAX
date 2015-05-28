#include <iostream>
#include "complex2.h"
using namespace std;

int main()
{
    Complex liczba1(11,7);
    Complex liczba2(0,0);
    liczba1=liczba1/liczba2;
    cout << "Czesc rzeczywista: " << liczba1.re << "\nCzesc urojona: " << liczba1.im << endl;
    return 0;
}
