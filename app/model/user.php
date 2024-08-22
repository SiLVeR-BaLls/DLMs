
<?php
class user {
    private $db;
    private $databaseFile; 

    public function __construct(){
        try {
            // Check if the database file exists
            if (!file_exists($this->databaseFile)) {
                // Create a new SQLite database file
                $this->db = new PDO("sqlite:" . $this->databaseFile);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Database created successfully.\n";
            } else {
                // Connect to the existing SQLite database
                $this->db = new PDO("sqlite:" . $this->databaseFile);
                $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
                echo "Connected to the existing database.\n";
            }
        } catch (PDOException $e) {
            die("Database connection failed: " . $e->getMessage());
        }
    }

    public function sing_up(){
        //butang sql querries for signup
        $this->db->prepare(/*here*/);
        
        //example 
        /* $stmt = $this->pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $stmt->execute([':username' => $username]);
        $userExists = $stmt->fetchColumn();
 */

    }
}

