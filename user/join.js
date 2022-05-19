function checknick(){
	var u_nick = document.getElementById("u_nick").value;
	if(u_nick) 
	{
		url = "check.php?u_nick="+u_nick;
		window.open(url,"chknick","width=400,height=200");
	} else {
		alert("아이디를 입력하세요.");
	}
}

function decide() {
    document.getElementById("decide").innerHTML = "<span style='color:blue;'>사용 가능한 아이디 입니다.</span>"
    document.getElementById("decide_nick").value = document.getElementById("u_nick").value
	document.getElementById("u_nick").disabled = true
    document.getElementById("join_button").disabled = false
    document.getElementById("check_button").value = "다른 nick 사용"
	document.getElementById("check_button").setAttribute("onclick", "change()")
}

function change() {
    document.getElementById("decide").innerHTML = "<span style='color:red;'>ID 중복 여부를 확인해주세요.</span>"
    document.getElementById("u_nick").disabled = false
	document.getElementById("u_nick").value = ""
    document.getElementById("join_button").disabled = true
    document.getElementById("check_button").value = "중복 검사"
	document.getElementById("check_button").setAttribute("onclick", "checknick()")
}

function mail_change(){
    if(document.join.u_mail.options[document.join.u_mail.selectedIndex].value == '0'){
        document.join.u_mail2.disabled = true;
        document.join.u_mail2.value = "";
    }
    if(document.join.u_mail.options[document.join.u_mail.selectedIndex].value == '1'){
        document.join.u_mail2.disabled = false;
        document.join.u_mail2.value = "";
        document.join.u_mail2.focus();
    } else{
        document.join.u_mail2.disabled = false;
        document.join.u_mail2.value = document.join.u_mail.options[document.join.u_mail.selectedIndex].value;
    }
}

function pw_check() {
    var u_pw = document.getElementById("u_pw");
    var u_pw2 = document.getElementById("u_pw2");

    if (u_pw.value == "") {
        alert("비밀번호를 입력해주세요.");
        u_pw.focus();
        return false;
        }
    
    var pwdCheck = /^(?=.*[a-zA-Z])(?=.*[0-9]).{6,12}$/;

    if (!pwdCheck.test(u_pw.value)) {
        alert("비밀번호는 영문자+숫자 조합으로 6~12자리 사용해야 합니다.");
        u_pw.focus();
        return false;
        }

    if (u_pw2.value !== u_pw.value) {
        alert("비밀번호가 일치하지 않습니다.");
        u_pw2.focus();
        return false;
        }

    if (u_mail1.value == "") {
        alert("이메일 주소를 입력해주세요.");
        email_id.focus();
        return false;
        }

    //입력 값 전송
    document.join.submit();
}