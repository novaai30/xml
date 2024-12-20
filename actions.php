<?php
$xml_file = 'friends.xml';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $action = $_POST['action'];
    $name = $_POST['name'] ?? '';
    $id = $_POST['id'] ?? '';

    $xml = simplexml_load_file($xml_file);

    if ($action === 'add') {
        if ($id) {
            // Edit friend
            foreach ($xml->friend as $friend) {
                if ((string)$friend['id'] === $id) {
                    $friend[0] = $name;
                    break;
                }
            }
        } else {
            // Add new friend
            $new_friend = $xml->addChild('friend', $name);
            $new_friend->addAttribute('id', uniqid());
        }
    } elseif ($action === 'delete') {
        // Delete friend
        foreach ($xml->friend as $key => $friend) {
            if ((string)$friend['id'] === $id) {
                unset($xml->friend[$key]);
                break;
            }
        }
    }

    // Save XML
    $xml->asXML($xml_file);

    header('Location: index.html');
    exit();
}
?>
