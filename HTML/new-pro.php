<?php
require "php.php";
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRM Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <link rel="stylesheet" href="style.css">
</head>

<body>
   <!-- Success Message for Login -->
<?php if (isset($_SESSION['login_error'])): ?>
    <div class="alert alert-danger" role="alert">
        <?php echo $_SESSION['login_error']; ?>
    </div>
    <?php unset($_SESSION['login_error']); // Clear the message after displaying ?>
<?php endif; ?>

<?php if (isset($_SESSION['login_success'])): ?>
    <div class="alert alert-success" role="alert">
        <?php echo $_SESSION['login_success']; ?>
    </div>
    <?php unset($_SESSION['login_success']); // Clear the message after displaying ?>
<?php endif; ?>

<!-- Success Message for Sign Up -->
<?php if (isset($_SESSION['signup_success']) && $_SESSION['signup_success']): ?>
    <div class="alert alert-success" role="alert">
        Your account has been created successfully!
    </div>
    <?php unset($_SESSION['signup_success']); // Clear the message after displaying ?>
<?php endif; ?>

    <!-- Header -->
     <header>
    <div class="header">
        <h1>CUSTOMER RELATIONSHIP MANAGEMENT (CRM) SYSTEM</h1>
    </div>

    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav me-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="#about">About Us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#dashboard">Dashboard</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#customers">Customers</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#tasks">Tasks</a>
                    </li>
                </ul>
                <!-- Search Bar -->
                <form class="d-flex search-bar" method="GET" action="">
                    <input class="form-control me-2" type="search" name="search" placeholder="Search customers..." aria-label="Search">
                    <button class="btn btn-outline-light" type="submit">Search</button>
                </form>
                
                <!-- Login and Sign Up Buttons -->
                <ul class="navbar-nav ms-auto">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownAdmin" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Admin
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdownAdmin">
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#loginModal">Login</a></li>
                            <li><a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#signupModal">Sign Up</a></li>
                            <li class="nav-item">
                                <a class="dropdown-item" href="?logout">Logout</a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
</header>


 <section>  
    <!-- Main Content -->
<div class="container mt-5">

    <div class="row mt-5">
    <div class="col-md-12">
        <h2>0ur team Images</h2>
        <div class="card">
            <div  class="customer-list" id="imageContainer">
            <ul class="customer-grid"> 
               
             <img id="image3" src="newrm4.webp'" alt="Image 1" class="img-fluid"> 
             
              <img id="image4" src="crm10.mp4" alt="Image 2" class="img-fluid">
            
            </ul>
               
            </div>
        </div>
    </div>
  </div>

        <!-- About Us Section -->
        <div id="about" class="row">
            <div class="col-md-12" id="about_us">
                <h1>About Us</h1>

                <h2>CRM System Overview</h2>
           <p>Our CRM (Customer Relationship Management) platform is a powerful,
             intuitive, and scalable solution designed to help businesses build 
             stronger relationships with their customers, streamline operations,
              and drive growth. By centralizing customer data, automating workflows,
               and providing actionable insights, our CRM empowers teams to deliver 
               exceptional customer experiences and achieve their business goals.
           </p>

               <h2>Key Features:</h2>
               <h3>1 Centralized Customer Database </h3>
               <ul> - Store and manage all customer information in one place, 
               including contact details, communication history, purchase behavior, and preferences </ul>
            <ul> -Access a 360-degree view of each customer to personalize interactions and improve engagement.</ul>
            <h3>2 Sales Pipeline Management </h3>  
            <ul>-Track leads, opportunities, and deals through customizable sales pipelines. </ul>
             <ul>-Monitor progress, forecast revenue, and prioritize high-value opportunities.</ul>
             <h3>3 Marketing Automation </h3>
             <u> Create targeted campaigns, automate email marketing, and track campaign performance. </ul>
            <ul>Segment audiences based on behavior, demographics, or preferences for personalized outreach </u>
             <h3>Who Can Benefit?</h3>
            <p>Our CRM is ideal for businesses of all sizes and industries, 
            including sales teams, marketing professionals, customer support agents,
             and business leaders looking to optimize their customer management processes.</p>

            </div>
        </div>
        

        

        <!-- Dashboard Section -->
        <div id="dashboard" class="row">
            <div class="col-md-12">
                <h1 class="mb-4">Dashboard</h1>
            </div>
        </div>
        <div class="row">
            <!-- Total Customers -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Total Customers</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo count($_SESSION['customers']); ?></h5>
                    </div>
                </div>
            </div>
            <!-- Pending Tasks -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Pending Tasks</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $pending_count; ?></h5>
                    </div>
                </div>
            </div>
            <!-- Completed Tasks -->
            <div class="col-md-4">
                <div class="card">
                    <div class="card-header">Completed Tasks</div>
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $completed_count; ?></h5>
                    </div>
                </div>
            </div>
        </div>



     <!-- Image Section -->
 <div class="row mt-5">
    <div class="col-md-12">
        <h2> please visit our works.</h2>
        <div class="card">
            <div class="customer-list" id="imageContainer1">
            <ul class="customer-grid"> 

            <img id="image1" src="newcrm.jpeg" alt="Image 1" class="img-fluid">

            <img id="image2" src="newproject.jpeg" alt="Image 2" class="img-fluid">

            </ul>    
            </div>
        </div>
    </div>
   </div>



        <!-- Customer Management Section -->
        <div id="customers" class="row mt-5">
            <div class="col-md-12">
                <h2>Customer Management</h2>
                <div class="card">
                    <div class="card-header">Add New Customer</div>
                    <div class="card-body">
                        <form method="POST" action="" enctype="multipart/form-data">
                            <div class="form-group">
                                <input type="text" class="form-control" name="name" placeholder="Name" required>
                            </div>
                            <div class="form-group">
                                <input type="email" class="form-control" name="email" placeholder="Email" required>
                            </div>
                            <div class="form-group">
                                <input type="text" class="form-control" name="phone" placeholder="Phone" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="address" placeholder="Address" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="profile_pic">Profile Picture</label>
                                <input type="file" class="form-control" name="profile_pic" accept="image/*">
                            </div>
                            <button type="submit" name="add_customer" class="btn btn-primary">Add Customer</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>



        <!-- Task Management Section -->
        <div id="tasks" class="row mt-5">
            <div class="col-md-12">
                <h2>Task Management</h2>
                <div class="card">
                    <div class="card-header">Add New Task</div>
                    <div class="card-body">
                        <form method="POST" action="">
                            <div class="form-group">
                                <input type="text" class="form-control" name="task_title" placeholder="Task Title" required>
                            </div>
                            <div class="form-group">
                                <textarea class="form-control" name="task_description" placeholder="Task Description" rows="3"></textarea>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="task_status">
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <select class="form-control" name="customer_id" required>
                                    <option value="">Select Customer</option>
                                    <?php 
                                    // Display all customers in the dropdown
                                    foreach ($_SESSION['customers'] as $id => $customer): ?>
                                        <option value="<?php echo $id; ?>"><?php echo htmlspecialchars($customer['name']); ?></option>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <button type="submit" name="add_task" class="btn btn-primary">Add Task</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>




   <!-- Image Section -->

   <div class="row mt-5">
    <div class="col-md-12">
        <h2>Our Team Images</h2>
        <div class="card">
            <div class="customer-list" id="imageContainer1">
                <ul class="customer-grid"> 
                   
                        <img id="image5" src="high-angle-people-applauding-work_23-2149636269.avif" alt="Image 5" class="img-fluid">
               
               
                        <img id="image6" src="people-working-together-medium-shot_52683-99762.avif" alt="Image 6" class="img-fluid">
             
                </ul>  
            </div>
        </div>
    </div>
