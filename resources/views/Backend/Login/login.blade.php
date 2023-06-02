<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
<div class="login-wrap">
  @include('flash')
  <h2>Admin Login</h2>
<form action="{{route('login0')}}" method="post">
    @csrf
    <div class="form">
        <input type="text"  placeholder="Username" name="email" />
        <input type="password"  placeholder="Password" name="password" />
        <button> Sign in </button>
      </div>
</form>
  
</div>

<style>
   * {
  box-sizing: border-box;
  margin: 5px;
  padding: 10px;
  
}

html {
  background: #95a5a6;
  background-image: url(http://subtlepatterns2015.subtlepatterns.netdna-cdn.com/patterns/dark_embroidery.png);
  font-family: "Helvetica Neue", Arial, Sans-Serif;
}
html .login-wrap {
  position: relative;
  margin: 0 auto;
  background: #ecf0f1;
  width: 350px;
  border-radius: 5px;
  box-shadow: 3px 3px 10px #333;
  padding: 15px;
}
html .login-wrap h2 {
  text-align: center;
  font-weight: 200;
  font-size: 2em;
  margin-top: 10px;
  color: #34495e;
}
html .login-wrap .form {
  padding-top: 20px;
}
html .login-wrap .form input[type="text"],
html .login-wrap .form input[type="password"],
html .login-wrap .form button {
  width: 80%;
  margin-left: 10%;
  margin-bottom: 25px;
  height: 40px;
  border-radius: 5px;
  outline: 0;

}
html .login-wrap .form input[type="text"],
html .login-wrap .form input[type="password"] {
  border: 1px solid #bbb;
  padding: 0 0 0 10px;
  font-size: 14px;
}
html .login-wrap .form input[type="text"]:focus,
html .login-wrap .form input[type="password"]:focus {
  border: 1px solid #3498db;
}
html .login-wrap .form a {
  text-align: center;
  font-size: 10px;
  color: #3498db;
}
html .login-wrap .form a p {
  padding-bottom: 10px;
}
html .login-wrap .form button {
  background: #e74c3c;
  border: none;
  color: white;
  font-size: 18px;
  font-weight: 200;
  cursor: pointer;
  transition: box-shadow 0.4s ease;
}
html .login-wrap .form button:hover {
  box-shadow: 1px 1px 5px #555;
}
html .login-wrap .form button:active {
  box-shadow: 1px 1px 7px #222;
}
html .login-wrap:after {
  content: "";
  position: absolute;
  top: 0;
  left: 0;
  right: 0;
  background: -webkit-linear-gradient(left, #27ae60 0%, #27ae60 20%, #8e44ad 20%, #8e44ad 40%, #3498db 40%, #3498db 60%, #e74c3c 60%, #e74c3c 80%, #f1c40f 80%, #f1c40f 100%);
  background: -moz-linear-gradient(left, #27ae60 0%, #27ae60 20%, #8e44ad 20%, #8e44ad 40%, #3498db 40%, #3498db 60%, #e74c3c 60%, #e74c3c 80%, #f1c40f 80%, #f1c40f 100%);
  height: 5px;
  border-radius: 5px 5px 0 0;
}

</style>
<script>
    var users = [{ name: "ianpirro" }, { name: "joeschmoe" }, { name: "superdev" }];

var loginform = {
  init: function () {
    this.bindUserBox();
  },

  bindUserBox: function () {
    var result = {};

    $(".form").delegate("input[name='un']", "blur", function () {
      var $self = $(this);

      // this grep would be replaced by $.post tp check db for user
      result = $.grep(users, function (elem, i) {
        return elem.name == $self.val();
      });

      // This would be callback
      if (result.length === 1) {
        if ($("div.login-wrap").hasClass("register")) {
          loginform.revertForm();
          return;
        } else {
          return;
        }
      }

      if (!$("div.login-wrap").hasClass("register")) {
        if ($("input[name='un']").val().length > 4) loginform.switchForm();
      }
    });
  },
  switchForm: function () {
    var $html = $("div.login-wrap").addClass("register");
    $html.children("h2").html("Register");
    $html
      .find(".form input[name='pw']")
      .after(
        "<input type='password' placeholder='Re-type password' name='rpw' />"
      );
    $html.find("button").html("Sign up");
    $html.find("a p").html("Have an account? Sign in");
  },
  revertForm: function () {
    var $html = $("div.login-wrap").removeClass("register");
    $html.children("h2").html("Login");
    $html.find(".form input[name='rpw']").remove();
    $html.find("button").html("Sign in");
    $html.find("a p").html("Don't have an account? Register");
  },
  submitForm: function () {
    // ajax to handle register or login
  }
}; // loginform {}

// Init login form
loginform.init();

// vertical align box
(function (elem) {
  elem.css(
    "margin-top",
    Math.floor($(window).height() / 2 - elem.height() / 2)
  );
})($(".login-wrap"));

$(window).resize(function () {
  $(".login-wrap").css(
    "margin-top",
    Math.floor($(window).height() / 2 - $(".login-wrap").height() / 2)
  );
});

</script>
