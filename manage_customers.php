<?php
session_start();
require_once(__DIR__ . '/view/header.php');

if (!isset($_SESSION['customers'])) {
    $_SESSION['customers'] = [];
}

$message = '';

// Handle delete action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['delete'])) {
    $index = $_POST['delete'];
    if (isset($_SESSION['customers'][$index])) {
        unset($_SESSION['customers'][$index]);
        $_SESSION['customers'] = array_values($_SESSION['customers']); // Reindex
        $message = "Customer deleted.";
    }
}

// Handle add action
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add'])) {
    $customer = [
        'firstName'   => $_POST['firstName'] ?? '',
        'lastName'    => $_POST['lastName'] ?? '',
        'address'     => $_POST['address'] ?? '',
        'city'        => $_POST['city'] ?? '',
        'state'       => $_POST['state'] ?? '',
        'postalCode'  => $_POST['postalCode'] ?? '',
        'countryCode' => $_POST['countryCode'] ?? '',
        'phone'       => $_POST['phone'] ?? '',
        'email'       => $_POST['email'] ?? '',
        'password'    => $_POST['password'] ?? '',
    ];
    $_SESSION['customers'][] = $customer;
    $message = 'Customer added.';
}
?>

<div class="container mt-5">
    <h2>Manage Customers</h2>

    <?php if ($message): ?>
        <div class="alert alert-info"><?= htmlspecialchars($message) ?></div>
    <?php endif; ?>

    <form method="post">
        <div class="row g-3">
            <div class="col-md-6"><input class="form-control" name="firstName" placeholder="First Name" required></div>
            <div class="col-md-6"><input class="form-control" name="lastName" placeholder="Last Name" required></div>
            <div class="col-12"><input class="form-control" name="address" placeholder="Address" required></div>
            <div class="col-md-4"><input class="form-control" name="city" placeholder="City" required></div>
            <div class="col-md-4"><input class="form-control" name="state" placeholder="State" required></div>
            <div class="col-md-4"><input class="form-control" name="postalCode" placeholder="Postal Code" required></div>
            <div class="col-md-6">
                <select class="form-control" name="countryCode" required>
                    <option value="">Select Country</option>
                    <option value="US">United States</option>
                    <option value="CA">Canada</option>
                    <option value="MX">Mexico</option>
                    <option value="GB">United Kingdom</option>
                    <option value="IN">India</option>
                    <option value="AU">Australia</option>
                    <option value="DE">Germany</option>
                    <option value="FR">France</option>
                    <option value="IT">Italy</option>
                    <option value="JP">Japan</option>
                    <option value="CN">China</option>
                    <option value="PH">Philippines</option>
                    <option value="BR">Brazil</option>
                    <option value="NG">Nigeria</option>
                    <option value="ZA">South Africa</option>
                    <option value="KR">South Korea</option>
                    <option value="RU">Russia</option>
                    <option value="ES">Spain</option>
                    <option value="SE">Sweden</option>
                    <option value="SG">Singapore</option>
                    <option value="VN">Vietnam</option>
                    <option value="TH">Thailand</option>
                    <option value="AR">Argentina</option>
                    <option value="NZ">New Zealand</option>
                    <!-- Add more as needed -->
                </select>
            </div>

            <div class="col-md-6"><input class="form-control" name="phone" placeholder="Phone" required></div>
            <div class="col-md-6"><input type="email" class="form-control" name="email" placeholder="Email" required></div>
            <div class="col-md-6"><input type="password" class="form-control" name="password" placeholder="Password" required></div>
        </div>
        <button class="btn btn-primary mt-3" type="submit" name="add">Add Customer</button>
    </form>

    <?php if (!empty($_SESSION['customers'])): ?>
        <hr>
        <h3>Entered Customers</h3>
        <table class="table table-bordered mt-3">
            <thead>
            <tr>
                <th>First</th><th>Last</th><th>City</th><th>State</th><th>Email</th><th>Phone</th><th>Action</th>
            </tr>
            </thead>
            <tbody>
            <?php foreach ($_SESSION['customers'] as $i => $c): ?>
                <tr>
                    <td><?= htmlspecialchars($c['firstName']) ?></td>
                    <td><?= htmlspecialchars($c['lastName']) ?></td>
                    <td><?= htmlspecialchars($c['city']) ?></td>
                    <td><?= htmlspecialchars($c['state']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['phone']) ?></td>
                    <td>
                        <form method="post" style="margin:0;">
                            <input type="hidden" name="delete" value="<?= $i ?>">
                            <button class="btn btn-sm btn-danger" type="submit">Delete</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

<?php require_once(__DIR__ . '/view/footer.php'); ?>
