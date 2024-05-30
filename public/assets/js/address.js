$(document).ready(function () {
    $("#provinceSelect").change(function () {
        const selectedProvinceId = $(this).val(); // Mendapatkan ID provinsi yang dipilih

        // Mengirim permintaan AJAX untuk mendapatkan data kota/kabupaten
        $.ajax({
            url: `https://api.binderbyte.com/wilayah/kabupaten?api_key=15b272dd6758638c910e22db9b5cbe1a72fd2b203899331f0e202e1a9c52f7dd&id_provinsi=${selectedProvinceId}`,
            method: "GET",
            success: function (response) {
                const cities = response.value;

                // Mengosongkan dan menambahkan opsi default pada select kota/kabupaten
                $("#citySelect").html(
                    '<option value="">Pilih Kabupaten/Kota</option>'
                );

                // Menambahkan opsi kota/kabupaten ke dalam select
                cities.forEach((city) => {
                    $("#citySelect").append(
                        `<option id="${city.id}" value="${city.name}">${city.name}</option>`
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

    $("#citySelect").change(function () {
        const selectedCityId = $(this).find(":selected").attr("id"); // Mendapatkan ID provinsi yang dipilih

        // Mengirim permintaan AJAX untuk mendapatkan data kota/kabupaten
        $.ajax({
            url: `https://api.binderbyte.com/wilayah/kecamatan?api_key=15b272dd6758638c910e22db9b5cbe1a72fd2b203899331f0e202e1a9c52f7dd&id_kabupaten=${selectedCityId}`,
            method: "GET",
            success: function (response) {
                const districts = response.value;

                // Mengosongkan dan menambahkan opsi default pada select kota/kabupaten
                $("#districtSelect").html(
                    '<option value="">Pilih Kecamatan</option>'
                );

                // Menambahkan opsi kota/kabupaten ke dalam select
                districts.forEach((district) => {
                    $("#districtSelect").append(
                        `<option id="${district.id}" value="${district.name}">${district.name}</option>`
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

    $("#districtSelect").change(function () {
        const selectedDistrictId = $(this).find(":selected").attr("id"); // Mendapatkan ID provinsi yang dipilih

        // Mengirim permintaan AJAX untuk mendapatkan data kota/kabupaten
        $.ajax({
            url: `https://api.binderbyte.com/wilayah/kelurahan?api_key=15b272dd6758638c910e22db9b5cbe1a72fd2b203899331f0e202e1a9c52f7dd&id_kecamatan=${selectedDistrictId}`,
            method: "GET",
            success: function (response) {
                const villages = response.value;

                // Mengosongkan dan menambahkan opsi default pada select kelurahan
                $("#villageSelect").html(
                    '<option value="">Pilih Kelurahan</option>'
                );

                // Menambahkan opsi kelurahan ke dalam select
                villages.forEach((village) => {
                    $("#villageSelect").append(
                        `<option id="${village.id}" value="${village.name}">${village.name}</option>`
                    );
                });
            },
            error: function (xhr, status, error) {
                console.error(xhr.responseText);
            },
        });
    });

    // Event listener saat memilih provinsi
    $("#provinceSelect").change(function () {
        const selectedProvinceId = $(this).val(); // Mendapatkan ID provinsi yang dipilih
        $("#provinceCode").val(selectedProvinceId); // Mengisi nilai input hidden province_code dengan ID provinsi
        console.log(selectedProvinceId);
    });

    // Event listener saat memilih kota/kabupaten
    $("#citySelect").change(function () {
        const selectedCityId = $(this).find(":selected").attr("id"); // Mendapatkan ID kota/kabupaten yang dipilih
        $("#cityCode").val(selectedCityId); // Mengisi nilai input hidden city_code dengan ID kota/kabupaten
        console.log(selectedCityId);
    });

    // Event listener saat memilih kecamatan
    $("#districtSelect").change(function () {
        const selectedDistrictId = $(this).find(":selected").attr("id"); // Mendapatkan Kecamatan yang dipilih
        $("#districtCode").val(selectedDistrictId); // Mengisi nilai input hidden district_code dengan ID kecamatan
        console.log(selectedDistrictId);
    });

    // Event listener saat memilih kelurahan
    $("#villageSelect").change(function () {
        const selectedVillageId = $(this).find(":selected").attr("id"); // Mendapatkan kelurahan yang dipilih
        $("#villageCode").val(selectedVillageId); // Mengisi nilai input hidden village_code dengan ID kelurahan
        console.log(selectedVillageId);
    });
});
