#include "Subscription.h"

//Client code for linked list lecture

int main()
{
	Subscription* mags = new Subscription("SLC Library");
	assert(mags != NULL);
	cout << "Distrabutor Name: " << mags->getDistributorName() << endl;

	mags->addMagazine("National Goegraphic", "3285-2345-439", 'W');
	mags->addMagazine("The Daily News", "8934-3495-937", 'D');
	mags->addMagazine("TIME", "8457-3489-809", 'M');
	mags->addMagazine("National Goegraphic", "3285-2345-439", 'W');
	mags->addMagazine("F1Formula", "4353-4896-538", 'M');
	mags->addMagazine("AARP", "3570-3657-356", 'D');
	mags->addMagazine("Entertainment Weekly", "5637-4398-431", 'W');

	mags->showMagazine(cout);
	cout << "Number of magazines: " << mags->getNoMagazines() << endl << endl;;

	mags->removeMagazine("The Daily News");
	mags->removeMagazine("AARP");

	cout << "Distrabutor Name: " << mags->getDistributorName() << endl;
	mags->showMagazine(cout);
	cout << "Number of magazines: " << mags->getNoMagazines() << endl;
	mags->~Subscription();
}