<?php
// Setup database script
try {
    // Read and execute the database.sql file
    $sql_file = __DIR__ . '/database.sql';
    
    if (!file_exists($sql_file)) {
        die("database.sql file not found!");
    }
    
    $sql_content = file_get_contents($sql_file);
    
    // Connect to MySQL
    $pdo = new PDO("mysql:host=localhost", "root", "");
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Split SQL into individual statements
    $statements = array_filter(array_map('trim', explode(';', $sql_content)));
    
    echo "<h2>Setting up Rentiva Admin Database...</h2>";
    
    foreach ($statements as $statement) {
        if (!empty($statement) && !preg_match('/^--/', $statement)) {
            try {
                $pdo->exec($statement);
                echo "✓ Executed: " . substr($statement, 0, 50) . "...<br>";
            } catch (Exception $e) {
                echo "✗ Error: " . $e->getMessage() . "<br>";
                echo "Statement: " . substr($statement, 0, 100) . "...<br>";
            }
        }
    }
    
    echo "<h3>Database setup completed!</h3>";
    echo "<p>Default admin credentials:</p>";
    echo "<ul>";
    echo "<li>Username: admin</li>";
    echo "<li>Password: password</li>";
    echo "</ul>";
    echo "<a href='login.php'>Go to Login</a>";
    
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
}
?>
