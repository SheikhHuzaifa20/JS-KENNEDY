<?php include "include/header.php" ?>
<?php include "include/menu.php" ?>


<section class="cart-pg">
     <div class="container-fluid">
          <div class="row">
               <div class="col-lg-12">
                    <div class="shoping-cart-main">
                         <div class="categories-main">
                              <h3>Shopping Cart </h3>
                         </div>
                         <div class="main-cart-disc">
                              <div class="row">
                                   <div class="col-lg-9">
                                        <div class="last-btn">
                                             <div class="back-btn">
                                                  <a href="{{route('home')}}" class="btn light-blue-btn"><i class="fa-solid fa-chevron-left"></i> Continue</a>
                                             </div>
                                             <div class="back-btn">
                                                  <a href="#" class="btn light-blue-btn"> Clear Cart</a>
                                                  <a href="#" class="btn light-blue-btn"> <i class="fa-solid fa-arrows-rotate"></i> Update Cart </a>
                                             </div>
                                        </div>
                                   </div>
                                   <div class="col-lg-3">
                                        <div class="checkout-side-bar">
                                             <div class="summary-bar">
                                                  <button type="submit" class="btn light-blue-btn">Proceed to
                                                       Checkout</button>
                                             </div>
                                             <div class="back-wt">
                                                  <ul class="Subtotal-price">
                                                       <li>
                                                            <h5>Summary</h5>
                                                       </li>
                                                       <li>
                                                            <h6>Subtotal <span>$0</span></h6>
                                                       </li>
                                                       <li>
                                                            <h6>Order Total <span>$0</span></h6>
                                                       </li>
                                                  </ul>
                                             </div>
                                             <div class="summary-bar">
                                                  <button type="submit" class="btn light-blue-btn">Proceed to
                                                       Checkout</button>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </div>
</section>



<?php include "include/footer.php" ?>