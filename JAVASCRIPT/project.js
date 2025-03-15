function setupImageSwapping(imageIds, imagePairs, interval) {
    const img1 = document.getElementById(imageIds[0]);
    const img2 = document.getElementById(imageIds[1]);

    function updateImages() {
        const randomIndex = Math.floor(Math.random() * imagePairs.length);
        const currentPair = imagePairs[randomIndex];

        img1.src = currentPair[0];
        img2.src = currentPair[1];
    }

    setInterval(updateImages, interval); // Update every `interval` milliseconds

    // Initial load
    updateImages();
}

// Setup for different image sections
setupImageSwapping(
    ['image5', 'image6'],
    [
        ['people-working-together-medium-shot_52683-99762.avif', 'high-angle-people-applauding-work_23-2149636269.avif'],
        ['photo6.avif', 'crm10.jpg'],
        ['newcrm.jpeg','business-custome-management_161452-4708.avif']
        [ 'crm18.jpg','crm18.jpg'],
        [ 'crm19.jpg', 'crm19.jpg']
        
    ],
    1600
);

setupImageSwapping(
    ['image1', 'image2'],
    [
        ['newcrm.jpeg', 'newproject.jpeg'],
        ['crmnew1.jpeg', 'crmnew2.avif'],
        [ 'crm18.jpg','crm18.jpg'],
        [ 'crm19.jpg', 'crm19.jpg']
    ],
    1600
);

setupImageSwapping(
    ['image3', 'image4'],
    [
        ['crm12.jpg', 'crm10.jpg'],
        ['crm14.jpg', 'crm11.jpg'],
        [ 'crm19.jpg', 'crm19.jpg'],
        [ 'crm18.jpg','crm18.jpg']
    ],
    1600
);

function editCustomer(id) {
    alert(`Edit customer with ID: ${id}`);
}

function deleteCustomer(id) {
    if (confirm("Are you sure you want to delete this customer now?")) {
        alert(`Deleted customer with ID: ${id}`);
    }
}