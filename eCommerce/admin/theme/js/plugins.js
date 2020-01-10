// Show And Hidden The Latest

$(".toggle-plus").on("click", function () {
    
    $(this).parent().next(".panel-body").slideToggle(200);
    
    $(this).toggleClass("pluse-mince");
    
    if($(this).hasClass("pluse-mince"))
        
    {
        
        $(this).html("<i class='fa fa-minus pull-right'></i>");
        
    } else {
        
        $(this).html("<i class='fa fa-plus pull-right'></i>");
        
    }
    
});

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

// Show And Hidden Password

$(".fa-eye").hover(function ()  {
  
    $(".password").attr("type", "text");
    
}, function(){
    
    $(".password").attr("type", "password");
    
});

// Confirm Before Delete

$(".confirm").on("click", function () {
    
    return (confirm("Are You Sure"));
    
});