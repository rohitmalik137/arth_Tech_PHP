<?php require "class.php" ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Document</title>
    <style>
      table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
      }

      td,
      th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
      }

      tr:nth-child(even) {
        background-color: #dddddd;
      }

      .noComments{
          color: red;
      }
      .comment{
          color: green;
      }
    </style>
  </head>
  <body>
    <form action="" method="POST">
      <label>Name:</label><input type="text" name="name" /> <br /><br />
      <label>Apartment:</label><input type="text" name="apartment" />
      <br /><br />
      <label>Floor:</label><input type="number" name="floor" /> <br /><br />
      <label>Total_floor:</label><input type="number" name="tfloor" />
      <br /><br />
      <label>Price:</label><input type="number" name="price" /> <br /><br />
      <label>City:</label><input type="text" name="city" /> <br /><br />
      <label>Society:</label><input type="text" name="society" /> <br /><br />
      <label>RoomSize:</label><input type="text" name="rsize" /> <br /><br />
      <input type="submit" value="Add" name="submit" /> <br /><br />
    </form>
  </body>
</html>

<form method="POST" action="">
  <label>Sort By:</label>
  <select name="valueSelected">
  <option value="" disabled selected>Choose option</option>
    <option value="Price_low_to_high">Low To High Price</option>
    <option value="Price_high_to_low">High to Low Price</option>
    <option value="RoomSize">Room Size</option>
  </select>
  <input type="submit" name="sortSubmit" />
</form>

<?php
    if(isset($_POST['submit'])){
        $name = htmlspecialchars(trim($_POST['name']));
        $apartment = htmlspecialchars(trim($_POST['apartment']));
        $floor = htmlspecialchars(trim($_POST['floor']));
        $totalfloor = htmlspecialchars(trim($_POST['tfloor']));
        $price = htmlspecialchars(trim($_POST['price']));
        $city = htmlspecialchars(trim($_POST['city']));
        $society = htmlspecialchars(trim($_POST['society']));
        $roomSize = htmlspecialchars(trim($_POST['rsize']));
        $result = Hotel::insertData($name, $apartment, $floor, $totalfloor, $price, $city, $society, $roomSize);
        if(!$result){
            echo "error in addiing data" . $result;
        }
    }

    ?>

<table>
  <tr>
    <th>Name</th>
    <th>Apartment</th>
    <th>Floor</th>
    <th>TotalFloor</th>
    <th>Price</th>
    <th>City</th>
    <th>Society</th>
    <th>Room Size</th>
    <th>Comment</th>
    <th>Add Comment</th>
  </tr>

  <?php

    if(isset($_POST['sortSubmit'])){
        $myValue = $_POST['valueSelected'];
        $data = Hotel::fetchData($myValue);

    if($data){
        while($rows = mysqli_fetch_assoc($data)){
            ?>

  <tr>
    <td><?php echo $rows['name'] ?></td>
    <td><?php echo $rows['apartment'] ?></td>
    <td><?php echo $rows['floor'] ?></td>
    <td><?php echo $rows['total_floor'] ?></td>
    <td><?php echo $rows['price'] ?></td>
    <td><?php echo $rows['city'] ?></td>
    <td><?php echo $rows['society'] ?></td>
    <td><?php echo $rows['room_size'] ?></td>
    <td>
        <?php
        if($rows['comments']){
        ?>
        <span class='comment'>
        <?php echo $rows['comments'] ?></span>
        <?php
        }else echo "<span class='noComments'>No Comments</span>";

        ?>
    </td>
    <td>
    <form action="" method="POST">
        <textarea name="comment"></textarea>
        <input type="hidden" name="hiddenId" value=" <?php echo $rows['id'] ?>" />
        <input type="submit" name="commentSubmit" value="Add Comment">
    </form>
    </td>
  </tr>
  <?php
        }

        ?>
</table>
<?php
    }
}
?>


<?php
    if(isset($_POST['commentSubmit'])){
        $comment = htmlspecialchars(trim($_POST['comment']));
        $id = $_POST['hiddenId'];
        Hotel::addComment($comment, $id);
    }
?>