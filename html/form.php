<?php include "include/header.php" ?>
<?php include "include/menu.php" ?>


<style>
  #regForm {
    background-color: #ffffff;
    margin: 100px auto;
    font-family: Raleway;
    padding: 40px;
    width: 70%;
    min-width: 300px;
  }

  h1 {
    text-align: center;
  }

  input {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }

  /* Mark input boxes that gets an error on validation: */
  input.invalid {
    background-color: #ffdddd;
  }

  /* Hide all steps by default: */
  .tab {
    display: none;
  }

  button {
    color: white;
    background-color: var(--purple);
    font-size: 16px;
    font-weight: 600;
    padding: 10px 25px;
    border-radius: 6px;
  }

  button:hover {
    opacity: 0.8;
  }

  #prevBtn {
    background-color: #bbbbbb;
  }

  /* Make circles that indicate the steps of the form: */
  .step {
    height: 15px;
    width: 15px;
    margin: 0 2px;
    background-color: #bbbbbb;
    border: none;
    border-radius: 50%;
    display: inline-block;
    opacity: 0.5;
  }

  .step.active {
    opacity: 1;
  }

  /* Mark the steps that are finished and valid: */
  .step.finish {
    background-color: #04AA6D;
  }


  section.form-section {
    height: 600px;
  }

  section.inner-banner.form-banner {
    background-image: url(../images/life-health-insurance-policy-concept-idea.jpg) !important;
    position: relative;
    z-index: 0;
  }

  section.inner-banner.form-banner:before {
    position: absolute;
    z-index: 0;
    content: '';
    background: linear-gradient(45deg, white, transparent, transparent);
    top: 0;
    left: 0;
    height: 100%;
    width: 100%;
  }

  .tab {
    color: #2b325b;
    font-size: 30px;
    text-align: center;
    padding: 10px 0px;
  }

  button#prevBtn {
    color: white;
    background-color: var(--purple);
    font-size: 16px;
    font-weight: 600;
    padding: 10px 25px;
    border-radius: 6px;
  }

  .form-section select {
    padding: 10px;
    width: 100%;
    font-size: 17px;
    font-family: Raleway;
    border: 1px solid #aaaaaa;
  }
</style>

<section class="inner-banner form-banner">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="main-heading aos-init" aos-init="" aos-animate="" data-aos="fade-left" data-aos-offset="300"
          data-aos-easing="ease-in-sine" data-aos-duration="1500">
          <h1>Start My Quote <span class="blue">
              <span class="ml6" style="opacity: 1;">
                <span class="text-wrapper">
                  <span class="letters"><span class="letter"
                      style="transform: translateY(0em) translateZ(0px);">F</span><span class="letter"
                      style="transform: translateY(0em) translateZ(0px);">o</span><span class="letter"
                      style="transform: translateY(0em) translateZ(0px);">r</span><span class="letter"
                      style="transform: translateY(0em) translateZ(0px);">m</span><span class="letter"
                      style="transform: translateY(0em) translateZ(0px);"></span></span>
                </span>
              </span>
            </span></h1>
        </div>
      </div>
    </div>
  </div>
</section>


