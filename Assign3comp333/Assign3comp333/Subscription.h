#include <iostream>
#include <iomanip>
#include <string>
#include <cassert>
//Braxton Flaro

using namespace std;

struct Magazine
{
	string name;
	string isbn;
	char delivery;
	Magazine* link;

};
class Subscription
{
public:
	Subscription(string /*distrabutor*/);
	~Subscription();
	void showMagazine(ostream&);
	void addMagazine(string /*name*/, string /*isbn*/, char /*delivery*/);
	void removeMagazine(string /*name*/);
	int getNoMagazines() const { return noMag; };
	string getDistributorName()const { return distibutorName; };
private:
	Magazine* firstPtr;
	string distibutorName;
	int noMag;
};