<?php
include "config/db.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    try {
        $name     = $_POST['name'];
        $email    = $_POST['email'];
        $dept     = $_POST['dept'];
        $college  = $_POST['college'];
        $year     = $_POST['passout_year'];
        $phone    = $_POST['phone'];
        $whatsapp = $_POST['whatsapp'];

        $district = $_POST['district'];
        if ($district === 'Other' && !empty($_POST['other_district_name'])) {
            $district = $_POST['other_district_name'];
        }

        $sql = "INSERT INTO student_data (name, email, department, college, passout_year, phone, whatsapp, district) 
                VALUES (:name, :email, :dept, :college, :year, :phone, :whatsapp, :district)";

        $stmt = $pdo->prepare($sql);
        $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':dept'     => $dept,
            ':college'  => $college,
            ':year'     => $year,
            ':phone'    => $phone,
            ':whatsapp' => $whatsapp,
            ':district' => $district
        ]);

        echo "success";
        exit();
    } catch (PDOException $e) {

    // Duplicate entry error code
    if ($e->errorInfo[1] == 1062) {

        if (strpos($e->getMessage(), 'email') !== false) {
            echo "email alredy exists";
        } 
        elseif (strpos($e->getMessage(), 'phone') !== false) {
            echo "phone alredy exists";
        } 
        else {
            echo "duplicate";
        }

    } else {
        echo "server_error";
    }

    exit();
}
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Web3 Mastery Registration</title>

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@100..900&family=Inter:wght@400;700&display=swap" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.all.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="script.js"></script>

    <link rel="stylesheet" href="style.css">

    <style>
        body {
            font-family: 'Outfit', sans-serif;
            overflow-x: hidden;
            background-color: #f8fafc;
        }

        .main-card {
            background: rgba(255, 255, 255, 0.95);
            border: 1px solid rgba(66, 193, 185, 0.3);
            border-radius: 24px !important;
            overflow: visible !important;
            padding-top: 40px;
        }

        .crypto-asset {
            position: fixed;
            z-index: -1;
            filter: drop-shadow(0 0 20px rgba(66, 193, 185, 0.4));
            animation: float 6s ease-in-out infinite;
        }

        @keyframes float {

            0%,
            100% {
                transform: translateY(0) rotate(0deg);
            }

            50% {
                transform: translateY(-20px) rotate(8deg);
            }
        }

        .live-tag {
            position: absolute;
            top: -15px;
            left: 50%;
            transform: translateX(-50%);
            background: linear-gradient(90deg, #ff4b2b, #ff416c);
            color: white;
            padding: 6px 25px;
            border-radius: 50px;
            font-weight: 800;
            font-size: 0.75rem;
            letter-spacing: 1px;
            box-shadow: 0 10px 20px rgba(255, 75, 43, 0.3);
            z-index: 10;
        }

        .form-control,
        .form-select {
            border: 1.5px solid #edf2f7;
            transition: all 0.3s ease;
            padding: 12px 15px !important;
        }

        .form-control:focus {
            border-color: #42c1b9 !important;
            box-shadow: 0 0 0 4px rgba(66, 193, 185, 0.15) !important;
            transform: translateX(5px);
        }

        .btn-web3 {
            background: linear-gradient(135deg, #280e57 0%, #42c1b9 100%);
            color: white;
            border: none;
            padding: 16px;
            border-radius: 16px;
            font-weight: 700;
            width: 100%;
            transition: 0.4s;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .btn-web3:hover {
            box-shadow: 0 15px 30px rgba(66, 193, 185, 0.4);
            transform: translateY(-3px);
            color: white;
        }

        .form-stage .col-12 {
            margin-bottom: 0px !important;
        }

        .floating-input-group {
            margin-bottom: 2px !important;
        }

        .text-muted.ms-5 {
            margin-top: 0 !important;
            margin-bottom: 10px !important;
        }

        .error-msg {
            font-size: 0.75rem;
            margin-left: 55px;
        }

        .floating-input-group {
            position: relative;
            overflow: visible;
        }

        .error-msg {
            position: absolute;
            top: 100%;
   
            left: 55px;
            margin-top: 3px;
            font-size: 0.7rem;
            color: red;
            font-weight: 600;
        }


.live-tag {
    position: absolute;
    top: -15px;
    left: 50%;
    transform: translateX(-50%);
    background: linear-gradient(90deg, #ff4b2b, #ff416c);
    color: white;
    padding: 6px 25px;
    border-radius: 50px;
    font-weight: 800;
    font-size: 0.75rem;
    letter-spacing: 1px;
    box-shadow: 0 10px 20px rgba(255, 75, 43, 0.3);
    z-index: 10;
}


.live-tag-mobile {
    background: linear-gradient(90deg, #ff4b2b, #ff416c);
    color: white;
    padding: 8px 15px;
    border-radius: 12px;
    font-weight: 800;
    font-size: 0.7rem;
    text-align: center;
    margin-bottom: 20px;
    display: inline-block;
    width: 100%; 
    box-shadow: 0 4px 12px rgba(255, 75, 43, 0.2);
}

@media (max-width: 768px) {
    .main-card {
        padding-top: 10px !important;
        margin: 15px;
    }
    
    .form-stage .text-center h2 {
        font-size: 1.4rem !important;
    }
}



    </style>
</head>

<body class="d-flex align-items-center justify-content-center">

    <img src="icon.png" class="crypto-asset d-none d-lg-block" style="top: 15%; left: 5%; width: 120px;">
    <img src="icon.png" class="crypto-asset d-none d-lg-block" style="bottom: 10%; right: 5%; width: 140px;">

    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-xl-7 col-lg-9 col-md-11">
                <!-- <div class="card main-card shadow-lg border-0"> -->

                   <div class="card main-card shadow-lg border-0">
    <div class="live-tag d-none d-md-block animate__animated animate__pulse animate__infinite">
        <i class="bi bi-broadcast me-2"></i> LIVE WEB3 WEBINAR 2026
    </div>

    <div class="row g-0">
        <div class="col-12 p-4 p-md-5">
            <div class="live-tag-mobile d-block d-md-none animate__animated animate__pulse animate__infinite">
                <i class="bi bi-broadcast me-2"></i> LIVE WEB3 & CRYPTO WEBINAR 2026
            </div>
                            <form id="regForm">
                                <input type="hidden" name="program_id" value="">

                                <div class="form-stage" id="stage-1">
                                    <div class="text-center mb-4">
                                        <h2 class="fw-bold" style="color: #280e57; letter-spacing: -1px;">Web3 & Crypto Webinar</h2>
                                        <p class="text-muted small">Complete your registration to join.</p>
                                    </div>

                                    <div class="row g-4">
                                        <div class="col-12">
                                            <div class="floating-input-group">
                                                <div class="input-circle-icon"><i class="bi bi-person-bounding-box"></i></div>
                                                <input name="name" type="text" class="form-control" placeholder="Full Name" required>
                                                <small class=" error-msg"></small>
                                            </div>

                                        </div>

                                        <div class="col-12">
                                            <div class="floating-input-group">
                                                <div class="input-circle-icon"><i class="bi bi-envelope-check"></i></div>
                                                <input name="email" type="email" class="form-control" placeholder="Active Email Address" required>
                                                <small class=" error-msg"></small>
                                            </div>

                                        </div>

                                        <div class="col-12">
                                            <div class="floating-input-group">
                                                <div class="input-circle-icon"><i class="bi bi-cpu"></i></div>
                                                <input name="dept" type="text" class="form-control" placeholder="Your Department / Field" required>
                                                <small class=" error-msg"></small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="floating-input-group">
                                                <div class="input-circle-icon"><i class="bi bi-bank"></i></div>
                                                <input name="college" type="text" class="form-control" placeholder="College / Institution Name" required>
                                                <small class=" error-msg"></small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="floating-input-group">
                                                <div class="input-circle-icon">
                                                    <i class="bi bi-calendar-check"></i>

                                                </div>

                                                <select name="passout_year" id="passout_year" class="form-control" required>
                                                    <option value="" disabled selected>Select Passout Year</option>
                                                    <option value="before_2025">Before 2025</option>
                                                    <option value="2025">2025</option>
                                                    <option value="2026">2026</option>
                                                    <option value="2027">2027</option>
                                                    <option value="2028">2028</option>
                                                    <option value="2029">2029</option>
                                                    <option value="2030">2030</option>
                                                </select>
                                            </div>

                                            <small id="year-error" class="text-danger fw-bold d-block" style="font-size: 0.75rem;"></small>
                                        </div>


                                        <div class="col-12">
                                            <div class="floating-input-group">
                                                <div class="input-circle-icon"><i class="bi bi-phone-vibrate"></i></div>
                                                <input name="phone" type="tel" class="form-control" placeholder="Phone" required>
                                                <small class=" error-msg"></small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="floating-input-group">
                                                <div class="input-circle-icon"><i class="bi bi-whatsapp"></i></div>
                                                <input name="whatsapp" type="tel" class="form-control" placeholder="WhatsApp Number" required>
                                                <small class=" error-msg"></small>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="floating-input-group">
                                                <div class="input-circle-icon"><i class="bi bi-geo-alt-fill"></i></div>
                                                <select name="district" id="districtSelect" class="form-select" required onchange="toggleOtherDistrict()">
                                                    <option value="" selected disabled>Select Your District</option>
                                                    <option value="Alappuzha">Alappuzha</option>
                                                    <option value="Ernakulam">Ernakulam</option>
                                                    <option value="Idukki">Idukki</option>
                                                    <option value="Kannur">Kannur</option>
                                                    <option value="Kasaragod">Kasaragod</option>
                                                    <option value="Kollam">Kollam</option>
                                                    <option value="Kottayam">Kottayam</option>
                                                    <option value="Kozhikode">Kozhikode</option>
                                                    <option value="Malappuram">Malappuram</option>
                                                    <option value="Palakkad">Palakkad</option>
                                                    <option value="Pathanamthitta">Pathanamthitta</option>
                                                    <option value="Thiruvananthapuram">Thiruvananthapuram</option>
                                                    <option value="Thrissur">Thrissur</option>
                                                    <option value="Wayanad">Wayanad</option>
                                                    <option value="Other">Other (Outside Kerala)</option>
                                                </select>
                                            </div>
                                            <small class="text-muted ms-5 d-block" style="font-size: 0.7rem;">Select your current location</small>
                                        </div>

                                        <div class="col-12 animate__animated animate__fadeIn" id="otherDistrictContainer" style="display: none;">
                                            <div class="floating-input-group">
                                                <div class="input-circle-icon"><i class="bi bi-map"></i></div>
                                                <input type="text" name="other_district_name" id="otherDistrictInput" class="form-control shadow-none" placeholder="Please specify your location">

                                            </div>
                                            <small class=" error-msg"></small>
                                        </div>

                                        <div class="stage-footer mt-4">
                                            <button type="button" class="btn-web3 btn-next" onclick="submitRegistration(event)">
                                                Submit <i class="bi bi-arrow-right-short ms-2"></i>
                                            </button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script> -->
    <script>
        function toggleOtherDistrict() {
            const selectElement = document.getElementById('districtSelect');
            const otherContainer = document.getElementById('otherDistrictContainer');
            const otherInput = document.getElementById('otherDistrictInput');

            if (selectElement.value === 'Other') {
                otherContainer.style.display = 'block';
                otherInput.setAttribute('required', 'required');
                otherInput.focus();
            } else {
                otherContainer.style.display = 'none';
                otherInput.removeAttribute('required');
                otherInput.value = '';
            }
        }

        function submitRegistration(event) {
            event.preventDefault();

            const form = document.getElementById('regForm');


            if (!form.checkValidity()) {
                form.reportValidity();
                return;
            }

            const formData = new FormData(form);


            fetch('', {
                    method: 'POST',
                    body: formData
                })
                .then(response => response.text())
                .then(data => {
                    if (data.trim() === "success") {
                        Swal.fire({
                            title: 'Success!',
                            text: 'Registration Successful',
                            icon: 'success',
                            confirmButtonColor: '#280e57'
                        }).then(() => {
                            form.reset();
                            location.reload();
                        });
                    } else {
                        Swal.fire('Error', 'Server error: ' + data, 'error');
                    }
                })
                .catch(error => {
                    Swal.fire('Error', 'Connection failed', 'error');
                    console.error('Error:', error);
                });
        }
    </script>
</body>

</html>