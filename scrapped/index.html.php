<?php
?>
<!--<script>
                                        //load car models via ajax
                                        $(document).ready(function() {
                                            $('#search_brand').click(function() {
                                                var brandId = $(this).val();
                                                if (brandId) {
                                                    $.ajax({
                                                        type: 'POST',
                                                        url: 'get_car_models.php',
                                                        data: { brand_id: brandId },
                                                        success: function(response) {
                                                            $('#search_model').html(response);
                                                        }
                                                    });
                                                } else {
                                                    $('#search_model').html('<option value="">избери</option>');
                                                }
                                            });
                                        });
                                    </script>-->
<!--<script>
                var modelsByBrands = <?/*= json_encode($aBrandsForSearch) */?>
                function displayModels(brandId) {
                    const modelsContainer = document.getElementById('search_model');
                    modelsContainer.innerHTML = ''; // Clear previous models
                    debugger;
                    if (brandId === data.brand_id) {
                        const models = data.models;
                        for (const key in models) {
                            if (models.hasOwnProperty(key)) {
                                const model = models[key];
                                const modelDiv = document.createElement('div');
                                modelDiv.textContent = `${model.model_name} (ID: ${model.model_id})`;
                                modelsContainer.appendChild(modelDiv);
                            }
                        }
                    }
                }
            </script>-->

<script>
    /*document.getElementById('collectButton').addEventListener('click', async function() {
        // Get the selected values from each select element
        const search_brand = document.getElementById('search_brand').value;
        const search_model = document.getElementById('search_model').value;
        const search_value = document.getElementById('search_value').value;
        const search_trim = document.getElementById('search_trim').value;
        const search_year = document.getElementById('search_year').value;
        const search_price = document.getElementById('demo').innerHTML;

        // Create an array with the selected values
        const selectedValues = [search_brand, search_model, search_value, search_trim, search_year, search_price];

        // Log the array to the console
        console.log(selectedValues);

        // Send the array to the PHP file using fetch
        try {
            const response = await fetch('get_cars.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(selectedValues)
            });
            const result = await response.json();
            console.log('Completed!', result);
        } catch(err) {
            console.error(`Error: ${err}`);
        }
    });*/
    /*function showFeatured() {
        const featuredElement = document.getElementById("featured-cars");
        debugger;
        if (featuredElement) {
            featuredElement.scrollIntoView({ behavior: "smooth" });
        }
    }*/
</script>
