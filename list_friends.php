<?php
$xml_file = 'friends.xml';

if (file_exists($xml_file)) {
    $xml = simplexml_load_file($xml_file);

    foreach ($xml->friend as $friend) {
        $id = (string)$friend['id'];
        $name = (string)$friend;
        echo "<li>
                $name
                <form action='actions.php' method='POST' style='display:inline;'>
                    <input type='hidden' name='action' value='delete'>
                    <input type='hidden' name='id' value='$id'>
                    <button type='submit'>Delete</button>
                </form>
              </li>";
    }
}
?>
