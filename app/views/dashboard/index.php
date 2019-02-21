<h1 class="header">Welcome Mr <?php if(isset($_SESSION['firstName'])) echo $_SESSION['firstName']; ?></h1>
<a  class="header" href="/php_mvc/dashboard/subpage/example_variable_parameter_from_url">Subpage with parameter</a>
<a  class="header" href="/php_mvc/login/logout">Logout</a>