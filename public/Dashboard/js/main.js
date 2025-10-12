$(document).ready(function(){
    // Start Datatable ...
    $('#datatable').DataTable();

    // Image Preview
    function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();
          
          reader.onload = function(e) {
            $('.image-preview').attr('src', e.target.result);
          }
          
          reader.readAsDataURL(input.files[0]);
        }
      }
      
      $(".image").change(function() {
        readURL(this);
      });


});