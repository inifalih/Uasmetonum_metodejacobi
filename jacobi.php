<!DOCTYPE html>
<html>
<head>
    <title>Metode Jacobi</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f0f0f0;
            text-align: center;
        }
        .container {
            background-color: #ffa500; 
            padding: 20px;
            margin: auto;
            width: 60%;
            border-radius: 10px;
            box-shadow: 0px 0px 20px 0px rgba(0,0,0,0.1);
            margin-top: 50px;
        }
        input[type=number] {
            width: 60px;
            margin: 5px;
            padding: 5px;
            border: 1px solid #ccc;
            border-radius: 3px;
            text-align: center;
        }
        .button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
        }
        .button:hover {
            background-color: #45a049;
        }
        .button.delete {
            background-color: #f44336;
        }
        .button.delete:hover {
            background-color: #da190b;
        }
        .button.refresh {
            background-color: #2196F3;
        }
        .button.refresh:hover {
            background-color: #0b7dda;
        }
        .result-container {
            background-color: #ffa500; 
            padding: 10px;
            margin: auto;
            width: 60%;
            margin-top: 20px;
            border-radius: 10px;
            text-align: left;
            box-shadow: 0px 0px 15px 0px rgba(0,0,0,0.1);
        }
        .result-container h3 {
            margin-top: 0;
            color: #4CAF50;
        }
        .result-container table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
        }
        .result-container table, .result-container th, .result-container td {
            border: 1px solid #ddd;
        }
        .result-container th, .result-container td {
            padding: 5px;
            text-align: center;
        }
        .result-container th {
            background-color: #4CAF50;
            color: white;
        }
        .result-container tr:nth-child(even) {
            background-color: #f2f2f2;
        }
        .result-container tr:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Metode Jacobi</h2>
        <form method="post">
            <div>
                <label>Persamaan 1:</label><br>
                <input type="number" name="a11" required> x1 + 
                <input type="number" name="a12" required> x2 + 
                <input type="number" name="a13" required> x3 = 
                <input type="number" name="b1" required>
            </div>
            <div>
                <label>Persamaan 2:</label><br>
                <input type="number" name="a21" required> x1 + 
                <input type="number" name="a22" required> x2 + 
                <input type="number" name="a23" required> x3 = 
                <input type="number" name="b2" required>
            </div>
            <div>
                <label>Persamaan 3:</label><br>
                <input type="number" name="a31" required> x1 + 
                <input type="number" name="a32" required> x2 + 
                <input type="number" name="a33" required> x3 = 
                <input type="number" name="b3" required>
            </div>
            <div>
                <label>Jumlah Iterasi:</label>
                <input type="number" name="iterations" required>
            </div>
            <div>
                <button class="button" type="submit" name="hitung">Hitung</button>
                <button class="button refresh" type="button" onclick="location.reload();">Refresh</button>
            </div>
        </form>
    </div>
    
    <?php
    if (isset($_POST['hitung'])) {
        $a11 = $_POST['a11']; $a12 = $_POST['a12']; $a13 = $_POST['a13']; $b1 = $_POST['b1'];
        $a21 = $_POST['a21']; $a22 = $_POST['a22']; $a23 = $_POST['a23']; $b2 = $_POST['b2'];
        $a31 = $_POST['a31']; $a32 = $_POST['a32']; $a33 = $_POST['a33']; $b3 = $_POST['b3'];
        $iterations = $_POST['iterations'];

      
        if ($a11 == 0 || $a22 == 0 || $a33 == 0) {
            echo "<div class='result-container'><p>Error: Koefisien diagonal utama tidak boleh nol.</p></div>";
        } else {
            $x1 = $x2 = $x3 = 0;
            $errors = array();

            echo "<div class='result-container'><h3>Hasil Iterasi:</h3><table><tr><th>Iterasi</th><th>x1</th><th>x2</th><th>x3</th><th>Error</th></tr>";

            for ($i = 0; $i < $iterations; $i++) {
                $x1_new = ($b1 - $a12 * $x2 - $a13 * $x3) / $a11;
                $x2_new = ($b2 - $a21 * $x1 - $a23 * $x3) / $a22;
                $x3_new = ($b3 - $a31 * $x1 - $a32 * $x2) / $a33;

                $error = sqrt(pow($x1_new - $x1, 2) + pow($x2_new - $x2, 2) + pow($x3_new - $x3, 2));
                array_push($errors, $error);

                $x1 = $x1_new;
                $x2 = $x2_new;
                $x3 = $x3_new;

                echo "<tr><td>".($i+1)."</td><td>".number_format($x1, 6)."</td><td>".number_format($x2, 6)."</td><td>".number_format($x3, 6)."</td><td>".number_format($error, 6)."</td></tr>";
            }

            echo "</table>";
            echo "<form method='post'><button class='button delete' type='submit' name='hapus'>Hapus Hasil</button></form></div>";
        }
    }

    if (isset($_POST['hapus'])) {
        $x1 = $x2 = $x3 = 0;
        echo "<div class='result-container'><p>Hasil iterasi dihapus.</p></div>";
    }
    ?>
</body>
</html>
