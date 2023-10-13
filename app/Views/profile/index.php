<!-- app/Views/profile.php -->

<!DOCTYPE html>
<html>
<head>
    <title>My Profile</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center">My Profile</h1>

        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <div class="text-center">
                            <img src="/uploads/<?=$avatar;?>" alt="User Avatar" class="img-thumbnail" width="150">
                        </div>
                        <form method="post" action="<?= base_url('profile-upload'); ?>" enctype="multipart/form-data">
                            <div class="mb-3">
                                <input type="file" class="form-control" name="userfile" id="userfile" accept="image/*">
                            </div>
                            <button type="submit" class="btn btn-primary">Upload</button>
                        </form>
                        <hr>
                        <h4 class="card-title"><?= $firstName; ?> <?= $lastName; ?></h4>
                        <p class="card-text"><strong>Email:</strong> <?= $email; ?></p>
                        <p class="card-text"><strong>Role:</strong> <?= $role; ?></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
