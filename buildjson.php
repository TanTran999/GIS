<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "gis";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$list_toanha = array();

//-------------------------------------------------------------

class Than
{

    public $id_than;
    public $height;
    public $ten_than;
    public $mota_than;

    function set_data_than($id, $height, $name, $des)
    {
        $this->id_than = $id;
        $this->height = $height;
        $this->ten_than = $name;
        $this->mota_than = $des;;
    }
    function get_id_than()
    {
        return $this->id_than;
    }
    function output_than()
    {
        echo $this->id_than . " " . $this->height . " " . $this->ten_than . " " . $this->mota_than . "<br>";
    }
}

class Node
{

    public $id_node;
    public $z;
    public $x;
    public $y;

    function set_data_node($id, $z, $x, $y)
    {
        $this->id_node = $id;
        $this->z = $z;
        $this->x = $x;
        $this->y = $y;
    }

    function get_id_node()
    {
        return $this->id_node;
    }
    function output_node()
    {
        echo $this->id_node . " " . $this->z . " " . $this->x . " " . $this->y . "<br>";
    }
}

class Point
{
    public $x;
    public $y;
    
    function set_data_point($x, $y)
    {
        $this->x = $x;
        $this->y = $y;
    }
    
}

//-------------------------------------------------------------
// tìm số lượng body hiển thị lên map

$sotoannha = 0;
$sql = "SELECT id_body FROM body";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    $sotoannha = $result->num_rows;
} else {
    echo "0 results";
}

//-------------------------------------------------------------
//vòng lặp đưa dữ liệu query từng body vào mảng chung tạo json

$list_body = array();
$list_ring = array();

for ($i = 1; $i <= $sotoannha; $i++) {

    //---------------------------------------------------------
    //lấy thông tin mô tả và chiều cao

    $info = ["title" => " ", "content" => " ", "height" => " "];

    $sql_body = "SELECT * FROM body WHERE body.id_body = $i";
    $result_body = $conn->query($sql_body);
    if ($result_body->num_rows > 0) {
        $count = $i - 1;
        while ($row = $result_body->fetch_assoc()) {
            $list_body[$count] = new \Than();
            $list_body[$count]->set_data_than($row["id_body"], $row["height"], $row["name"], $row["description"]);

            $info["title"] = $row["name"];
            $info["content"] = $row["description"];
            $info["height"] = $row["height"];
        }
    } else {
        echo "0 results";
    }

    

    //---------------------------------------------------------
    //lấy thông tin của node 

    $ring = array();
    $node = array();
    $sql_node = "SELECT node.id_node, node.z, point.x, point.y FROM node JOIN face_node on face_node.id_face = $i AND face_node.id_node = node.id_node JOIN point ON node.id_node = point.id_point";
    $result_node = $conn->query($sql_node);
    if ($result_node->num_rows > 0) {
        $count_node = 0;
        while ($row = $result_node->fetch_assoc()) {
            $node[$count_node] = new \Node();
            $node[$count_node]->set_data_node($row["id_node"], $row["z"], $row["x"], $row["y"]);
            $count_node = $count_node + 1;
        }
    } else {
        echo "0 results";
    }


    foreach ($node as $point) {
        array_push($ring, [$point->x, $point->y, $point->z]);
    }

    //---------------------------------------------------------
    //gom nhóm thông tin

    $thongtin = [
        
            "type" => "polygon",
            "popupTemplate" => [
                "title" => $info["title"],
                "content" => $info["content"]
            ],
            "rings" => $ring,
            "symbol" => [
                "type" => "polygon-3d",
                "symbolLayers" => [
                    [
                        "type" => "extrude",
                        "size" => $info["height"],
                        "material" => [
                            "color" => "#aaadf7"
                        ]
                    ]
                ]
            ]
    ];

    array_push($list_toanha,$thongtin);

}

//-------------------------------------------------------------
//tạo json

$conn->close();
$fp = fopen('assets/data/result.json', 'w');
fwrite($fp, json_encode($list_toanha, JSON_UNESCAPED_UNICODE));
fclose($fp);
