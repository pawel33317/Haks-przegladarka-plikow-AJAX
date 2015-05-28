#include <stdio.h>
#include <iostream>
#include <math.h>

using namespace std;

class Complex
{
private:
  double Real, Imag;
public:
    Complex ():Real (0), Imag (0)
  {
  };

  Complex (double co)
  {
    this->Real = co;
    this->Imag = 0;
  };

  Complex (double Real, double Imag)
  {
    this->Real = Real;
    this->Imag = Imag;
  };

  Complex & operator= (const Complex & s)
  {                                    
    this->Real = s.Real;
    this->Imag = s.Imag;
    return *this;
  };

  Complex operator- () const
  {
    return Complex(-this->Real,-this->Imag);
  };

  Complex & operator= (double co)
  {
    this->Real = co;
    this->Imag = 0;
    return *this;
  };
/*
  Complex operator+ (const Complex& co) const 
								
  {						
    Complex n;					
    n.Real = this->Real + co.Real;
    n.Imag = this->Imag + co.Imag;
    return n;
  };
 
  Complex operator- (const Complex& co) const
          
  {						
    Complex n;					
    n.Real = this->Real - co.Real;
    n.Imag = this->Imag - co.Imag;
    return n;
  };
*/  
  
  Complex operator* (const Complex & co) const
  {
    Complex n;
    n.Real = this->Real * co.Real - this->Imag * co.Imag;
    n.Imag = this->Real * co.Imag + this->Imag * co.Real;
    return n;
  };
  
  Complex operator/ (const Complex& co) const 
  {
    Complex n;
    n.Real = ( co.Real * this->Real + co.Imag * this->Imag)/pow((sqrt((co.Real*co.Real)+(co.Imag*co.Imag))), 2);
    n.Imag = ( co.Imag * this->Real - co.Real * this->Imag)/pow((sqrt((co.Real*co.Real)+(co.Imag*co.Imag))), 2);
    return n;
  };
  
      double modul () const 
  {
    double n;
    n=sqrt((this->Real*this->Real)+(this->Imag*this->Imag));
    printf("Modul = %f", n);
    return n;
  };
  
      bool operator== (const Complex & co) const 
  {
    if((Real==co.Real)&&(Imag==co.Imag))
    {
      printf("Liczby sa rowne");
	return true;
      }
      else
      {
          printf("liczby nie sa rowne");
		return false;
          }
          };
  

  Complex & operator+= (Complex co)
  {
    this->Real += co.Real;
    this->Imag += co.Imag;
    return *this;
  };

  Complex & operator-= (Complex co)
					
  {
    this->Real -= co.Real;
    this->Imag -= co.Imag;
    return *this;
  };
 

  
  friend ostream & operator << (ostream & s, const Complex & c)
  {                                                            
    s << "(" << c.Real << ", " << c.Imag << "i)";
    return s;
  };
};


Complex operator - (Complex s1, Complex s2)
{
  Complex n (s1);
  return n -= s2;
}

Complex operator + (Complex s1, Complex s2)
{
  Complex n (s1);
  return n += s2;
}

int main()
{
  Complex a(2,3),b(3,3),c;
  c = 10;
  cout << c <<endl;
  
  a.modul();
  cout << c <<endl;
  
  c = -a;
  cout << c <<endl;  
  
  c=a-b;
  cout << c <<endl;
  
  c=5-b;
  cout << c <<endl;
  
  c = a * b;
  cout << c <<endl;
  c = c - Complex(10);
  cout << c <<endl;  
  	

  getchar();
}

