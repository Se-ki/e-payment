<?php
session_start();
if (empty($_SESSION['email']) && empty($_SESSION['password'])) {
    header("location: login.php");
}
$i = 0;
require "./functions/bills.php";
date_default_timezone_set('Asia/Manila');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- transaction resources -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <!-- sidebar resources -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
    <link rel="stylesheet" href="./css/bootstrapV5.3.0/bootstrap.min.css">
    <title>Bills</title>
    <!-- <link rel="stylesheet" href="./css/bills.css"> -->
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap");

        :root {
            --header-height: 3rem;
            --nav-width: 68px;
            --first-color: black;
            --first-color-light: #AFA5D9;
            --white-color: #F7F6FB;
            --body-font: 'Nunito', sans-serif;
            --normal-font-size: 1rem;
            --z-fixed: 100
        }

        *,
        ::before,
        ::after {
            box-sizing: border-box
        }

        body {
            position: relative;
            margin: var(--header-height) 0 0 0;
            padding: 0 1rem;
            font-family: var(--body-font);
            font-size: var(--normal-font-size);
            transition: .5s
        }

        a {
            text-decoration: none
        }

        .header {
            width: 100%;
            height: var(--header-height);
            position: fixed;
            top: 0;
            left: 0;
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 1rem;
            background-color: var(--white-color);
            z-index: var(--z-fixed);
            transition: .5s
        }

        .header_toggle {
            color: var(--first-color);
            font-size: 1.5rem;
            cursor: pointer
        }

        .header_img {
            width: 35px;
            height: 35px;
            display: flex;
            justify-content: center;
            border-radius: 50%;
            overflow: hidden
        }

        .header_img img {
            width: 40px
        }

        .l-navbar {
            position: fixed;
            top: 0;
            left: -30%;
            width: var(--nav-width);
            height: 100vh;
            background-color: var(--first-color);
            padding: .5rem 1rem 0 0;
            transition: .5s;
            z-index: var(--z-fixed)
        }

        .nav {
            height: 100%;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
            overflow: hidden
        }

        .nav_logo,
        .nav_link {
            display: grid;
            grid-template-columns: max-content max-content;
            align-items: center;
            column-gap: 1rem;
            padding: .5rem 0 .5rem 1.5rem
        }

        .nav_logo {
            margin-bottom: 2rem
        }

        .nav_logo-icon {
            font-size: 1.25rem;
            color: var(--white-color)
        }

        .nav_logo-name {
            color: var(--white-color);
            font-weight: 700
        }

        .nav_link {
            position: relative;
            color: var(--first-color-light);
            margin-bottom: 1.5rem;
            transition: .3s
        }

        .nav_link:hover {
            color: var(--white-color)
        }

        .nav_icon {
            font-size: 1.25rem
        }

        .show-l-navbar {
            left: 0
        }

        .body-pd {
            padding-left: calc(var(--nav-width) + 1rem)
        }

        .active {
            color: var(--white-color)
        }

        .active::before {
            content: '';
            position: absolute;
            left: 0;
            width: 2px;
            height: 32px;
            background-color: var(--white-color)
        }

        .height-100 {
            height: 100vh
        }

        @media screen and (min-width: 768px) {
            body {
                margin: calc(var(--header-height) + 1rem) 0 0 0;
                padding-left: calc(var(--nav-width) + 2rem)
            }

            .header {
                height: calc(var(--header-height) + 1rem);
                padding: 0 2rem 0 calc(var(--nav-width) + 2rem)
            }

            .header_img {
                width: 40px;
                height: 40px
            }

            .header_img img {
                width: 45px
            }

            .l-navbar {
                left: 0;
                padding: 1rem 1rem 0 0
            }

            .show-l-navbar {
                width: calc(var(--nav-width) + 156px)
            }

            .body-pd {
                padding-left: calc(var(--nav-width) + 188px)
            }
        }

        .nav-item {
            list-style-type: none;
            cursor: pointer;
            text-transform: capitalize;
        }

        th,
        td {
            text-align: center;
        }

        .description-capitalization {
            text-transform: capitalize;
        }
    </style>
</head>

