<?php
class AddressBook {
  // (A) CONSTRUCTOR - CONNECT TO DATABASE
  private $pdo = null;
  private $stmt = null;
  public $lastID = null;
  public $error = "";
  function __construct () {
    $this->pdo = new PDO(
      "mysql:host=".DB_HOST.";dbname=".DB_NAME.";charset=".DB_CHARSET,
      DB_USER, DB_PASSWORD, [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
  }

  // (B) DESTRUCTOR - CLOSE DATABASE CONNECTION
  function __destruct () {
    if ($this->stmt!==null) { $this->stmt = null; }
    if ($this->pdo!==null) { $this->pdo = null; }
  }

  // (C) EXECUTE SQL QUERY
  function query ($sql, $data=null) {
    $this->stmt = $this->pdo->prepare($sql);
    $this->stmt->execute($data);
  }

  // (D) GET ENTRY
  function get ($id=null) {
    $this->query(
      "SELECT * FROM `address_book`" . ($id==null ? "" : " WHERE `id`=?"),
      $id==null ? null : [$id]
    );
    return $id==null ? $this->stmt->fetchAll() : $this->stmt->fetch() ;
  }

  // (E) SAVE ENTRY
  function save ($name, $email, $tel, $addr, $id=null) {
    // (E1) NEW OR UPDATE
    if ($id===null) {
      $sql = "INSERT INTO `address_book` (`name`, `email`, `tel`, `address`) VALUES (?,?,?,?)";
      $data = [$name, $email, $tel, $addr];
    } else {
      $sql = "UPDATE `address_book` SET `name`=?, `email`=?, `tel`=?, `address`=? WHERE `id`=?";
      $data = [$name, $email, $tel, $addr, $id];
    }

    // (E2) RUN
    $this->query($sql, $data);
    return true;
  }

  // (F) DELETE ENTRY
  function del ($id) {
    $this->query("DELETE FROM `address_book` WHERE `id`=?", [$id]);
    return true;
  }
}

// (G) DATABASE SETTINGS - CHANGE TO YOUR OWN!
define("DB_HOST", "localhost");
define("DB_NAME", "test");
define("DB_CHARSET", "utf8mb4");
define("DB_USER", "root");
define("DB_PASSWORD", "");

// (H) ADDRESS BOOK OBJECT
$_AB = new AddressBook();