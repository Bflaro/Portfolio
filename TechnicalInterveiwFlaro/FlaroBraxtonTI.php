<?php
// http://localhost/TechnicalInterveiwFlaro/FlaroBraxtonTI.php 
//main file
//Purpose: Techincal Interview to calculate the amount of money spent over the lifespan of an old furnace up to its replacement
date_default_timezone_set('America/Toronto');      
$oldPurchaseDate = new DateTime ("2010-5-15");
$newPurchaseDate = new DateTime (); 
$costPerYear = 0;
$costOfOwnership = 0;
$purchaseCost = 1000;
$loadsPerWeek = 5;
$myApp = new clsFurnace($oldPurchaseDate, $newPurchaseDate, $purchaseCost, $loadsPerWeek);

echo "<h1>Braxton Flaro</h1>";
echo "<p>" . $myApp->howLong($oldPurchaseDate, $newPurchaseDate, $myApp->getTimeOwned($oldPurchaseDate, $newPurchaseDate)) . "</p>";
echo "<p>" . $myApp->calculateCosts($costPerYear, $costOfOwnership, $myApp->getTimeOwned($oldPurchaseDate, $newPurchaseDate)) . "</p>";

//Parent Class
abstract class clsAppliance
{
	private $oldPurchaseDate, $newPurchaseDate;

	protected function __construct ($poldPurchaseDate = "2010-5-15", $pnewPurchaseDate = "2022-12-12")
	{
	   $this->setOldPurchaseDate($poldPurchaseDate);
	   $this->setNewPurchaseDate($pnewPurchaseDate);
	}
	public function getOldPurchaseDate() { return $this->oldPurchaseDate; }
	public function setOldPurchaseDate($poldPurchaseDate) { if ($poldPurchaseDate != NULL) $this->oldPurchaseDate = $poldPurchaseDate;}
	public function getNewPurchaseDate() 	{ return $this->newPurchaseDate; }
	public function setNewPurchaseDate($pnewPurchaseDate) {if ($pnewPurchaseDate!= NULL) $this->newPurchaseDate= $pnewPurchaseDate;}
	
	abstract public function testGetsAndSets();
	abstract public function calculateCosts($costPerYear, $costOfOwnership, $years);
	
	//calculates the time owned by finding the difference between the purchase date of the new and old furnaces
	public function getTimeOwned($oldPurchaseDate, $newPurchaseDate)
	{  
		 $diff=date_diff($oldPurchaseDate, $newPurchaseDate);
		$yearsApart = $diff->format("%y");
        return intval($yearsApart);
	}
}

// Child Class
class clsFurnace extends clsAppliance
{
	private $purchaseCost, $loadsPerWeek; 
	private $costPerLoad = 2.25;

	public function __construct ($poldPurchaseDate = "2010-5-15", $pnewPurchaseDate = "2022-12-12", $pPurchaseCost =0, $pLoadsPerWeek =0,$costPerLoad=2.25)
	{
        parent::__construct($poldPurchaseDate, $pnewPurchaseDate);
		$this->setPurchaseCost($pPurchaseCost);
		$this->setLoadsPerWeek($pLoadsPerWeek);
		$this->setCostPerLoad($costPerLoad);
	}
	public function getPurchaseCost() { return $this->purchaseCost; }
	public function setPurchaseCost($pPurchaseCost) { if ($pPurchaseCost != NULL) $this->purchaseCost = $pPurchaseCost;}
	public function getLoadsPerWeek() { return $this->loadsPerWeek; }
	public function setLoadsPerWeek($pLoadsPerWeek) { if ($pLoadsPerWeek != NULL) $this->loadsPerWeek = $pLoadsPerWeek;}
	public function getCostPerLoad() { return $this->costPerLoad; }
	public function setCostPerLoad($costPerLoad) { if ($costPerLoad != NULL) $this->costPerLoad = $costPerLoad;}

	//a function that tests by retrieving the needed data
	public function testGetsAndSets()
	{
		echo "<p>Testing Appt gets and sets: " . 
		 "testing: " .  $this->getPurchaseCost() . " " . 
			 $this->getLoadsPerWeek() . " " . 
	         " old Date: " .  $this->getOldPurchaseDate()->format('F-d-Y') . " new Date: " .  $this->getNewPurchaseDate()->format('F-d-Y');

    }
	
	//Function takes the costs and formats them to 2 decimal places and prints the result
    public function calculateCosts($costPerYear, $costOfOwnership, $years) {

		$costPerYear 	= $this->getCostPerLoad()*$this->getLoadsPerWeek()*52;
        $costPerYear   += $this->getPurchaseCost()+$costPerYear;
        $costOfOwnership= $this->getPurchaseCost()+$costPerYear*$years;

        $costPerYear = number_format($costPerYear, 2, '.', '');
        $costOfOwnership = number_format($costOfOwnership, 2, '.', '');
        return("Cost per year: \$$costPerYear  \ Cost of ownership: \$$costOfOwnership over $years years.");
    }

	// Prints out when your furnace was orginally bought, how long it lasted and when the new furnac it bought
	public function howLong($oldPurchaseDate, $newPurchaseDate, $years)
	{
			return("Your original furnace was bought on " . $oldPurchaseDate->format('F  d, Y') .". It lasted $years years. The new furnace was bought on " .  $newPurchaseDate->format('F  d, Y') . ".");
	}
}

// Reflection
/*
To prepare for this technical interview I went over the Date and Times handout as well as all 7 exercises to make sure I understood how and why
evrything worked the way it did.

Things I could have done better would be to do some exercises of my own to mess with the concept, such as creating a airport terminal program or
something simmilar to show my greater understanding as well as have a self made project to look back on and use. 
*/
?>
