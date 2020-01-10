// Focus On Input
    
$("[placeholder]").on("focus", function() {

    var placeholder = $(this).attr("placeholder");

    $(this).attr("data-text", placeholder);

    $(this).attr("placeholder", "");

// Blur On Input 

}).on("blur", function () {

    placeholder = $(this).attr("data-text");

    $(this).attr("placeholder", placeholder);

    $(this).attr("data-text", "");

});

// Add Asterisk On Required Field

$("input").each(function () {

    if ($(this).attr("required") == "required") {
        
       $(this).after("<span class='asterisk'>*</span>");
    }
    
});

// Confirm Before Delete

$(".confirm").on("click", function () {
    
    return (confirm("Are You Sure"));
    
});

// Toggle Between Login And Submit

$(".login-page h2 span").on("click", function () {
    
    $(this).addClass("active").siblings().removeClass("active");
    
    $(".login-page form").hide();
    
    $("." + $(this).data("class")).fadeIn(100);
    
});

// Add Ad Live

$(".live").on("keyup", function () {
   
    $($(this).data("class")).text($(this).val())
    
});