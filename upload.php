<?php
echo "<table border=\"1\">";
echo "<tr><td>Client Filename: </td>
   <td>" . $_FILES["fileName"]["name"] . "</td></tr>";
echo "<tr><td>File Type: </td>
   <td>" . $_FILES["fileName"]["type"] . "</td></tr>";
echo "<tr><td>File Size: </td>
   <td>" . ($_FILES["fileName"]["size"] / 1024) . " Kb</td></tr>";
echo "<tr><td>Name of Temporary File: </td>
   <td>" . $_FILES["fileName"]["tmp_name"] . "</td></tr>";
echo "</table>";


if (($_FILES["fileName"]["type"] == "image/gif")
  || ($_FILES["fileName"]["type"] == "image/jpeg")
  || ($_FILES["fileName"]["type"] == "image/png" ))
  {
  //do the error checking and upload if the check comes back OK
         switch ($_FILES['uploadFile'] ['error'])
          {  case 1:
                    print '<p> The file is bigger than this PHP installation allows</p>';
                    break;
             case 2:
                    print '<p> The file is bigger than this form allows</p>';
                    break;
             case 3:
                    print '<p> Only part of the file was uploaded</p>';
                    break;
             case 4:
                    print '<p> No file was uploaded</p>';
                    break;
          }

		move_uploaded_file($_FILES["fileName"]["tmp_name"],
  		"uploads/" . $_FILES["fileName"]["name"]);

  }
else
  {
  echo "Files must be either JPEG, GIF, or PNG";
  }





?>