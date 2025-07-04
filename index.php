<?php 
require_once __DIR__ . "/inc/Fraction_Class.php";
?>

<!DOCTYPE html>
<html lang="it">
<head>
    <meta charset="UTF-8" />
    <title>Calcolatrice di Frazioni</title>
    </head>
<body>
<div class="container">
    <h2>Calcolatrice di Frazioni</h2>
    <form method="POST" action="">
        <fieldset>
            <legend>Frazione 1</legend>
            <label>Numeratore: <input type="number" name="num1" required value="<?php echo isset($_POST['num1']) ? htmlspecialchars($_POST['num1']) : 1; ?>"></label>
            <label>Denominatore: <input type="number" name="den1" required value="<?php echo isset($_POST['den1']) ? htmlspecialchars($_POST['den1']) : 3; ?>"></label>
        </fieldset>
        <fieldset>
            <legend>Frazione 2</legend>
            <label>Numeratore: <input type="number" name="num2" required value="<?php echo isset($_POST['num2']) ? htmlspecialchars($_POST['num2']) : 1; ?>"></label>
            <label>Denominatore: <input type="number" name="den2" required value="<?php echo isset($_POST['den2']) ? htmlspecialchars($_POST['den2']) : 6; ?>"></label>
        </fieldset>
        <button type="submit">Calcola</button>
    </form>

    <?php
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        try {
            $num1 = (int)$_POST['num1'];
            $den1 = (int)$_POST['den1'];
            $num2 = (int)$_POST['num2'];
            $den2 = (int)$_POST['den2'];

            $fraction1 = new Fraction($num1, $den1);
            $fraction2 = new Fraction($num2, $den2);

            $sum = $fraction1->AddOrSubtract($fraction2, +1);
            $subtract = $fraction1->AddOrSubtract($fraction2, -1);
            $product = $fraction1->Product($fraction2);
            $division = $fraction1->division($fraction2);

            echo "<div class='result'>";
            echo "<p><strong>Frazione 1:</strong> " . $fraction1->getFraction() . "</p>";
            echo "<p><strong>Frazione 2:</strong> " . $fraction2->getFraction() . "</p>";
            echo "<p><strong>Somma:</strong> " . $sum->getFraction() . "</p>";
            echo "<p><strong>Sottrazione:</strong> " . $subtract->getFraction() . "</p>";
            echo "<p><strong>Prodotto:</strong> " . $product->getFraction() . "</p>";
            echo "<p><strong>Divisione:</strong> " . $division->getFraction() . "</p>";
            echo "</div>";

        } catch (InvalidArgumentException $e) {
            echo "<p class='error'>Errore: " . $e->getMessage() . "</p>";
        } catch (TypeError $e) {
            echo "<p class='error'>Errore: Inserisci valori numerici validi.</p>";
        }
    }
    ?>
</div>
</body>
</html>