</div>





        <!-- Task List Section -->
        <div class="row mt-5">
            <div class="col-md-12">
                <h2>Task List</h2>
                <div class="card">
                    <div class="card-header">All Tasks</div>
                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>Title</th>
                                    <th>Description</th>
                                    <th>Status</th>
                                    <th>Customer_Name</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (!empty($_SESSION['tasks'])): ?>
                                    <?php foreach ($_SESSION['tasks'] as $task): ?>
                                        <tr>
                                            <td><?php echo htmlspecialchars($task['title']); ?></td>
                                            <td><?php echo htmlspecialchars($task['description']); ?></td>
                                            <td><?php echo htmlspecialchars($task['status']); ?></td>
                                            <td><?php echo htmlspecialchars($_SESSION['customers'][$task['customer_id']]['name']); ?></td>
                                        </tr>
                                    <?php endforeach; ?>
                                <?php else: ?>
                                    <tr>
                                        <td colspan="4">No tasks found.</td>
                                    </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>





    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Login</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="text" class="form-control" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                        </div>
                        <button type="submit" name="login" class="btn btn-primary">Login</button>
                    </form>
                </div>
            </div>
        </div>
    </div>



    <!-- Sign Up Modal -->
    <div class="modal fade" id="signupModal" tabindex="-1" aria-labelledby="signupModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="signupModalLabel">Sign Up</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="">
                        <div class="form-group">
                       <label for="fullName">Full Name</label>
                            <input type="text" class="form-control" name="fullName" placeholder="Enter full name" required>
                        </div>
                        <div class="form-group">
                            <label for="email">Email</label>
                            <input type="email" class="form-control" name="email" placeholder="Enter email" required>
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" class="form-control" name="password" placeholder="Enter password" required>
                        </div>
                        <div class="form-group">
                            <label for="confirmPassword">Confirm Password</label>
                            <input type="password" class="form-control" name="confirmPassword" placeholder="Confirm password" required>
                        </div>
                        <button type="submit" name="signup" class="btn btn-primary">Sign Up</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
 </div>
 </section> 




    <!-- Footer -->
    <footer class="text-center">
        <div class="container">
            <div class="row">
                <div class="col-md-4">
                    <h5>Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="#">Home</a></li>
                        <li><a href="#about">About Us</a></li>
                        <li><a href="#contact">Contact</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Follow Us</h5>
                    <ul class="list-unstyled">
                        <li><a href="#"><i class="fab fa-facebook"></i> Facebook</a></li>
                        <li><a href="#"><i class="fab fa-twitter"></i> Twitter</a></li>
                        <li><a href="#"><i class="fab fa-instagram"></i> Instagram</a></li>
                    </ul>
                </div>
                <div class="col-md-4">
                    <h5>Contact Info</h5>
                    <ul class="list-unstyled" id="contact">
                        <li><i class="fas fa-map-marker-alt"></i> harar, oromia, Ethiopia</li>
                        <li><i class="fas fa-phone"></i> +251919191919</li>
                        <li><i class="fas fa-envelope"></i> BEKKA20@gmail.com</li>
                    </ul>
                </div>
            </div>
            <hr>
            <p class="mb-0">© 2025 CRM System. All rights reserved.</p>
        </div>
    </footer>



    <script src="project.js"></script>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Custom JS -->
    

</body>
</html>