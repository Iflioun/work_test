$(document).ready(function(){
	$("#signup_btn").click(function(){
		$("#main").animate({left:"28%"},500);
		$("#loginform").css("visibility","hidden");


				$("#signupform").animate({left:"15%"},400);
						$("#signupform").css("visibility","visible");

	});

	$("#login_btn").click(function(){
		$("#main").animate({left:"72%"},500);
		$("#signupform").css("visibility","hidden");

				$("#loginform").animate({left:"14%"},400);
						$("#loginform").css("visibility","visible");




});
	});
