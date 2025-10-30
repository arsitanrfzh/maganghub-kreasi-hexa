<?php
// Mengimport semua class yang dibutuhkan
require_once 'animal.php';
require_once 'Ape.php';
require_once 'Frog.php';

// --- Instance untuk Release 0 ---
echo "<h2>Tugas 8 OOP PHP - Arsita Nurfauziah</h2>";
echo "<hr>";
echo "<h3>Release 0: Class Animal</h3>";
$sheep = new Animal("shaun");

echo "Name: " . $sheep->name . "<br>";
echo "legs: " . $sheep->legs . "<br>";
echo "cold blooded: " . $sheep->cold_blooded . "<br>";

// --- Instance untuk Release 1 ---
echo "<h3>Release 1: Class Frog & Ape</h3>";

// Instance Frog
$kodok = new Frog("buduk");
echo "Name: " . $kodok->name . "<br>";
echo "legs: " . $kodok->legs . "<br>";
echo "cold blooded: " . $kodok->cold_blooded . "<br>";
echo "Jump: ";
$kodok->jump();// Menjalankan method jump()
echo "<br><br>";

// Instance Ape
$sungokong = new Ape("kera sakti");
echo "Name: " . $sungokong->name . "<br>";
echo "legs: " . $sungokong->legs . "<br>";
echo "cold blooded: " . $sungokong->cold_blooded . "<br>";
echo "Yell: ";
$sungokong->yell(); // Menjalankan method yell()
echo "<br>";

?>