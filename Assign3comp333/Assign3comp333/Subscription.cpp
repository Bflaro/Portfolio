	#include "Subscription.h"

Subscription::Subscription(string distrabutor)
{
	firstPtr = NULL; // no links in list to begin
	noMag = 0;
	distibutorName = distrabutor;

}
void Subscription::addMagazine(string newName, string newIsbn, char newDel)
{
	Magazine* builder = new Magazine;
	assert(builder != NULL);
	builder->name = newName;
	builder->isbn = newIsbn;
	builder->delivery = newDel;

	Magazine* walker = firstPtr;
	Magazine* stalker = NULL;

	if (walker == NULL)//adds to list if there is no other Magazines
	{
		builder->link = firstPtr;
		firstPtr = builder;
		noMag++;
	}
	else
	{
		while (walker != NULL)//case sensitive
		{

			if (walker->name >= newName)
				break;

			stalker = walker;  // everytime walker is on a node that exists we assign stalker there.
			walker = walker->link;
		}

		if (walker != NULL && walker->name == newName)//If the magazine already exists
			cout << "Magazine " << newName << " already on file." << endl << endl;
		else
		{
			builder->link = walker;
			if (walker == firstPtr)//if letter comes before any other magazine already in list
				firstPtr = builder; // put it first
			else
				stalker->link = builder; // otherwise liker the previous link to builder
			noMag++;
		}
	}
}

void Subscription::removeMagazine(string newName) {
	Magazine* walker = firstPtr;
	Magazine* stalker = NULL;

	if (firstPtr == NULL) // checks if Mags arew on fiile
		cout << "No Magazines on File!";
	else
	{
		while (walker != NULL) // finds magazine with name=newName
		{
			if (walker->name == newName)
				break;

			stalker = walker;
			walker = walker->link;
		}
		if (walker == NULL)// if null send msg
			cout << "Magazine does not exist." << endl;
		else //else delete the node and take 1 off of noMag
		{
			if (walker == firstPtr)
				firstPtr = firstPtr->link;
			else
				stalker->link = walker->link;
			delete walker;
			cout << newName << " has been deleted from the record" << endl << endl;
			noMag--;
		}
	}


}

void Subscription::showMagazine(ostream& out)//display
{
	Magazine* walker = firstPtr;
	if (walker == NULL)
		out << "There are no Magazines" << endl;
	else
	{
		out << left << setw(30) << "Magazine Name" << right << setw(30) << "ISBN" << right << setw(30) << "Delivery Type" << endl;
		while (walker != NULL)
		{
			out << left << setw(30) << walker->name << right << setw(30) << walker->isbn << right << setw(30) << walker->delivery << endl;
			walker = walker->link;
		}
	}
}

Subscription::~Subscription()//destructor
{
	Magazine* walker = firstPtr;
	while (firstPtr != NULL)
	{
		walker = walker->link;
		delete firstPtr;
		firstPtr = walker;
	}
}