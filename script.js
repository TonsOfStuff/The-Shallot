document.getElementById("specialID").addEventListener("click", function(event) {
    event.preventDefault(); // Prevents the default link behavior (e.g., navigating to a new page)

    // Make an AJAX request to your PHP script
    var xhr = new XMLHttpRequest();
    xhr.open("GET", "/special.php", true);

    xhr.onload = function() {
        if (xhr.status == 200) {
            // Handle the response if needed
            console.log(xhr.responseText);


            window.location.href = '/special.php';
        }
    };

    xhr.send();
});