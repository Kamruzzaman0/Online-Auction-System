<!-- Simple Registration Form -->
<section class="registration-form">
  <h3>Customer Registration</h3>
  @include('flash')
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
  <hr />
  <!-- Form Wrapper -->
  <form  name="registration-form" id="registrationForm" method="post" action="{{route('registration')}}" role="form" enctype="multipart/form-data">
    @csrf
    <div class="form-floating">
      <input type="text" name="name" class="form-control" id="firstName" placeholder="Enter Your Name" />
      <label for="firstName">Name</label>
    </div>
    <div class="form-floating">
      <input type="email" name="email" class="form-control" id="emailAddress" placeholder="Enter Your Email Address" />
      <label for="emailAddress">Email Address</label>
    </div>
    <div class="form-floating">
      <input type="text" name="address" class="form-control" id="userName" placeholder="Enter Your Address" />
      <label for="userName">Address</label>
    </div>
    <div class="form-floating">
      <input type="text" name="phone" class="form-control" id="userName" placeholder="Enter Your Phone Number" />
      <label for="userName">Phone</label>
    </div><div class="form-floating">
      <input type="file" name="image" class="form-control" id="userName" placeholder="Enter Your Image" />
      <label for="userName">Image</label>
    </div>
    <div class="form-floating">
      <input type="password" name="password" class="form-control" id="password" placeholder="Enter Your Password" />
      <label for="password">Password</label>
    </div>
    <div class="form-button-set">
      <button type="submit" class="c-button c-button--navy">Submit</button>
    </div>
  </form>
  <p><a href="{{route('user_login')}}">Back To Login</a></p>
  <!--/ Form Wrapper -->
</section>
<!--/ Simple Registration Form -->

<style>
  *,
*::before,
*::after {
  -webkit-box-sizing: border-box;
  -moz-box-sizing: border-box;
  box-sizing: border-box;
}

html, body {
  width: 100%;
  height: 100%;
  -webkit-text-size-adjust: 100%;
  text-size-adjust: 100%;
}

body {
  display: flex;
  flex-flow: column nowrap;
  align-items: center;
  justify-content: flex-start;
  font-family: "roboto";
  font-size: 0.75rem;
  font-weight: 400;
  line-height: 1.25;
  color: #58595b;
  margin: 0;
  background-color:#74cdde;
}

.registration-form {
  width: 350px;
  margin: 3.125rem 0;
  padding: 1.25rem 0.9375rem;
  background-color: #fff;
  border: 1px solid #707070;
}
.registration-form > h3 {
  font-size: 1.125rem;
  font-weight: 700;
  margin: 0;
}
.registration-form hr {
  margin-bottom: 0.9375rem;
  border-top: 0;
  border-bottom: 1px solid #ccc;
}

.c-button {
  position: relative;
  display: inline-block;
  font-family: "roboto";
  font-size: 0.75rem;
  font-weight: 400;
  line-height: 1.25;
  color: #fff;
  padding: 0.625rem 1.25rem;
  background-color: transparent;
  border: 1px solid transparent;
  border-radius: 0.4rem;
  vertical-align: middle;
  overflow: hidden;
  -webkit-appearance: none;
  appearance: none;
  -webkit-transition: all 0.6s ease-in-out;
  transition: all 0.6s ease-in-out;
}
.c-button:hover, .c-button:focus {
  outline: none;
}
.c-button:not(:disabled) {
  cursor: pointer;
}

.c-button--navy {
  background: #17355e;
  background: rgba(23, 53, 94, 0.6);
  border-color: #17355e;
}
.c-button--navy:hover {
  background: #17355e;
}

.c-button--red {
  background: #df4841;
  background: rgba(223, 72, 65, 0.6);
  border-color: #df4841;
}
.c-button--red:hover {
  background: #df4841;
}

