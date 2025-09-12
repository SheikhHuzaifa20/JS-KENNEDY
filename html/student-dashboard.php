<!DOCTYPE html>
<html lang="en">

<head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">


     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css"
          integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA=="
          crossorigin="anonymous" referrerpolicy="no-referrer" />
     <link rel="preconnect" href="https://fonts.googleapis.com">
     <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
     <link href="https://fonts.googleapis.com/css2?family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">

     <link href="https://fonts.googleapis.com/css2?family=Manrope:wght@200..800&family=Raleway:ital,wght@0,100..900;1,100..900&display=swap"
          rel="stylesheet">
     <link rel="stylesheet" href="css/dashboard.css">

     <title>Dashboard</title>


</head>


<body>

     <main>
          <div class="container-fluid">
               <div class="row">
                    <div class="col-lg-12">
                         <div class="side-close">
                              <div class="close-modal">
                                   <div class="side-moda" id="openshow">
                                        <div class="mian-nav">
                                             <div class="headerlogo">
                                                  <img src="images/logo.png" class="img-fluid" alt="">
                                             </div>
                                             <ul class="nav-tabs">
                                                  <li>
                                                       <a href="{{route('home')}}">Home</a>
                                                  </li>
                                                  <li>
                                                       <a href="javascript:;">Main</a>
                                                  </li>
                                                  <li>
                                                       <a href="javascript:;">Profile</a>
                                                  </li>
                                                  <li>
                                                       <a href="javascript:;">Orders</a>
                                                  </li>
                                                  <li>
                                                       <a href="javascript:;">Contact Us</a>
                                                  </li>
                                                  <li>
                                                       <a href="javascript:;">Help</a>
                                                  </li>
                                                  <li>
                                                       <a href="javascript:;">Log Out</a>
                                                  </li>
                                             </ul>
                                        </div>
                                   </div>
                              </div>
                              <div class="dashboard-info">
                                   <header>
                                        <div class="container-fluid">
                                             <div class="row">
                                                  <div class="col-lg-12">
                                                       <div class="top-header">
                                                            <div class="header-agent">
                                                                 <a href="javascript:;" class="opensidebar"
                                                                      id="openbar">Dashboard <i
                                                                           class="fa-solid fa-angle-right"></i></a>
                                                                 <a href="javascript:;">Agent</a>
                                                            </div>
                                                            <div class="side-order">
                                                                 <a href="javascript:;" class="btn grid-btn">Place an
                                                                      order</a>
                                                                 <div class="ring-btn">
                                                                      <a href="javascript:;"><img
                                                                                src="images/notification.png"
                                                                                class="img-fluid" alt=""></a>
                                                                      <a href="javascript:;"><img
                                                                                src="images/profile.png"
                                                                                class="img-fluid" alt=""></a>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </header>
                                   <section class="recent-order">
                                        <div class="container-fluid">
                                             <div class="row">
                                                  <div class="col-lg-10">
                                                       <div class="ordermain">
                                                            <div class="top-tabel">
                                                                 <div class="shedule-box">
                                                                      <h2>Information for Sign Up </h2>
                                                                      <select name="order" id="ordercategory">
                                                                           <option value="oreder1">All Order</option>
                                                                           <option value="order2">Order 1</option>
                                                                           <option value="order3">Order 2</option>
                                                                      </select>
                                                                 </div>
                                                                 <div class="same-box">
                                                                      <div class="box-one">
                                                                           <!-- <h5>Lorem Ipsum dolor sit <span
                                                                                     class="d-block">amit
                                                                                     doe valuptana</span>
                                                                           </h5>
                                                                           <p>Lorem ipsum dolor sit amet, consectetur
                                                                                adipiscing
                                                                                elit, sed do eiusmod
                                                                                tempor </p> -->
                                                                           <input type="text" class="form-control"
                                                                                placeholder="Name">
                                                                      </div>
                                                                      <div class="box-one">
                                                                           <!-- <h5>Lorem Ipsum dolor sit <span
                                                                                     class="d-block">amit
                                                                                     doe </span>
                                                                           </h5>
                                                                           <p>Lorem ipsum dolor sit amet, consectetur
                                                                                adipiscing
                                                                                elit, sed</p> -->
                                                                           <input type="date" class="form-control"
                                                                                placeholder="DOB">

                                                                      </div>
                                                                      <div class="box-one">
                                                                           <!-- <h5>Lorem Ipsum dolor sit amit
                                                                           </h5>
                                                                           <p>Lorem ipsum dolor sit amet, consectetur
                                                                                adipiscing
                                                                                elit, sed do eiusmod
                                                                                tempor </p> -->
                                                                           <select placeholder="Courses">
                                                                                <option>1 course</option>
                                                                                <option>2 course</option>
                                                                                <option>3 course</option>
                                                                                <option>4 course</option>
                                                                                <option>5 course</option>
                                                                           </select>
                                                                      </div>
                                                                      <div class="box-one">
                                                                           <!-- <h5>Lorem Ipsum dolor sit <span
                                                                                     class="d-block">amit
                                                                                     doe valuptana</span>
                                                                           </h5>
                                                                           <p>Lorem ipsum dolor sit amet, consectetur
                                                                                adipiscing
                                                                                elit, sed do eiusmod
                                                                                tempor </p> -->

                                                                           <input type="email" class="form-control"
                                                                                placeholder="Email">

                                                                      </div>

                                                                      <div class="box-one">
                                                                           <!-- <h5>Lorem Ipsum dolor sit <span
                                                                                     class="d-block">amit
                                                                                     doe valuptana</span>
                                                                           </h5>
                                                                           <p>Lorem ipsum dolor sit amet, consectetur
                                                                                adipiscing
                                                                                elit, sed do eiusmod
                                                                                tempor </p> -->

                                                                           <input type="password" class="form-control"
                                                                                placeholder="Password">
                                                                      </div>
                                                                 </div>
                                                            </div>

                                                            <div class="shedule-box">
                                                                 <h2>Recent Orders</h2>
                                                                 <input type="date" name="date" id="date"
                                                                      placeholder="July 13 2022 - July 23 2022">
                                                            </div>
                                                            <div class="shedule-date">
                                                                 <table>
                                                                      <thead>
                                                                           <tr>
                                                                                <th></th>
                                                                                <th>Sun 7/17</th>
                                                                                <th>Mon 7/18</th>
                                                                                <th>Tue 7/19</th>
                                                                                <th>Wed 7/20</th>
                                                                                <th>Thu 7/21</th>
                                                                                <th>Fri 7/22</th>
                                                                           </tr>
                                                                      </thead>
                                                                      <tbody>
                                                                           <tr>
                                                                                <td>5 AM</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td>6 AM</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td>7 AM</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td>8 AM</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td>9 AM</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td>10 AM</td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                           <tr>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                                <td></td>
                                                                           </tr>
                                                                      </tbody>
                                                                 </table>
                                                            </div>
                                                       </div>
                                                  </div>

                                                  <div class="col-lg-2">
                                                       <div class="side-listing">
                                                            <div class="shedule-box">
                                                                 <h2>Recent Activities</h2>
                                                            </div>
                                                            <div class="main-box-side">
                                                                 <div class="box-listed">
                                                                      <!-- <p>Lorem ipsum dolor consectetur adipisicing elit,
                                                                           sed
                                                                           do
                                                                           eiusmod sit</p> -->
                                                                      <p>Order-1</p>
                                                                      <p>Option-1</p>
                                                                 </div>
                                                                 <div class="box-listed">
                                                                      <!-- <p>Lorem ipsum dolor consectetur
                                                                           adipisicing elit, sed do eiusmod sit
                                                                           natus error sit voluptatem</p> -->
                                                                      <p>Order-1</p>
                                                                      <p>Option-1</p>
                                                                 </div>
                                                                 <div class="box-listed">
                                                                      <!-- <p>Lorem ipsum dolor consectetur
                                                                           adipisicing elit, sed do eiusmod sit</p> -->
                                                                      <p>Order-1</p>
                                                                      <p>Option-1</p>
                                                                 </div>
                                                                 <div class="box-listed">
                                                                      <!-- <p>Lorem ipsum dolor consectetur
                                                                           adipisicing elit, sed do eiusmod sit
                                                                           natus error sit voluptatem</p> -->
                                                                      <p>Order-1</p>
                                                                      <p>Option-1</p>
                                                                 </div>
                                                                 <div class="box-listed">
                                                                      <!-- <p>Lorem ipsum dolor consectetur adipisicing elit,
                                                                           sed
                                                                           do
                                                                           eiusmod sit</p> -->
                                                                      <p>Order-1</p>
                                                                      <p>Option-1</p>
                                                                 </div>
                                                                 <div class="box-listed">
                                                                      <!-- <p>Lorem ipsum dolor consectetur
                                                                           adipisicing elit, sed do eiusmod sit
                                                                           natus error sit voluptatem</p> -->
                                                                      <p>Order-1</p>
                                                                      <p>Option-1</p>
                                                                 </div>
                                                                 <div class="box-listed">
                                                                      <!-- <p>Lorem ipsum dolor consectetur
                                                                           adipisicing elit, sed do eiusmod sit</p> -->
                                                                      <p>Order-1</p>
                                                                      <p>Option-1</p>
                                                                 </div>
                                                                 <div class="box-listed">
                                                                      <!-- <p>Lorem ipsum dolor consectetur
                                                                           adipisicing elit, sed do eiusmod sit
                                                                           natus error sit voluptatem</p> -->
                                                                      <p>Order-1</p>
                                                                      <p>Option-1</p>
                                                                 </div>
                                                            </div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                              </div>
                              </section>
                         </div>
                    </div>
               </div>
          </div>
          </div>
     </main>







     <!-- Optional JavaScript; choose one of the two! -->
     <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"
          integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g=="
          crossorigin="anonymous" referrerpolicy="no-referrer"></script>

     <!-- Option 1: Bootstrap Bundle with Popper -->
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
          integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM"
          crossorigin="anonymous"></script>

     <script src="js/script-two.js"></script>


</body>

</html>