<section class="form-section">
  <div class="container">
    <div class="row">
      <div class="col-lg-12">
        <div class="sec-text-form">

          <form id="regForm" action="/action_page.php">
            <h1>Start My Quote:</h1>
            <!-- One "tab" for each step in the form: -->
            <div class="tab individual-family">Are you looking for <span>Individual or Family coverage?</span>
              <p>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                  value="option1">
                <label class="form-check-label" type="radio" for="inlineRadio1">INDIVIDUAL</label>
              </div>
              <div class="form-check form-check-inline">
                <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                  value="option2">
                <label class="form-check-label" for="inlineRadio2">FAMILY</label>
              </div>
              </p>
            </div>

            <div class="tab">What's your household size?
              <p>
                <!-- <input placeholder="Size..." type="number" oninput="this.className = ''" name="uname"> -->

                <select placeholder="household size..." type="text" oninput="this.className = ''" name="uname">
                  <option value="1">1</option>
                  <option value="2">2</option>
                  <option value="3">3</option>
                  <option value="4">4</option>
                  <option value="5">5</option>
                  <option value="6+">6+</option>
                </select>
              </p>
            </div>


            <div class="tab">What's your household income?
              <p>
                <!-- <input placeholder="Income..." type="number" oninput="this.className = ''" name="uname"> -->
                <select placeholder="household income..." type="text" oninput="this.className = ''" name="uname">
                  <option value="Below 17,000">Below 17,000</option>
                  <option value="17,000 - 25,000">17,000 - 25,000</option>
                  <option value="25,000 – 35,000">25,000 – 35,000</option>
                  <option value="35,000 0 45,000">35,000 - 45,000</option>
                  <option value="45,000 – 55,000">45,000 – 55,000</option>
                  <option value="55,000 – 70,000">55,000 – 70,000</option>
                  <option value="Over 70,000">Over 70,000</option>
                </select>
              </p>
            </div>


            <div class="tab individual-family">What's your gender?
              <p>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1"
                    value="option1">
                  <label class="form-check-label" type="radio" for="inlineRadio1">Male</label>
                </div>
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2"
                    value="option2">
                  <label class="form-check-label" for="inlineRadio2">Female</label>
                </div>
                </p>
            </div>


            <div class="tab">What's your date of birth?
              <p><input placeholder="dd" type="date" oninput="this.className = ''" name="dd"></p>
              <!-- <p><input placeholder="mm"  type="date" oninput="this.className = ''" name="nn"></p>
              <p><input placeholder="yyyy"  type="date" oninput="this.className = ''" name="yyyy"></p> -->
            </div>


            <div class="tab">What's your home address?
              <p>
                <input placeholder="Address..." type="text" oninput="this.className = ''" name="uname">
              </p>
            </div>


            <div class="tab">What is your <span>full name?</span>
              <p><input placeholder="First name..." type="text" oninput="this.className = ''" name="fname"></p>
              <p><input placeholder="Last name..." type="text" oninput="this.className = ''" name="lname"></p>
            </div>


            <div class="tab">Thanks your Quote is ready! <br>Where do we send it to?
              <p><input placeholder="E-mail..." type="email" oninput="this.className = ''" name="email"></p>
              <p><input placeholder="Phone..." type="number" oninput="this.className = ''" name="phone"></p>
            </div>



            <div style="overflow:auto;">
              <div style="float:right;">
                <button type="button" id="prevBtn" onclick="nextPrev(-1)">Previous</button>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
              </div>
            </div>
            <!-- Circles which indicates the steps of the form: -->
            <div style="text-align:center;margin-top:40px;">
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
              <span class="step"></span>
            </div>
          </form>



        </div>
      </div>
    </div>
  </div>
</section>


<script>
  var currentTab = 0; // Current tab is set to be the first tab (0)
  showTab(currentTab); // Display the current tab

  function showTab(n) {
    // This function will display the specified tab of the form...
    var x = document.getElementsByClassName("tab");
    x[n].style.display = "block";
    //... and fix the Previous/Next buttons:
    if (n == 0) {
      document.getElementById("prevBtn").style.display = "none";
    } else {
      document.getElementById("prevBtn").style.display = "inline";
    }
    if (n == (x.length - 1)) {
      document.getElementById("nextBtn").innerHTML = "Submit";
    } else {
      document.getElementById("nextBtn").innerHTML = "Next";
    }
    //... and run a function that will display the correct step indicator:
    fixStepIndicator(n)
  }

  function nextPrev(n) {
    // This function will figure out which tab to display
    var x = document.getElementsByClassName("tab");
    // Exit the function if any field in the current tab is invalid:
    if (n == 1 && !validateForm()) return false;
    // Hide the current tab:
    x[currentTab].style.display = "none";
    // Increase or decrease the current tab by 1:
    currentTab = currentTab + n;
    // if you have reached the end of the form...
    if (currentTab >= x.length) {
      // ... the form gets submitted:
      document.getElementById("regForm").submit();
      return false;
    }
    // Otherwise, display the correct tab:
    showTab(currentTab);
  }

  function validateForm() {
    // This function deals with validation of the form fields
    var x, y, i, valid = true;
    x = document.getElementsByClassName("tab");
    y = x[currentTab].getElementsByTagName("input");
    // A loop that checks every input field in the current tab:
    for (i = 0; i < y.length; i++) {
      // If a field is empty...
      if (y[i].value == "") {
        // add an "invalid" class to the field:
        y[i].className += " invalid";
        // and set the current valid status to false
        valid = false;
      }
    }
    // If the valid status is true, mark the step as finished and valid:
    if (valid) {
      document.getElementsByClassName("step")[currentTab].className += " finish";
    }
    return valid; // return the valid status
  }

  function fixStepIndicator(n) {
    // This function removes the "active" class of all steps...
    var i, x = document.getElementsByClassName("step");
    for (i = 0; i < x.length; i++) {
      x[i].className = x[i].className.replace(" active", "");
    }
    //... and adds the "active" class on the current step:
    x[n].className += " active";
  }
</script>


<?php include "include/footer.php" ?>