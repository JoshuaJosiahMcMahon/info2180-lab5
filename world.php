<?php
$host = 'localhost';
$username = 'lab5_user';
$password = 'password123';
$dbname = 'world';

$country = isset($_GET['country']) ? $_GET['country'] : '';
$lookup = isset($_GET['lookup']) ? $_GET['lookup'] : '';

$conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password);

if ($lookup === 'cities') {
    $stmt = $conn->prepare("
        SELECT cities.name, cities.district, cities.population 
        FROM cities 
        JOIN countries ON cities.country_code = countries.code 
        WHERE countries.name LIKE :country
    ");
    $stmt->execute(['country' => '%' . $country . '%']);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    if (count($results) > 0): ?>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>District</th>
            <th>Population</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['district']); ?></td>
            <td><?= number_format($row['population']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <?php else: ?>
<p class="no-results">No cities found in the ninja world, dattebayo!</p>
    <?php endif;
    
} else {
    $stmt = $conn->prepare("SELECT * FROM countries WHERE name LIKE :country");
    $stmt->execute(['country' => '%' . $country . '%']);
    $results = $stmt->fetchAll(PDO::FETCH_ASSOC);

    if (count($results) > 0): ?>
<table>
    <thead>
        <tr>
            <th>Country Name</th>
            <th>Continent</th>
            <th>Independence Year</th>
            <th>Head of State</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($results as $row): ?>
        <tr>
            <td><?= htmlspecialchars($row['name']); ?></td>
            <td><?= htmlspecialchars($row['continent']); ?></td>
            <td><?= htmlspecialchars($row['independence_year'] ?? 'N/A'); ?></td>
            <td><?= htmlspecialchars($row['head_of_state']); ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
    <?php else: ?>
<p class="no-results">No villages found in the ninja world, dattebayo!</p>
    <?php endif;
}
?>
