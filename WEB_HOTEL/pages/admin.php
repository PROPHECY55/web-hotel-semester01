<?php if (isAdmin()) : ?>

    <head>
        <link rel="stylesheet" href="../css/admin.css">
    </head>

    <!-- Fetch everything from users from database -->
    <?php
    $sql = "SELECT * FROM users";
    $result = mysqli_query($conn, $sql);
    ?>

    <div class="container-x1 mt-4">
        <h2 class="mb-4 manage-users">Manage Users</h2>
        <a href="?page=admin_reservations" class="btn btn-danger">Manage Reservations</a>

        <!-- Print Success Message -->
        <?php
        if (isset($_GET['success']) && $_GET['success'] == 1) {
            echo "<div class='alert alert-success mt-3'>Changes Saved Successfully!</div>";
        }
        ?>

        <!-- Form/Table -->
        <form action="?action=admin_saveChanges" method="post">
            <table class="table table-bordered">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Benutzername</th>
                        <th>Email</th>
                        <th>Anrede</th>
                        <th>Vorname</th>
                        <th>Nachname</th>
                        <th>Rolle</th>
                        <th>Status</th>
                        <th>Neues Passwort</th>
                        <th>Account Erstellt</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td>{$row['user_id']}</td>";
                        echo "<td><input type='text' class='form-control' name='username[]' value='{$row['username']}'></td>";
                        echo "<td><input type='text' class='form-control' name='email[]' value='{$row['email']}'></td>";
                        echo "<td>
                                <select class='form-control' name='salutation[]'>
                                    <option value='Mr' " . ($row['salutation'] == 'Mr' ? 'selected' : '') . ">Herr</option>
                                    <option value='Mrs' " . ($row['salutation'] == 'Mrs' ? 'selected' : '') . ">Frau</option>
                                </select>
                            </td>";
                        echo "<td><input type='text' class='form-control' name='firstname[]' value='{$row['firstname']}'></td>";
                        echo "<td><input type='text' class='form-control' name='lastname[]' value='{$row['lastname']}'></td>";
                        echo "<td>
                                <select class='form-control' name='role[]'>
                                    <option value='admin' " . ($row['role'] == 'admin' ? 'selected' : '') . ">Admin</option>
                                    <option value='user' " . ($row['role'] == 'user' ? 'selected' : '') . ">User</option>
                                    <option value='anonym' " . ($row['role'] == 'anonym' ? 'selected' : '') . ">Anonym</option>
                                </select>
                            </td>";
                        echo "<td>
                                <select class='form-control' name='status[]'>
                                    <option value='active' " . ($row['status'] == 'active' ? 'selected' : '') . ">Active</option>
                                    <option value='inactive' " . ($row['status'] == 'inactive' ? 'selected' : '') . ">Inactive</option>
                                </select>
                            </td>";
                        echo "<td><input type='password' class='form-control' name='new_password[]'></td>";
                        echo "<td>{$row['acc_created']}</td>";
                        echo "<input type='hidden' name='user_id[]' value='{$row['user_id']}'>";
                        echo "</tr>";
                    }
                    ?>
                </tbody>
            </table>
            <button type="submit" class="btn btn-warning">Save Changes</button>
        </form>
    </div>
<?php endif; ?>