function addToWishlist(packageId) {
    $.ajax({
        url: '/SHE_HACKS/ajaxHandler/wishlistAjax.php',
        type: 'POST',
        data: { package_id: packageId },
        success: function(response) {
            let data = JSON.parse(response);
            if (data.success) {
                alert("Package added to wishlist successfully!");
            } else {
                alert("Failed to add to wishlist: " + data.error);
            }
        },
        error: function(xhr, status, error) {
            alert("An error occurred. Check the console for details.");
        }
        
    });
}
