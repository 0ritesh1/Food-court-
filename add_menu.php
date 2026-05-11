<?php
include "db.php";

$msg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST["name"];
    $outlet = $_POST["outlet"];
    $price = $_POST["price"];
    $category = $_POST["category"];
    $description = $_POST["description"];
    $tags = $_POST["tags"];

    $image_name = $_FILES["image"]["name"];
    $tmp_name = $_FILES["image"]["tmp_name"];

    $folder = "uploads/";

    if (!is_dir($folder)) {
        mkdir($folder);
    }

    $new_image_name = time() . "_" . $image_name;
    $image_path = $folder . $new_image_name;

    if (move_uploaded_file($tmp_name, $image_path)) {
        $sql = $conn->prepare("insert into menu(name, outlet, price, category, image, description, tags) values(?,?,?,?,?,?,?)");
        $sql->bind_param("ssdssss", $name, $outlet, $price, $category, $image_path, $description, $tags);

        if ($sql->execute()) {
            $msg = "Menu item added successfully.";
        } else {
            $msg = "Database error.";
        }
    } else {
        $msg = "Image upload failed.";
    }
}
?>

<!doctype html>
<html lang="en">
<head>
    <title>Add Menu Item | Food Plaza</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <style>
        body {
            background: #FDF6EE;
            font-family: Poppins, sans-serif;
        }

        .admin-box {
            max-width: 850px;
            margin: 40px auto;
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 8px 30px rgba(180,50,30,.15);
        }

        .top-bar {
            background: linear-gradient(90deg, #D93B2B, #E8602A);
            color: white;
            padding: 18px 30px;
            border-radius: 16px;
            margin-bottom: 25px;
        }

        label {
            font-weight: 600;
            margin-bottom: 6px;
        }

        .form-control, .form-select {
            border-radius: 10px;
            padding: 10px;
        }

        .btn-add {
            background: #D93B2B;
            color: white;
            border: none;
            padding: 12px;
            border-radius: 10px;
            font-weight: 700;
            width: 100%;
        }

        .btn-add:hover {
            background: #B52E1E;
            color: white;
        }

        .btn-back {
            text-decoration: none;
            color: white;
            font-weight: 600;
            font-size: 14px;
        }
    </style>
</head>

<body>

<div class="admin-box">
    <div class="top-bar d-flex justify-content-between align-items-center">
        <h3 class="m-0">🍽️ Add Menu Item</h3>
        <a href="home.php" class="btn-back">Back to Home</a>
    </div>

    <?php if ($msg != "") { ?>
        <div class="alert alert-info">
            <?= $msg ?>
        </div>
    <?php } ?>

    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6 mb-3">
                <label>Food Name</label>
                <input type="text" name="name" class="form-control" placeholder="Example: Cheese Pizza" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Outlet Name</label>
                <input type="text" name="outlet" class="form-control" placeholder="Example: Pizza Corner" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Price</label>
                <input type="number" name="price" class="form-control" placeholder="Example: 250" required>
            </div>

            <div class="col-md-6 mb-3">
                <label>Category</label>
                <select name="category" class="form-select" required>
                    <option value="">Select Category</option>
                    <option value="Pizza">Pizza</option>
                    <option value="Burgers">Burgers</option>
                    <option value="Indian">Indian</option>
                    <option value="Beverages">Beverages</option>
                    <option value="Chinese">Chinese</option>
                    <option value="Desserts">Desserts</option>
                    <option value="Street Food">Street Food</option>
                    <option value="Healthy">Healthy</option>
                </select>
            </div>

            <div class="col-md-12 mb-3">
                <label>Food Image</label>
                <input type="file" name="image" class="form-control" accept="image/*" required>
            </div>

            <div class="col-md-12 mb-3">
                <label>Description for Details Popup</label>
                <textarea name="description" class="form-control" rows="4" placeholder="Write details about food..." required></textarea>
            </div>

            <div class="col-md-12 mb-3">
                <label>Tags / Meta Info</label>
                <input type="text" name="tags" class="form-control" placeholder="Example: Veg · 350 kcal · 25 mins">
            </div>
        </div>

        <button type="submit" class="btn-add">Add Menu Item</button>
    </form>
</div>

</body>
</html>