#include "complex2.h"
#include <iostream>
/* Dokończyć operator '/'
 * Napisać operatory:
 *      *=
 *      /=
 * Pobawić się funkcjami zaprzyjaźnionymi
 */

Complex::Complex()
{
    re=0;
    im=0;
}
Complex::Complex(double real, double imag)
{
    this->re=real;
    this->im=imag;
}
Complex Complex::operator+(const Complex & liczba2) const
{
    Complex wynik;
    wynik.re = this->re + liczba2.re;
    wynik.im = this->im + liczba2.im;
    return wynik;
}
Complex Complex::operator-(const Complex & liczba2) const
{
    Complex wynik;
    wynik.re = this->re - liczba2.re;
    wynik.im = this->im - liczba2.im;
    return wynik;
}
Complex& Complex::operator=(const Complex & liczba2)
{
    this->re=liczba2.re;
    this->im=liczba2.im;
    return *this;
}
Complex& Complex::operator+=(const Complex & liczba2)
{
    this->re=liczba2.re+this->re;
    this->im=liczba2.im+this->im;
    return *this;
}
Complex& Complex::operator-=(const Complex & liczba2)
{
    this->re=this->re-liczba2.re;
    this->im=this->im-liczba2.im;
    return *this;
}
Complex Complex::operator*(const Complex & liczba2) const
{
    Complex wynik;
    wynik.re=this->re*liczba2.re-this->im*liczba2.im;
    wynik.im=this->re*liczba2.im+this->im*liczba2.re;
    return wynik;
}
Complex Complex::operator/(const Complex & liczba2) const
{
    Complex wynik;
    wynik.re=(this->re*liczba2.re+this->im*liczba2.im)/(liczba2.re*liczba2.re+liczba2.im*liczba2.im);
    wynik.im=-(this->re*liczba2.im-this->im*liczba2.re)/(liczba2.re*liczba2.re+liczba2.im*liczba2.im);
    return wynik;
}
Complex& Complex::operator/=(const Complex & liczba2){
    double temp = this->re;
    this->re = (this->re*liczba2.re+this->im*liczba2.im)/(liczba2.re*liczba2.re+liczba2.im*liczba2.im);
    this->im = -(temp*liczba2.im-this->im*liczba2.re)/(liczba2.re*liczba2.re+liczba2.im*liczba2.im);
    return *this;
}

ostream & operator<<(ostream & o,Complex &obiekt){
    o << "Re: " obiekt.re << " Im: " <<  obiekt.im;
    return o;
}
