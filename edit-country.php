<?php
require_once('./database/connection.php');

if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = htmlspecialchars($_GET['id']);
} else {
    header('location: ./');
}

$sql = "SELECT * FROM `countries` WHERE `id` = $id LIMIT 1";
$result = $conn->query($sql);
$country = $result->fetch_assoc();

// echo "<pre>";
// print_r($country);
// echo "</pre>";

$name = $country['name'];
$currency = $country['currency'];
$language = $country['language'];

$errors = [];
if (isset($_POST['submit'])) {
    $name = htmlspecialchars($_POST['name']);
    $currency = htmlspecialchars($_POST['currency']);
    $language = htmlspecialchars($_POST['language']);

    if (empty($name)) {
        $errors['name'] = "Provide country name";
    }

    if (empty($currency)) {
        $errors['currency'] = "Provide country currency";
    }

    if (empty($language)) {
        $errors['language'] = "Provide country language";
    }

    if (count($errors) === 0) {
        $sql = "UPDATE `countries` SET `name` = '$name', `currency` = '$currency', `language` = '$language' WHERE `id` = $id";
        if ($conn->query($sql)) {
            $success = "Magic has been spelled!";
        } else {
            $failure = "Magic has become shopper!";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Country</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
</head>

<body>
    <div class="container">
        <div class="row mt-5">
            <div class="col-md-10 mx-auto">
                <div class="card">
                    <div class="card-header">
                        <div class="row">
                            <div class="col-6">
                                <h4>Edit Country</h4>
                            </div>
                            <div class="col-6 text-end">
                                <a href="./" class="btn btn-outline-primary">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="card-body">
                        <?php
                        if (isset($success)) { ?>
                            <div class="alert alert-success alert-dismissible fade show" role="alert">
                                <?php echo $success ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        if (isset($failure)) { ?>
                            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                <?php echo $failure ?>
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        <?php
                        }
                        ?>
                        <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ?>?id=<?php echo $id ?>" method="post">
                            <div class="mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control <?php if (isset($errors['name'])) echo 'is-invalid' ?>" id="name" name="name" value="<?php echo $name ?>" placeholder="Country name!">
                                <?php
                                if (isset($errors['name'])) { ?>
                                    <div class="text-danger"><?php echo $errors['name'] ?></div>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label for="currency" class="form-label">Currency</label>
                                <input type="text" class="form-control <?php if (isset($errors['currency'])) echo 'is-invalid' ?>" id="currency" name="currency" value="<?php echo $currency ?>" placeholder="Country currency!">
                                <?php
                                if (isset($errors['currency'])) { ?>
                                    <div class="text-danger"><?php echo $errors['currency'] ?></div>
                                <?php
                                }
                                ?>
                            </div>

                            <div class="mb-3">
                                <label for="language" class="form-label">Language</label>
                                <input type="text" class="form-control <?php if (isset($errors['language'])) echo 'is-invalid' ?>" id="language" name="language" value="<?php echo $language ?>" placeholder="Country language!">
                                <?php
                                if (isset($errors['language'])) { ?>
                                    <div class="text-danger"><?php echo $errors['language'] ?></div>
                                <?php
                                }
                                ?>
                            </div>

                            <div>
                                <input type="submit" name="submit" class="btn btn-primary">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>