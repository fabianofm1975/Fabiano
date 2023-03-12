<!DOCTYPE html>
<html>
  <head>
    <title>Address Book</title>
    <script src="book.js"></script>
    <link rel="stylesheet" href="book.css">
  </head>
  <body>
    <!-- (A) ADDRESS BOOK LIST -->
    <div id="abWrap">
      <div id="abAdd" class="row" onclick="ab.tog(true)">+</div>
      <div id="abList"></div>
    </div>

    <!-- (B) ADDRESS BOOK ENTRY -->
    <form id="abForm" class="hide" onsubmit="return ab.save()">
      <label>Name</label>
      <input type="text" id="abName" required>
      <label>Email</label>
      <input type="email" id="abEmail" required>
      <label>Telephone</label>
      <input type="text" id="abTel" required>
      <label>Address</label>
      <textarea id="abAddr" required></textarea>
      <input type="hidden" id="abID">
      <input type="button" value="Back" onclick="ab.tog()">
      <input type="submit" value="Save">
    </form>
  </body>
</html>