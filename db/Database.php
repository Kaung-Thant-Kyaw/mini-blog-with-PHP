<?php
class Database
{
  public $connection;

  public function __construct($config, $username = 'root', $password = '')
  {
    try {
      // Build the DSN dynamically from the config file
      $dsn = 'mysql:' . http_build_query($config, '', ';');
      $this->connection = new PDO($dsn, $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Enable exception mode for errors
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC // Set fetch mode to associative array
      ]);
      // echo "Connection successful!";
    } catch (PDOException $e) {
      // Handle any connection errors
      echo "Connection failed: " . $e->getMessage();
    }
  }

  public function query($query, $params = [])
  {
    try {
      // Prepare and execute the query
      $statement = $this->connection->prepare($query);
      $statement->execute($params);
      return $statement;
    } catch (PDOException $e) {
      // Handle any query errors
      echo "Query failed: " . $e->getMessage();
    }
  }
}


$config = [
  'host' => 'localhost',
  'port' => 3306,
  'dbname' => 'codelab'
];
$db = new Database($config);
