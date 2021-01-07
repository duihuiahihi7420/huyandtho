<div style="width: 380px; margin: 0 auto;">
	<h2><span><a href="index.php?mod=user&act=register">Đăng ký thành viên</a></span></h2>
  	<p>
  	<form class="form" method="post" action="index.php?mod=user&act=register" onsubmit="return IsRegister()">
        <p><label>Họ tên (*)</label><input type="text" name="txtFullName" id="txtFullName" size="30" style="margin-left: 28px;"/></p>
        <p><label>Tên đăng nhập (*)</label><input type="text" name="txtUserName" id="txtUserName" style="margin-left: 40px;"/></p>
        <p><label>Mật khẩu (*)</label><input type="password" name="txtPassWord" id="txtPassWord" style="margin-left: 78px;"/></p>
        <p><label>Mật khẩu xác nhận (*)</label><input type="password" name="txtPrePass" id="txtPrePass" style="margin-left: 16px;" /></p>
        <p><label>Email (*)</label><input type="text" name="txtEmail" id="txtEmail" size="30" style="margin-left: 33px;"/></p>
        <p><label>&nbsp;</label><input type="submit" value="Đăng ký" name="btnRegister" id="btnRegister" style="margin-left: 145px;"/></p>
        <p id="error" class="error"></p>
    </form>
  </p>
	</form>
</div>