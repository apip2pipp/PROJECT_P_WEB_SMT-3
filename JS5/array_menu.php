<?php
// Define a multi-level menu using an associative array
$menu = array(
    "Home" => "#home",
    "About Us" => array(
        "Our Team" => "#team",
        "Our Story" => "#story",
        "Mission & Vision" => "#mission"
    ),
    "Services" => array(
        "Web Development" => "#web",
        "Mobile Development" => "#mobile",
        "SEO Optimization" => "#seo"
    ),
    "Contact" => "#contact"
);

// Function to display the menu
function displayMenu($menu) {
    echo "<ul>";
    foreach ($menu as $key => $value) {
        // Check if the menu item is an array (meaning it has sub-items)
        if (is_array($value)) {
            echo "<li>$key";
            displayMenu($value); // Recursively display the sub-menu
            echo "</li>";
        } else {
            echo "<li><a href='$value'>$key</a></li>";
        }
    }
    echo "</ul>";
}

// Call the function to display the menu
displayMenu($menu);
?>
