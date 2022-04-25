$("#fileToUpload").change(function(){
    $(".file-input-trash").removeClass("hide");
    $(".file-form").addClass("d-inline-block");
   $(" #label-fileToUpload").addClass("btn-primary");
   $(" #label-fileToUpload").removeClass("order-btn-grey");
   $("#btn-text").text("{{ __('Failai prisegti') }}");
});
$(".file-input-trash").click(function(){
    $(".file-input-trash").addClass("hide");
    document.getElementById("fileToUpload").value = "";
    $(".file-form").removeClass("d-inline-block");
   $(" #label-fileToUpload").removeClass("btn-primary");
   $(" #label-fileToUpload").addClass("order-btn-grey");
   $("#btn-text").text("{{ __('Prisegti failus') }}");
});