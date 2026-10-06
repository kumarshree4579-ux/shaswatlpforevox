<?php
session_start();
require_once '../includes/config.php';

if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: login.php");
    exit;
}

$stmt = $pdo->query("SELECT * FROM leads ORDER BY created_at DESC");
$leads = $stmt->fetchAll();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - E-Vox</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-50">
    <nav class="bg-blue-700 p-4 text-white flex justify-between items-center shadow-md">
        <div class="flex items-center gap-3">
            <img src="../../assets/images/logo-header.webp" alt="E-Vox Logo" class="h-8 bg-white p-1 rounded">
            <h1 class="text-xl font-bold">Admin Dashboard</h1>
        </div>
        <a href="logout.php" class="bg-blue-800 hover:bg-blue-900 px-4 py-2 rounded text-sm font-medium transition-colors">Logout</a>
    </nav>
    <div class="container mx-auto mt-8 p-6 bg-white rounded-xl shadow-sm border border-gray-100 max-w-6xl">
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-bold text-gray-800">Recent Leads & Visitors</h2>
            <span class="bg-blue-100 text-blue-800 text-sm font-semibold px-3 py-1 rounded-full"><?php echo count($leads); ?> Total</span>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-left border-collapse">
                <thead>
                    <tr class="bg-gray-50 text-gray-600 text-sm">
                        <th class="py-3 px-4 border-b font-medium">ID</th>
                        <th class="py-3 px-4 border-b font-medium">Date</th>
                        <th class="py-3 px-4 border-b font-medium">Name</th>
                        <th class="py-3 px-4 border-b font-medium">Email</th>
                        <th class="py-3 px-4 border-b font-medium">Phone</th>
                        <th class="py-3 px-4 border-b font-medium">Message</th>
                    </tr>
                </thead>
                <tbody class="text-sm">
                    <?php foreach ($leads as $lead): ?>
                    <tr class="hover:bg-gray-50 transition-colors">
                        <td class="py-3 px-4 border-b text-gray-500">#<?php echo htmlspecialchars($lead['id']); ?></td>
                        <td class="py-3 px-4 border-b whitespace-nowrap"><?php echo date('M d, Y h:i A', strtotime($lead['created_at'])); ?></td>
                        <td class="py-3 px-4 border-b font-medium text-gray-800"><?php echo htmlspecialchars($lead['name']); ?></td>
                        <td class="py-3 px-4 border-b"><a href="mailto:<?php echo htmlspecialchars($lead['email']); ?>" class="text-blue-600 hover:underline"><?php echo htmlspecialchars($lead['email']); ?></a></td>
                        <td class="py-3 px-4 border-b"><a href="tel:<?php echo htmlspecialchars($lead['phone']); ?>" class="text-blue-600 hover:underline"><?php echo htmlspecialchars($lead['phone']); ?></a></td>
                        <td class="py-3 px-4 border-b max-w-xs truncate text-gray-600" title="<?php echo htmlspecialchars($lead['message']); ?>"><?php echo htmlspecialchars($lead['message']); ?></td>
                    </tr>
                    <?php endforeach; ?>
                    <?php if(empty($leads)): ?>
                    <tr><td colspan="6" class="py-8 text-center text-gray-500">No leads have been submitted yet.</td></tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>
