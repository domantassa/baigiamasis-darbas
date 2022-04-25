$('form').submit(function(){

    $b=false;

        $('input.form-btn').each(function(){
           
            if($(this).val() == "")
            {
                $b=true;
                $(this).addClass('invalid');
            }
        });
        $('textarea.form-btn2').each(function(){
           
           if($(this).val() == "")
           {
               $b=true;
               $(this).addClass('invalid');
           }
       });
    if($b){
        return false;
    }
});
$('input.form-btn').change(function(){

               $(this).removeClass('invalid');        
       });
$('textarea.form-btn2').change(function(){
               $(this).removeClass('invalid');
});

$("#fileToUpload").change(function(){
    //alert(1);
    $(".file-input-trash").removeClass("hide");
    $(".file-form").addClass("d-inline-block");
   $(" #label-fileToUpload").addClass("btn-primary");
   $(" #label-fileToUpload").removeClass("order-btn-grey");
   $("#btn-text").text("Failai prisegti");
});
$(".file-input-trash").click(function(){
    $(".file-input-trash").addClass("hide");
    document.getElementById("fileToUpload").value = "";
    $(".file-form").removeClass("d-inline-block");
   $(" #label-fileToUpload").removeClass("btn-primary");
   $(" #label-fileToUpload").addClass("order-btn-grey");
   $("#btn-text").text("Prisegti failus");
});