<?php
if (isset($_POST["req"])) {
  require "2-lib.php";
  switch ($_POST["req"]) {
    // (A) GET ENTRY/ENTRIES
    case "get":
      echo json_encode($_AB->get(
        isset($_POST["id"]) ? $_POST["id"] : null
      ));
      break;

    // (B) SAVE ENTRY
    case "save":
      $_AB->save(
        $_POST["name"], $_POST["email"], $_POST["tel"], $_POST["addr"],
        isset($_POST["id"]) ? $_POST["id"] : null
      );
      echo "OK";
      break;

    // (C) DELETE ENTRY
    case "del":
      $_AB->del($_POST["id"]);
      echo "OK";
      break;
  }
}