<body id="body-pd">
    <header class="header" id="header">
        <div class="header_toggle">
            <i class='bx bx-menu' id="header-toggle"></i>
        </div>
        <span class=""><img src="./img/logo-no-bg.png" width="120px" height="50px" alt="" srcset=""></span>
        <li class="nav-item dropdown">
            <a class="dropdown-toggle" data-bs-toggle="dropdown">
                <?php echo $_SESSION['firstname'] ?>
            </a>
            <ul class="dropdown-menu">
                <li><a class="dropdown-item" href="./myinfo.php">My info</a></li>
                <li><a class="dropdown-item"
                        href="./functions/logout.php?id=<?php echo $_SESSION['student_id'] ?>">Logout</a></li>
            </ul>
        </li>
    </header>
    <div class="l-navbar" id="nav-bar">
        <nav class="nav">
            <div>
                <a href="#" class="nav_logo">
                    <img src="./img/icon-no-bg.png" width="25px" height="25px" alt="">
                    <span class="nav_logo-name" style="font:bolder">CEIT E-PAYMENT
                    </span>
                </a>
                <div class="nav_list">
                    <a href="./bills.php" class="nav_link active">
                        <i class='bx bx-grid-alt nav_icon'></i>
                        <span class="nav_name">Bills</span>
                    </a>
                    <a href="./transaction.php" class="nav_link">
                        <i class='bx bx-list-ol nav_icon'></i>
                        <span class="nav_name">Transaction</span>
                    </a>
                    <a href="./myinfo.php" class="nav_link">
                        <i class='bx bxs-user-badge nav_icon'></i>
                        <span class="nav_name">My Info</span>
                    </a>
                </div>
            </div> <a href="./functions/logout.php?id=<?php echo $_SESSION['student_id'] ?>" class="nav_link"> <i
                    class='bx bx-log-out nav_icon'></i> <span class="nav_name">Logout</span> </a>
        </nav>
    </div>
    <!--Container Main start-->
    <div class="height-100 bg-light">
        <h4>Bills</h4>
        <div class="table-responsive">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Description</th>
                        <th scope="col">Amount</th>
                        <th scope="col">Date Posted</th>
                        <th scope="col">Deadline</th>
                        <th scope="col">Encoded By</th>
                        <th scope="col">Action</th>

                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = view($result)) { ?>
                        <tr>
                            <td>
                                <?php echo $i += 1 ?>
                            </td>
                            <td class="description-capitalization">
                                <?php echo $row['bill_description'] ?>
                            </td>
                            <td>
                                <?php echo '₱ ' . number_format($row['bill_amount'], 2) ?>
                            </td>
                            <td>
                                <?php
                                $date = date_create($row['bill_publish']);
                                echo date_format($date, "F d, Y h:i:s A");
                                ?>
                            </td>
                            <td>
                                <?php
                                $date = date_create($row['bill_deadline']);
                                $deadline = date_format($date, "F d, Y");
                                $current = date("F d, Y");
                                $_deadline = strtotime($deadline);
                                $_current = strtotime($current);
                                if ($_current > $_deadline || $_current == $_deadline) {
                                    echo '<p class="text mb-0" style="color:red;">' . $deadline . '</p>';
                                    echo '<p class="small text mb-0" style="color:red;">Missed deadline.</p>';
                                } else {
                                    echo $deadline;
                                }
                                ?>
                            </td>
                            <td>
                                <?php echo $row['admin_name'] ?>
                            </td>
                            <td>
                                <a href="#pay" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#pay"
                                    id="custId" data-id="<?php echo $row['bill_id'] ?>">
                                    Pay
                                </a>
                            </td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="pay" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <span class="modal-title" id="staticBackdropLabel"></span>
                    <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">&times;</button>
                    </button>
                </div>

                <div class="modal-body">
                    <!-- //Here Will show the Data -->
                    <div class="fetched-data">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--Container Main end-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- <script src="./js/bills.js"></script> -->
    <script>
        //modal
        $(document).ready(function () {
            $('#pay').on('show.bs.modal', function (e) {
                var rowid = $(e.relatedTarget).data('id');
                $.ajax({
                    type: 'post',
                    url: 'payment.php', //Here you will fetch records 
                    data: 'rowid=' + rowid, //Pass $id
                    success: function (data) {
                        $('.fetched-data').html(data);//Show fetched data from database
                    }
                });
            });
        });
        // side bar code
        document.addEventListener("DOMContentLoaded", function (event) {

            const showNavbar = (toggleId, navId, bodyId, headerId) => {
                const toggle = document.getElementById(toggleId),
                    nav = document.getElementById(navId),
                    bodypd = document.getElementById(bodyId),
                    headerpd = document.getElementById(headerId)

                // Validate that all variables exist
                if (toggle && nav && bodypd && headerpd) {
                    toggle.addEventListener('click', () => {
                        // show navbar
                        nav.classList.toggle('show-l-navbar')
                        // change icon
                        toggle.classList.toggle('bx-x')
                        // add padding to body
                        bodypd.classList.toggle('body-pd')
                        // add padding to header
                        headerpd.classList.toggle('body-pd')
                    })
                }
            }

            showNavbar('header-toggle', 'nav-bar', 'body-pd', 'header')

            /*===== LINK ACTIVE =====*/
            const linkColor = document.querySelectorAll('.nav_link')

            function colorLink() {
                if (linkColor) {
                    linkColor.forEach(l => l.classList.remove('active'))
                    this.classList.add('active')
                }
            }
            linkColor.forEach(l => l.addEventListener('click', colorLink))

            // Your code to run since DOM is loaded and ready
        });
    </script>
</body>

</html>