
function previewImage(){
   var image =  document.querySelector('input[name=image]'),files[0];
   var preview = document.querySelector('#preview-img');

   var reader = new FileReader();
   reader.onloadend = function(){
     preview.src = reader.result;
   }

   if(image){
     reader.readAsDataURL(image);
   }else{
     preview.src = "";
   }
}
