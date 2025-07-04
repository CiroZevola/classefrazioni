<?php
class Fraction {
    private int $numerator;
    private int $denominator;

    
    public function __construct(int $numerator, int $denominator) {
        if ($denominator == 0) {
            throw new InvalidArgumentException("Il denominatore non può essere zero.");
        }
        $this->numerator = $numerator;
        $this->denominator = $denominator;
        $this->riduci();
    }

    private function riduci(): void {
       
        $gcd = $this->greatestCommonDivisor(abs($this->numerator), abs($this->denominator));
        $this->numerator /= $gcd;
        $this->denominator /= $gcd;

        
        if ($this->denominator < 0) {
            $this->denominator = -$this->denominator;
            $this->numerator = -$this->numerator;
        }
    }

    private function greatestCommonDivisor(int $number1, int $number2): int {
        while ($number2 != 0) {
            $rest = $number1 % $number2;
            $number1 = $number2; 
            $number2 = $rest;
        }
        return $number1;
    }

    public function getFraction(): string {
        return $this->numerator . "/" . $this->denominator;
    }

    public function AddOrSubtract(Fraction $s, int $sign=1) :Fraction{
        $newNumerator = $this->numerator * $s->denominator + $sign*($this->denominator * $s->numerator); 
        $newDenominator = $this->denominator * $s->denominator;
        return new Fraction($newNumerator,$newDenominator);
    }

    public function Product(Fraction $p):Fraction{
        $newNumerator = $this->numerator * $p->numerator;
        $newDenominator = $this->denominator * $p->denominator;
        return new Fraction($newNumerator,$newDenominator);
    }

    public function division(Fraction $b): Fraction {
        if ($b->numerator == 0) {
            throw new InvalidArgumentException("Impossibile dividere per una frazione con numeratore zero.");
        }
        $newNumerator = $this->numerator * $b->denominator;
        $newDenominator = $this->denominator * $b->numerator;
        return new Fraction($newNumerator, $newDenominator);
    }
}

$fraction1 = new Fraction( 1 , 3 );
$fraction2 = new Fraction( 1 , 6 );
$sum = $fraction1->AddOrSubtract($fraction2,+1);
$substract = $fraction1->AddOrSubtract($fraction2,-1);
$product = $fraction1->Product($fraction2);
$division = $fraction1->division($fraction2);
echo "Fraction: " . $fraction1->getFraction() . "<br>"; 
echo "Fraction: " . $fraction2->getFraction() . "<br>"; 
echo "Sum: " . $sum->getFraction() . "<br>"; 
echo "Substaction: " . $substract->getFraction() . "<br>"; 
echo "Product: " . $product->getFraction() . "<br>"; 
echo "division: " . $division->getFraction() . "<br>"; 
?>
