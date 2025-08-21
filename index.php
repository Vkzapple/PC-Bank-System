<?php 
    $member = [];
    $pc = [];
    $menu = [
        "nasi goreng" => 15000,
        "indomie" => 7000,
        "es teh" => 5000
    ];
    $note = "";
// POV OP
    if (isset($_POST['add_member'])) {
    $id = $_POST['member_id'];
    $nama = $_POST['member_name'];
    $password = $_POST['member_password'];
    $members[] = [
        "id" => $id,
        "name" => $nama,
        "password" => $password,
        "billing" => 0,
        "pc" => null
    ];
    $note = "Member $nama berhasil ditambahkan.";
}

if (isset($_POST['add_pc'])) {
    $no = $_POST['pc_no'];
    $pc[] = [
        "no" => $no,
        "status" => "kosong"
    ];
    $note = "PC #$no berhasil ditambahkan.";
}
// Sewa PC atau Penyewa section
if (isset($_POST['rent_pc'])) {
    $memberId = $_POST['rent_member'];
    $pcNo = $_POST['rent_pc_no'];
    $billing = 5000; 
    $note = "Member $memberId menyewa PC #$pcNo, billing +$billing";
}

// order makan
if (isset($_POST['order_food'])) {
    $memberId = $_POST['food_member'];
    $makanan = $_POST['menu_item'];
    $harga = $menu[$makanan];
    $note = "Member $memberId pesan $makanan (Rp $harga)";
}

// Bayar QRIS
if (isset($_POST['pay_qris'])) {
    $memberId = $_POST['pay_member'];
    $note = "Member $memberId bayar billing via QRIS (billing jadi 0)";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PC-BANK APPLE</title>
     <style>
body {
    font-family: "Segoe UI", Tahoma, sans-serif;
    background: linear-gradient(135deg, #74ebd5, #9face6);
    margin: 0;
    padding: 0;
    display: flex;
    justify-content: center;
    align-items: flex-start;
    min-height: 100vh;
}

.container {
    width: 100%;
    max-width: 700px;
    padding: 30px;
}

h1 {
    text-align: center;
    margin-bottom: 25px;
    color: #fff;
    text-shadow: 1px 1px 3px rgba(0,0,0,0.2);
}

.card {
    background: #fff;
    padding: 20px 25px;
    margin-bottom: 25px;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0,0,0,0.1);
}

h2 {
    margin-top: 0;
    color: #333;
    border-bottom: 2px solid #4a90e2;
    padding-bottom: 6px;
}

h3 {
    margin-bottom: 10px;
    color: #555;
}

form {
    margin-bottom: 20px;
}

input[type="text"],
input[type="number"],
select {
    width: 100%;
    padding: 12px;
    margin: 8px 0;
    border: 1px solid #ccc;
    border-radius: 8px;
    font-size: 14px;
}

button {
    background: #4a90e2;
    color: #fff;
    border: none;
    padding: 12px;
    width: 100%;
    border-radius: 8px;
    font-size: 15px;
    cursor: pointer;
    transition: 0.3s;
}

button:hover {
    background: #357abd;
}

.alert {
    background: #dff0d8;
    padding: 12px;
    margin-bottom: 20px;
    border: 1px solid #c3e6cb;
    border-radius: 8px;
    color: #155724;
    font-weight: bold;
    text-align: center;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>PC-BANK APPLE</h1>

        <?php if ($note): ?>
            <div class="alert">
                <?= $note ?>
            </div>
        <?php endif; ?>

        <!-- Operator Section -->
        <div class="card">
            <h2>Admin/Op warnet</h2>
            <form method="post">
                <h3>Tambah Member</h3>
                <input type="text" name="member_id" placeholder="ID Member" required>
                <input type="text" name="member_name" placeholder="Nama" required>
                <input type="text" name="member_password" placeholder="Password" required>
                <button type="submit" name="add_member">Tambah Member</button>
            </form>
            <form method="post">
                <h3>Tambah PC</h3>
                <input type="number" name="pc_no" placeholder="Nomor PC" required>
                <button type="submit" name="add_pc">Tambah PC</button>
            </form>
        </div>

        <!-- Member Section -->
        <div class="card">
            <h2>Member/Penyewa Section</h2>
            <form method="post">
                <h3>Sewa PC</h3>
                <input type="text" name="rent_member" placeholder="ID Member" required>
                <input type="number" name="rent_pc_no" placeholder="Nomor PC" required>
                <button type="submit" name="rent_pc">Sewa PC</button>
            </form>
            <form method="post">
                <h3>Pesan Makanan</h3>
                <input type="text" name="food_member" placeholder="ID Member" required>
            <select name="menu_item">
                <option value="nasi goreng">Nasi Goreng - Rp 15.000</option>
                <option value="indomie">Indomie - Rp 7.000</option>
                <option value="es teh">Es Teh - Rp 5.000</option>
            </select>
                <button type="submit" name="order_food">Pesan</button>
            </form>
            <form method="post">
                <h3>Bayar Billing via QRIS</h3>
                <input type="text" name="pay_member" placeholder="ID Member" required>
                <button type="submit" name="pay_qris">Bayar QRIS</button>
            </form>
        </div>
    </div>
</body>

</html>