.form-floating {
  position: relative;
  margin-bottom: 0.625rem;
}
.form-floating:last-of-type {
  margin-bottom: 0;
}
.form-floating > .form-control,
.form-floating > .form-select {
  height: 50px;
  padding: 1.038rem 1.038rem;
}
.form-floating > label {
  position: absolute;
  top: 0;
  left: 0;
  font-weight: 700;
  height: 100%;
  padding: 1.038rem 1.038rem;
  border: 1px solid transparent;
  pointer-events: none;
  transform-origin: 0 0;
  -webkit-transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
  transition: opacity 0.1s ease-in-out, transform 0.1s ease-in-out;
}
.form-floating > .form-control::placeholder {
  color: transparent;
}
.form-floating > .form-control:focus, .form-floating > .form-control:not(:placeholder-shown) {
  padding-top: 1.625rem;
  padding-bottom: 0.625rem;
}
.form-floating > .form-control:-webkit-autofill {
  padding-top: 1.625rem;
  padding-bottom: 0.625rem;
}
.form-floating > .form-control:focus ~ label,
.form-floating > .form-control:not(:placeholder-shown) ~ label,
.form-floating > .form-select ~ label {
  opacity: 0.65;
  transform: scale(0.75) translateY(-0.5rem) translateX(0.15rem);
}
.form-floating > .form-control:-webkit-autofill ~ label {
  opacity: 0.65;
  transform: scale(0.75) translateY(-0.5rem) translateX(0.15rem);
}

.form-control {
  display: block;
  font-family: "roboto";
  font-size: 0.75rem;
  font-weight: 400;
  line-height: 1.25;
  color: #58595b;
  width: 100%;
  height: 35px;
  padding: 0.938rem 0.938rem;
  background-color: #fff;
  border: 1px solid #707070;
  border-radius: 0.25rem;
  appearance: none;
  box-shadow: none;
  -webkit-transition: border-color 0.25s ease-in-out;
  transition: border-color 0.25s ease-in-out;
}
.form-control:focus {
  color: #58595b;
  background-color: #fff;
  border-color: #74cdde;
  outline: none;
  -webkit-box-shadow: none;
  box-shadow: none;
}

.is-invalid {
  border-color: #df4841;
}

em {
  display: block;
  font-size: 0.75rem;
  font-weight: 700;
  margin-top: 0.3125rem;
}
em.error {
  color: #df4841;
}

.form-button-set {
  display: flex;
  flex-wrap: nowrap;
  justify-content: flex-end;
  margin-top: 1.25rem;
}
.form-button-set > .c-button.c-button:first-child {
  margin-right: 0.3125rem;
}
.form-button-set > .c-button.c-button:last-child {
  margin-left: 0.3125rem;
}
</style>
<script>
  $(function () {
  console.log("Validation - Ready !");
  $('form[name="registration-form"]').validate({
    rules: {
      firstName: "required",
      lastName: "required",
      emailAddress: {
        required: true,
        email: true
      },
      userName: {
        required: true,
        minlength: 6
      },
      password: {
        required: true,
        minlength: 8
      },
      confirmPassword: {
        required: true,
        minlength: 8,
        equalTo: "#password"
      }
    },
    messages: {
      firstName: "Please enter your First Name",
      lastName: "Please enter your Last Name",
      emailAddress: "Please enter a valid Email Address",
      userName: {
        required: "Please enter a User Name",
        minlength: "Your User Name must consist of at least 6 characters"
      },
      password: {
        required: "Please provide a Password",
        minlength: "Your Password must be at least 8 characters long"
      },
      confirmPassword: {
        required: "Please provide a Password",
        minlength: "Your Password must be at least 8 characters long",
        equalTo: "Please enter the same Password as above"
      }
    },
    errorElement: "em",
    errorPlacement: function (error, element) {
      error.addClass("invalid-feedback");

      if (element.prop("type") === "checkbox") {
        error.insertAfter(element.next("label"));
      } else {
        error.insertAfter(element);
      }
    },
    highlight: function (element, errorClass, validClass) {
      $(element).addClass("is-invalid").removeClass("is-valid");
    },
    unhighlight: function (element, errorClass, validClass) {
      $(element).addClass("is-valid").removeClass("is-invalid");
    }
  });
});

</script>
    