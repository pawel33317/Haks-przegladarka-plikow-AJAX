#ifndef COMPLEX2_H_INCLUDED
#define COMPLEX2_H_INCLUDED

class Complex
{
public:
    double re;
    double im;
    Complex();
    Complex(double real, double imag);
    ~Complex() {}
    Complex operator+(const Complex & liczba2) const;
    Complex operator-(const Complex & liczba2) const;
    Complex& operator=(const Complex & liczba2);
    Complex& operator+=(const Complex & liczba2);
    Complex& operator-=(const Complex & liczba2);
    Complex operator*(const Complex & liczba2) const;
    Complex operator/(const Complex & liczba2) const;
    Complex& operator/=(const Complex & liczba2);
private:

};


#endif // COMPLEX2_H_INCLUDED
