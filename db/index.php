<?php
header('Content-Type: application/json');
//db configuration
require_once 'config.php';
//db connection
require_once 'db.php';

$conn= get_db_connection();

$requestMethod ='GET';


switch ($requestMethod) {
    case 'GET':
        echo getposts($conn);
        break;
    case 'PuT': 
        updatepost($conn); //edit post
        break;    
    case 'DELETE':    
        deletepost($conn); //delete post
        break;
    case 'POST':    
        addpost($conn); //add  post
        break;    

    default:
        http_response_code(405);
        echo json_encode(['message' => 'Method Not Allowed']);
        break;
}


function getposts($conn){
    
    $sql = "SELECT id, title, summary, content FROM posts ORDER BY id DESC";
    $result = $conn->query($sql);

    $posts = [];
    while ($row = $result->fetch_assoc()) {
        $posts[] = $row;
    }

    $conn->close();
    return json_encode($posts);
}

function deletepost($conn){

}
function addpost($conn){

}
function updatepost($conn){

}
?>
